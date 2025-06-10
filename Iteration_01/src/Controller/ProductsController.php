<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 */
class ProductsController extends AppController
{    public function beforeFilter(\Cake\Event\EventInterface $event)
{
    parent::beforeFilter($event);
    // Allow shop page to be accessed without admin login
    $this->Authentication->addUnauthenticatedActions(['shop','viewProduct']);
    // Only restrict admin actions, not the shop
    $publicActions = ['shop','viewProduct']; // add more if needed
    if (!in_array($this->request->getParam('action'), $publicActions)) {
        $this->requireAdmin();
    }// This will restrict access to admin users only
}
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Products->find()->contain(['ProductCategories']);

        $this->paginate = [
            'limit' => 8,
            'order' => ['Products.created' => 'desc']
        ];

        $products = $this->paginate($query);

        $this->set(compact('products'));
    }

    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $product = $this->Products->get($id, contain: ['ProductCategories', 'Reviews']);
        $this->set(compact('product'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $product = $this->Products->newEmptyEntity();
        if ($this->request->is('post')) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $productCategories = $this->Products->ProductCategories->find('list', limit: 200)->all();
        $orders = $this->Products->Orders->find('list', limit: 200)->all();
        $this->set(compact('product', 'productCategories', 'orders'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $product = $this->Products->get($id, contain: ['Orders']);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $productCategories = $this->Products->ProductCategories->find('list', limit: 200)->all();
        $orders = $this->Products->Orders->find('list', limit: 200)->all();
        $this->set(compact('product', 'productCategories', 'orders'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        $product = $this->Products->get($id);

        if ($product->stock == 0) {
            $this->Flash->error(__('The product has already been removed.'));
        } else {
            $product->stock = 0;
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been removed from the listing.'));
            } else {
                $this->Flash->error(__('The product could not be removed. Please, try again.'));
            }
        }

        return $this->redirect(['action' => 'index']);
    }

    public function shop()
    {
        // Retrieve query parameters
        $filter = $this->request->getQuery('filter');
        $categoryId = $this->request->getQuery('category'); // e.g., ?category=3

        // Initial query to retrieve products with their categories and reviews
        $query = $this->Products->find()
            ->contain(['ProductCategories', 'Reviews']); // Include Reviews

        // Apply category filter if provided
        if (!empty($categoryId)) {
            $query->matching('ProductCategories', function ($q) use ($categoryId) {
                return $q->where(['ProductCategories.id' => $categoryId]);
            });
        }

        // Apply other filters
        if ($filter === 'new') {
            $query->order(['Products.retail_price' => 'DESC']);
        } elseif ($filter === 'discount') {
            $query->where(['Products.discount_percent >' => 0])
                ->order(['Products.retail_price' => 'ASC']);
        } elseif ($filter === 'bestseller') {
            $query->order(['Products.retail_price' => 'ASC']);
        }

        // Paginate
        $products = $this->paginate($query);

        // Update retail price and calculate review details
        foreach ($products as $product) {
            // Calculate retail price based on discount
            if (!empty($product->discount_percent) && !empty($product->wholesale_price)) {
                $discount = ($product->wholesale_price * $product->discount_percent) / 100;
                $product->retail_price = round($product->wholesale_price - $discount, 2);
            } else {
                $product->retail_price = $product->wholesale_price;
            }

            // Calculate average rating and total reviews
            if (!empty($product->reviews)) {
                $totalRating = array_sum(array_column($product->reviews, 'rating'));
                $totalReviews = count($product->reviews);
                $product->average_rating = round($totalRating / $totalReviews, 1);
            } else {
                $product->average_rating = 0;
                $totalReviews = 0;
            }

            $product->total_reviews = $totalReviews;
        }

        // Fetch distinct categories for filtering
        $categories = $this->Products->ProductCategories->find('all')
            ->distinct(['ProductCategories.category'])
            ->order(['ProductCategories.category' => 'ASC'])
            ->toArray();

        // Pass products and categories to the view
        $this->set(compact('products', 'categories'));
    }



    public function viewProduct($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => ['ProductCategories', 'Reviews' => function ($q) {
                return $q->where(['Reviews.status' => 1]); // Only get approved reviews
            }]
        ]);

        // Calculate discount if applicable
        if (!empty($product->discount_percent) && !empty($product->wholesale_price)) {
            $discount = ($product->wholesale_price * $product->discount_percent) / 100;
            $product->retail_price = round($product->wholesale_price - $discount, 2);
        } else {
            $product->retail_price = $product->wholesale_price;
        }

        $this->set(compact('product'));
        $this->set('reviews', $product->reviews);
    }



}
