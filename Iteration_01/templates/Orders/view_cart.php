<?php
$total = 0;
foreach ($cartItems as $item) {
    $product = $item['product'];
    $actualPrice = $product->wholesale_price;
    $finalPrice = $product->final_price;

    // Calculate subtotal using final price
    $subtotal = $item['quantity'] * $finalPrice;
    $total += $subtotal;
}
?>

<div class="container mt-5">
    <div class="d-flex flex-wrap gap-2">
        <a href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'shop']) ?>" class="btn btn-primary">
            <i class="fas fa-arrow-left me-2"></i>Continue Shopping
        </a>
    </div>
    <br>
    <div class="card shadow-sm">
        <div class="card-body">
            <h2 class="mb-4">Your Cart</h2>

            <?php if (empty($cartItems)): ?>
                <p>Your cart is empty.</p>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="thead-light">
                        <tr>
                            <th>Product</th>
                            <th>Name</th>
                            <th>Actual Price</th>
                            <th>Discounted Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($cartItems as $item): ?>
                            <?php
                            $product = $item['product'];
                            $actualPrice = $product->wholesale_price;
                            $finalPrice = $product->final_price;
                            $subtotal = $item['quantity'] * $finalPrice;
                            ?>
                            <tr>
                                <td>
                                    <img src="<?= h($product->image_url) ?>" alt="Product Image" width="60" class="img-thumbnail">
                                </td>
                                <td><?= h($product->name) ?></td>
                                <td>
                                    <span>$<?= number_format($actualPrice, 2) ?></span>
                                </td>
                                <td>
                                    <?php if ($finalPrice < $actualPrice): ?>
                                        <span class="text-danger">$<?= number_format($finalPrice, 2) ?> (Discounted)</span>
                                    <?php else: ?>
                                        <span>$<?= number_format($finalPrice, 2) ?></span>
                                    <?php endif; ?>
                                </td>
                                <td><?= number_format($item['quantity'], 0) ?></td>
                                <td>$<?= number_format($subtotal, 2) ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a href="<?= $this->Url->build(['controller' => 'Orders', 'action' => 'updateQuantity', $product->id, 'decrease']) ?>" class="btn btn-sm btn-outline-secondary me-1">−</a>
                                        <input type="text" value="<?= $item['quantity'] ?>" readonly class="form-control text-center mx-1" style="width: 50px;">
                                        <a href="<?= $this->Url->build(['controller' => 'Orders', 'action' => 'updateQuantity', $product->id, 'increase']) ?>" class="btn btn-sm btn-outline-secondary ms-1">+</a>
                                        <a href="<?= $this->Url->build(['controller' => 'Orders', 'action' => 'removeFromCart', $product->id]) ?>" class="btn btn-sm btn-danger ms-2" onclick="return confirm('Are you sure you want to remove this item from your cart?');">Remove</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="5" class="text-end">Total</th>
                            <th colspan="2">$<?= number_format($total, 2) ?></th>
                        </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="mt-4 d-flex">
                    <div class="ms-auto d-flex flex-wrap gap-2">
                        <?= $this->Html->link('Checkout', ['controller' => 'Orders', 'action' => 'cart_payment'], ['class' => 'btn btn-success']) ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
