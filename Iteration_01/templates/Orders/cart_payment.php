<?php
$total = 0;
foreach ($cartItems as $item) {
    $total += $item['quantity'] * $item['product']->retail_price;
}
// Define the constant URLs with full options
$STRIPE_CHECKOUT_URL = $this->Url->build([
    'controller' => 'Stripe',
    'action' => 'checkout',
    '_full' => true
]);
$PLACE_ORDER_URL = $this->Url->build([
    'controller' => 'Orders',
    'action' => 'placeOrder',
    '_full' => true
]);
$THANK_YOU_URL = $this->Url->build([
    'controller' => 'Orders',
    'action' => 'thankYou',
    '_full' => true
]);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="csrfToken" content="<?= $this->request->getAttribute('csrfToken') ?>">
    <title>Checkout</title>
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Order Summary</h2>
    <table class="table table-bordered align-middle">
        <thead>
        <tr>
            <th>Product</th>
            <th>Name</th>
            <th>Actual Price</th>
            <th>Discounted Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>
        </thead>
        <tbody>
        <?php $total = 0; ?>
        <?php foreach ($cartItems as $item): ?>
            <?php
            $subtotal = $item['quantity'] * $item['final_price'];
            $total += $subtotal;
            ?>
            <tr>
                <td><img src="<?= h($item['product']->image_url) ?>" width="60" alt="Product Image"></td>
                <td><?= h($item['product']->name) ?></td>
                <td>$<?= number_format($item['actual_price'], 2) ?></td>
                <td>$<?= number_format($item['final_price'], 2) ?></td>
                <td><?= number_format($item['quantity'], 0) ?></td>
                <td>$<?= number_format($subtotal, 2) ?></td>
            </tr>
        <?php endforeach; ?>
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="4" class="text-end">Total</th>
                    <th colspan="2">$<?= number_format($total, 2) ?></th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-body">
            <div id="checkout-container">
                <h3 class="mb-3">Customer Details</h3>
                <?= $this->Form->create(null, [
                    'id' => 'order-form',
                    'url' => false,
                    'type' => 'post',
                    'data-remote' => true
                ]) ?>

                <div class="row g-3">
                    <div class="col-md-6">
                        <?= $this->Form->control('name', ['label' => 'Full Name', 'class' => 'form-control', 'required' => true]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('email', ['label' => 'Email', 'class' => 'form-control', 'type' => 'email', 'required' => true]) ?>
                    </div>
                    <div class="col-md-12">
                        <?= $this->Form->control('address', ['label' => 'Address', 'class' => 'form-control', 'required' => true]) ?>
                    </div>
                </div>

                <div class="form-group mt-4">
                    <?= $this->Form->control('delivery_method', [
                        'label' => 'Delivery Method',
                        'type' => 'select',
                        'options' => ['pickup' => 'Pickup', 'delivery' => 'Delivery'],
                        'empty' => 'Select...',
                        'class' => 'form-control',
                        'required' => true
                    ]) ?>
                </div>

                <br>
                <br>

                <div id="payment-message"></div>
                <h3 class="mb-3">Payment</h3>
                <!-- Stripe payment element will be mounted here -->
                <div id="payment-element"></div>

                <!-- Loading indicator -->
                <div id="loading-indicator" class="mt-3 text-center" style="display: none;">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p>Processing payment...</p>
                </div>

                <div class="mt-4 d-flex">
                    <div class="ms-auto d-flex flex-wrap gap-2">
                        <button id="submit-button" type="submit" class="btn btn-success">
                            Pay Now
                        </button>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
<br>
<br>

<script src="https://js.stripe.com/v3/"></script>
<script>
    // Log URLs for debugging
    console.log('Stripe URL:', "<?= $STRIPE_CHECKOUT_URL ?>");
    console.log('Place Order URL:', "<?= $PLACE_ORDER_URL ?>");
    console.log('Thank You URL:', "<?= $THANK_YOU_URL ?>");

    const STRIPE_CHECKOUT_URL = "<?= $STRIPE_CHECKOUT_URL ?>";
    const PLACE_ORDER_URL = "<?= $PLACE_ORDER_URL ?>";
    const THANK_YOU_URL = "<?= $THANK_YOU_URL ?>";
    const CART_TOTAL = <?= number_format($total, 2, '.', '') ?>; // Format with 2 decimal places
</script>
<?= $this->Html->script('stripe_checkout.js') ?>
</body>
</html>
