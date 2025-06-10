<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Exception\BadRequestException;
use Cake\Core\Configure;
use Cake\Controller\Controller;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use \Stripe\PaymentIntent;


class StripeController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        Stripe::setApiKey('sk_test_51RMHU4PwQ8uNzZNstsYD4MMoPbdzTY73e5YdHHrrYMiQexiO0k5sudhhEFGDcn8eO1GpXxNWKBUnw6DEYo66QDOP009t5QyruE');
    }
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['checkout', 'confirmation']);
        $publicActions = ['checkout', 'confirmation'];
        if (!in_array($this->request->getParam('action'), $publicActions)) {
            $this->requireAdmin();
        }
    }



    public function index()
    {

    }

    // public function checkout() {
    //     $this->request->allowMethod(['post']);

    //     try {
    //         \Stripe\Stripe::setApiKey('sk_test_51RMHU4PwQ8uNzZNstsYD4MMoPbdzTY73e5YdHHrrYMiQexiO0k5sudhhEFGDcn8eO1GpXxNWKBUnw6DEYo66QDOP009t5QyruE');

    //         // Get the JSON data from the request
    //         $data = $this->request->getData(); // Changed to use getData()
    //         $amount = $data['amount'] ?? 0;

    //         // Create a Checkout session
    //         $session = \Stripe\Checkout\Session::create([
    //             'mode' => 'payment',
    //             'ui_mode' => 'embedded',
    //             'payment_method_types' => ['card'],
    //             'line_items' => [[
    //                 'price_data' => [
    //                     'currency' => 'aud',
    //                     'product_data' => [
    //                         'name' => 'Cart Purchase',
    //                     ],
    //                     'unit_amount' => (int)($amount * 100), // Convert to cents
    //                 ],
    //                 'quantity' => 1,
    //             ]],
    //             'return_url' => 'http://localhost/team031-app_fit3047/Iteration_01/orders/thank_you',

    //             'phone_number_collection' => [
    //                 'enabled' => true,
    //             ],
    //             'shipping_address_collection' => [
    //                 'allowed_countries' => ['AU'],
    //             ],
    //         ]);

    //         // Send the session ID to the front end
    //         return $this->response
    //             ->withType('json')
    //             ->withStringBody(json_encode(['clientSecret' => $session->client_secret]));

    //     } catch (\Stripe\Exception\ApiErrorException $e) {
    //         // Handle any Stripe API errors
    //         return $this->response
    //             ->withType('json')
    //             ->withStatus(500)
    //             ->withStringBody(json_encode(['error' => $e->getMessage()]));
    //     }
    // }

//    public function checkout() {
//        $this->request->allowMethod(['post']);
//
//        try {
//            \Stripe\Stripe::setApiKey('sk_test_51RMHU4PwQ8uNzZNstsYD4MMoPbdzTY73e5YdHHrrYMiQexiO0k5sudhhEFGDcn8eO1GpXxNWKBUnw6DEYo66QDOP009t5QyruE');
//
//            $data = $this->request->getData();
//            $amount = $data['amount'] ?? 0;
//
//            // Create a PaymentIntent instead of a Session
//            $paymentIntent = \Stripe\PaymentIntent::create([
//                'amount' => (int)$amount, // Amount is already in cents from JS
//                'currency' => 'aud',
//                'payment_method_types' => ['card'],
//                'metadata' => [
//                    'order_id' => time() // You might want to use an actual order ID
//                ]
//            ]);
//
//            return $this->response
//                ->withType('application/json')
//                ->withStringBody(json_encode([
//                    'clientSecret' => $paymentIntent->client_secret
//                ]));
//
//        } catch (\Exception $e) {
//            return $this->response
//                ->withType('application/json')
//                ->withStatus(500)
//                ->withStringBody(json_encode([
//                    'error' => $e->getMessage()
//                ]));
//        }
//    }


// public function checkout()
// {
//     $this->request->allowMethod(['post']);


//     try {

//         $data = $this->request->getData();

//             if (empty($data['amount'])) {
//                 throw new BadRequestException('Amount is required');
//             }

//             $amount = round($data['amount'] * 100); // Convert to cents

//             $paymentIntent = PaymentIntent::create([
//                 'amount' => $amount,
//                 'currency' => 'aud',
//                 'automatic_payment_methods' => [
//                     'enabled' => true,
//                 ],
//             ]);

//         return $this->response
//         ->withType('application/json')
//             ->withStringBody(json_encode([
//                 'clientSecret' => $paymentIntent->client_secret
//             ]));

//     } catch (\Exception $e) {
//         throw new InternalErrorException($e->getMessage());
//     }
// }

public function checkout()
    {
        $this->autoRender = false;

        if (!$this->request->is('post')) {
            return $this->response
                ->withType('application/json')
                ->withStatus(400)
                ->withStringBody(json_encode(['error' => 'Invalid request method']));
        }

        try {
            $data = $this->request->getData();
            $amount = floatval($data['amount']);

            if (!$amount) {
                throw new BadRequestException('Invalid amount');
            }

            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => round($amount * 100),
                'currency' => 'aud',
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
//                'payment_method_types' => ['card', 'afterpay_clearpay', 'zip'],
                ]);

            return $this->response
                ->withType('application/json')
                ->withStringBody(json_encode([
                    'clientSecret' => $paymentIntent->client_secret
                ]));

        } catch (\Exception $e) {
            return $this->response
                ->withType('application/json')
                ->withStatus(500)
                ->withStringBody(json_encode([
                    'error' => $e->getMessage()
                ]));
        }
    }

    /**
     * Confirmation page after successful payment
     */
    public function confirmation()
    {
        // Get payment_intent from query parameter if available
        $paymentIntentId = $this->request->getQuery('payment_intent');

        if (!$paymentIntentId) {
            // Check session for payment intent (optional, depending on your flow)
            $paymentIntentId = $this->request->getSession()->read('PaymentIntent.id');
        }

        // You can check the payment status with Stripe API if needed
        // For now, we'll just display the confirmation page

        // Clear cart data from session
        $this->request->getSession()->delete('Cart');

        $this->set('paymentIntentId', $paymentIntentId);
    }
}
