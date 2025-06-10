<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Log\Log;

use Cake\Mailer\MailerAwareTrait;

/**
 * Orders Controller
 *
 * @property \App\Model\Table\OrdersTable $Orders
 */
class OrdersController extends AppController
{
    use MailerAwareTrait;

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['cart','viewCart','placeOrder','thankYou','updateQuantity','removeFromCart', 'cartPayment']);
        $publicActions = ['cart','viewCart','placeOrder','thankYou','updateQuantity','removeFromCart', 'cartPayment'];
        if (!in_array($this->request->getParam('action'), $publicActions)) {
            $this->requireAdmin();
        }
    }

    public function index()
    {
        $query = $this->Orders->find('all', contain: ['Customers']);

        $this->paginate = [
            'limit' => 8,
            'order' => ['Orders.created' => 'desc']
        ];

        $orders = $this->paginate($query);

        $this->set(compact('orders'));
    }

    public function view($id = null)
    {
        $ordersTable = $this->fetchTable('Orders');
        $order = $ordersTable->get($id, contain: ['Customers']);

        $orderProducts = $this->fetchTable('OrdersProducts')->find()
            ->where(['order_id' => $id])
            ->contain(['Products'])
            ->all();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            if (
                isset($data['status'], $data['delivery_status']) &&
                $data['status'] === 'completed' &&
                $data['delivery_status'] !== 'delivered'
            ) {
                $this->Flash->error(__('You can only mark an order as Completed if the Delivery Status is set to Delivered.'));
                return $this->redirect($this->referer());
            }

            $order = $this->Orders->patchEntity($order, $data);

            if ($ordersTable->save($order)) {
                $this->Flash->success(__('Order updated successfully.'));
                return $this->redirect(['action' => 'view', $id]);
            }
            $this->Flash->error(__('Unable to update order.'));
        }

        $this->set(compact('order', 'orderProducts'));
    }

    public function add()
    {
        $order = $this->Orders->newEmptyEntity();
        if ($this->request->is('post')) {
            $order = $this->Orders->patchEntity($order, $this->request->getData());
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The order has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order could not be saved. Please, try again.'));
        }
        $products = $this->Orders->Products->find('list', limit: 200)->all();
        $this->set(compact('order', 'products'));
    }

    /**
     *  Order confirmation email
     */
    protected function _sendOrderConfirmationEmail(\App\Model\Entity\Order $order): void
    {
        try {
            $order = $this->Orders->get($order->id, contain: [
                'Customers',
                'OrdersProducts' => ['Products']
            ]);

            $items = [];
            foreach ($order->orders_products as $op) {
                $items[] = [
                    'name'     => $op->product->name,
                    'quantity' => $op->quantity,
                    'price'    => $op->price,
                ];
            }

            $recipientEmail = $order->customer->email;

            Log::debug(" Sending confirmation email to {$recipientEmail}");

            $method = $order->delivery_method;
            $this->getMailer('Order')->send('sendConfirmation', [
                $recipientEmail,
                $order,
                $items,
                $method
            ]);

            Log::debug(" Confirmation email sent for Order #{$order->id}");
        } catch (\Throwable $e) {
            Log::error(" Email sending failed: " . $e->getMessage());
        }
    }



    public function edit($id = null)
    {
        $order = $this->Orders->get($id, contain: ['Products']);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            if (
                isset($data['status'], $data['delivery_status']) &&
                $data['status'] === 'completed' &&
                $data['delivery_status'] !== 'delivered'
            ) {
                $this->Flash->error(__('You can only mark an order as Completed if the Delivery Status is set to Delivered.'));
                return $this->redirect($this->referer());
            }

            $order = $this->Orders->patchEntity($order, $data);

            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The order has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order could not be saved. Please, try again.'));
        }
        $products = $this->Orders->Products->find('list', limit: 200)->all();
        $this->set(compact('order', 'products'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $order = $this->Orders->get($id);
        if ($this->Orders->delete($order)) {
            $this->Flash->success(__('The order has been deleted.'));
        } else {
            $this->Flash->error(__('The order could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function cart()
    {
        $request = $this->getRequest();
        $productId = $request->getData('product_id');
        $quantity = $request->getData('quantity') ?? 1;

        $session = $this->getRequest()->getSession();
        $cart = $session->read('Cart', []);
        $found = false;

        foreach ($cart as &$item) {
            if ($item['product_id'] == $productId) {
                $item['quantity'] += $quantity;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $cart[] = ['product_id' => $productId, 'quantity' => $quantity];
        }

        $session->write('Cart', $cart);
        $session->write('CartCount', array_sum(array_column($cart, 'quantity')));

        $this->Flash->success(__('Product added to cart.'));
        return $this->redirect(['controller' => 'Products', 'action' => 'shop']);
    }

    public function viewCart()
    {
        $session = $this->getRequest()->getSession();
        $cart = $session->read('Cart', []);
        $cartItems = [];

        if (!empty($cart)) {
            $productIds = collection($cart)->extract('product_id')->toList();

            $productsQuery = $this->fetchTable('Products')
                ->find()
                ->where(['id IN' => $productIds]);

            $products = [];
            foreach ($productsQuery as $product) {
                // Calculate discount if applicable
                if (!empty($product->discount_percent) && !empty($product->wholesale_price)) {
                    $discount = ($product->wholesale_price * $product->discount_percent) / 100;
                    $product->final_price = round($product->wholesale_price - $discount, 2);
                } else {
                    $product->final_price = $product->wholesale_price;
                }

                // Store product
                $products[$product->id] = $product;
            }

            foreach ($cart as $item) {
                if (isset($products[$item['product_id']])) {
                    $cartItems[] = [
                        'product' => $products[$item['product_id']],
                        'quantity' => $item['quantity']
                    ];
                }
            }
        }

        $this->set(compact('cartItems'));
    }


    public function placeOrder()
    {
        $this->autoRender = false;
        $this->response = $this->response->withType('json');

        try {
            if (!$this->request->is('post')) {
                throw new \Exception('Invalid request method');
            }

            $data = $this->request->getData();
            $session = $this->request->getSession();
            $cart = $session->read('Cart') ?? [];

            if (empty($cart)) {
                throw new \Exception('Cart is empty');
            }

            \Cake\Log\Log::debug('Order data received: ' . json_encode($data));
            \Cake\Log\Log::debug('Cart contents: ' . json_encode($cart));

            $customersTable = $this->fetchTable('Customers');
            $ordersTable = $this->fetchTable('Orders');
            $orderProductsTable = $this->fetchTable('OrdersProducts');
            $productsTable = $this->fetchTable('Products');

            $requiredFields = ['name', 'email', 'address', 'delivery_method', 'payment_intent_id'];
            foreach ($requiredFields as $field) {
                if (empty($data[$field])) {
                    throw new \Exception("Missing required field: {$field}");
                }
            }

            $customer = $customersTable->newEntity([
                'name'    => $data['name'],
                'email'   => $data['email'],
                'address' => $data['address'],
            ]);

            if (!$customersTable->save($customer)) {
                \Cake\Log\Log::error('Customer save errors: ' . json_encode($customer->getErrors()));
                throw new \Exception('Failed to save customer information');
            }

            $validCart = [];
            $totalAmount = 0;

            foreach ($cart as $item) {
                try {
                    $product = $productsTable->get($item['product_id']);
                    if ($product->stock >= $item['quantity']) {
                        $item['product'] = $product;
                        $validCart[] = $item;
                        $totalAmount += $product->retail_price * $item['quantity'];
                    } else {
                        throw new \Exception('Insufficient stock for ' . $product->name);
                    }
                } catch (\Exception $e) {
                    \Cake\Log\Log::error('Product processing error: ' . $e->getMessage());
                    throw $e;
                }
            }

            if (empty($validCart)) {
                throw new \Exception('No valid items in cart');
            }

            $order = $ordersTable->newEntity([
                'customer_id'        => $customer->id,
                'total_amount'       => $totalAmount,
                'status'             => 'processed',
                'delivery_method'    => $data['delivery_method'],
                'notes'              => $data['notes'] ?? null,
                'stripe_payment_id'  => $data['payment_intent_id']
            ]);

            if (!$ordersTable->save($order)) {
                \Cake\Log\Log::error('Order save errors: ' . json_encode($order->getErrors()));
                throw new \Exception('Failed to save order');
            }

            try {
                $this->_sendOrderConfirmationEmail($order);
            } catch (\Throwable $e) {
                Log::error(" Error sending confirmation email: " . $e->getMessage());
                // Don't throw here, as the order was successfully placed
            }

            foreach ($validCart as $item) {
                $product = $item['product'];
                $product->stock -= $item['quantity'];
                if (!$productsTable->save($product)) {
                    \Cake\Log\Log::error('Product stock update failed: ' . json_encode($product->getErrors()));
                }

                $orderProduct = $orderProductsTable->newEntity([
                    'order_id'   => $order->id,
                    'product_id' => $product->id,
                    'quantity'   => $item['quantity'],
                    'price'      => $product->retail_price,
                ]);

                if (!$orderProductsTable->save($orderProduct)) {
                    \Cake\Log\Log::error('Order product save failed: ' . json_encode($orderProduct->getErrors()));
                }
            }

            $session->delete('Cart');
            $session->write('CartCount', 0);
            $session->write('OrderPlaced', true);

            return $this->response->withStringBody(json_encode([
                'success' => true,
                'message' => 'Order placed successfully! A confirmation email has been sent.'
            ]));

        } catch (\Exception $e) {
            \Cake\Log\Log::error('Order processing error: ' . $e->getMessage());
            \Cake\Log\Log::error('Stack trace: ' . $e->getTraceAsString());

            return $this->response
                ->withStatus(400)
                ->withStringBody(json_encode([
                    'success' => false,
                    'message' => $e->getMessage()
                ]));
        }
    }


    public function thankYou()
    {
        // $session = $this->getRequest()->getSession();
        // if (!$session->read('OrderPlaced')) {
        //     return $this->redirect(['controller' => 'Products', 'action' => 'shop']);
        // }
        // $session->delete('OrderPlaced');

        $success = $this->request->getQuery('success');
        if ($success !== '1') {
            return $this->redirect(['controller' => 'Products', 'action' => 'shop']);
        }
    }

    public function updateQuantity($productId, $direction)
    {
        $session = $this->getRequest()->getSession();
        $cart = $session->read('Cart', []);
        $productsTable = $this->fetchTable('Products');

        try {
            $product = $productsTable->get($productId);
        } catch (\Exception $e) {
            $this->Flash->error("Product not found.");
            return $this->redirect(['action' => 'viewCart']);
        }

        foreach ($cart as &$item) {
            if ($item['product_id'] == $productId) {
                if ($direction === 'increase' && $item['quantity'] < $product->stock) {
                    $item['quantity'] += 1;
                } elseif ($direction === 'decrease') {
                    $item['quantity'] = max(1, $item['quantity'] - 1);
                }
                break;
            }
        }

        $session->write('Cart', $cart);
        $session->write('CartCount', array_sum(array_column($cart, 'quantity')));

        return $this->redirect(['action' => 'viewCart']);
    }

    public function removeFromCart($productId)
    {
        $session = $this->getRequest()->getSession();
        $cart = $session->read('Cart', []);
        foreach ($cart as $key => $item) {
            if ($item['product_id'] == $productId) {
                unset($cart[$key]);
                break;
            }
        }

        $session->write('Cart', $cart);
        $session->write('CartCount', array_sum(array_column($cart, 'quantity')));
        $this->Flash->success('Product removed from your cart.');
        return $this->redirect(['action' => 'viewCart']);
    }

// Backend: cartPayment method
    public function cartPayment()
    {
        $session = $this->getRequest()->getSession();
        $cart = $session->read('Cart', []);
        $cartItems = [];

        if (!empty($cart)) {
            $productIds = collection($cart)->extract('product_id')->toList();

            $productsQuery = $this->fetchTable('Products')
                ->find()
                ->where(['id IN' => $productIds]);

            $products = [];
            foreach ($productsQuery as $product) {
                $products[$product->id] = $product;
            }

            foreach ($cart as $item) {
                if (isset($products[$item['product_id']])) {
                    $product = $products[$item['product_id']];
                    $actualPrice = $product->wholesale_price;
                    $discountedPrice = !empty($product->discount_percent) ? round($actualPrice - ($actualPrice * $product->discount_percent / 100), 2) : $actualPrice;

                    $cartItems[] = [
                        'product' => $product,
                        'quantity' => $item['quantity'],
                        'actual_price' => $actualPrice,
                        'final_price' => $discountedPrice
                    ];
                }
            }
        }

        $this->set(compact('cartItems'));
        $this->viewBuilder()->setLayout('default');
    }


}
