<?php
/**
 * HTML Order Confirmation Email
 * @var \App\Model\Entity\Order $order
 * @var array $items
 * @var string $method
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; border: 1px solid #ddd; text-align: left; }
        @media only screen and (max-width: 600px) {
            th, td { display: block; width: 100%; }
        }
    </style>
</head>
<body>

<h2>Hi <?= h($order->customer->name) ?>,</h2>
<p>Thank you for shopping with PowerProShop! Here are your order details:</p>

<!-- Order meta -->
<table>
    <tr><th>Order #</th><td><?= h($order->id) ?></td></tr>
    <tr><th>Date</th><td><?= h($order->created_date->format('Y-m-d H:i')) ?></td></tr>
    <tr><th>Email</th><td><?= h($order->customer->email) ?></td></tr>
    <tr><th>Shipping Method</th><td><?= h($method ?? 'N/A') ?></td></tr>
    <tr><th>Address / Pickup</th><td><?= h($order->pickup_location ?? $order->customer->address) ?></td></tr>
</table>

<!-- Items list -->
<h3>Your Items</h3>
<table border="1" cellpadding="6" cellspacing="0" width="100%" style="border-collapse: collapse;">
    <thead>
    <tr style="background-color: #f2f2f2;">
        <th>Product</th>
        <th>Qty</th>
        <th>Unit Price</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($items as $item): ?>
        <tr>
            <td><?= h($item['name']) ?></td>
            <td><?= h($item['quantity']) ?></td>
            <td>$<?= number_format($item['price'], 2) ?></td>
            <td>$<?= number_format($item['quantity'] * $item['price'], 2) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<!-- Totals (fake tax/discount fallback if not loaded) -->
<table style="margin-top:20px;">
    <tr><th>Subtotal</th><td>
            $<?= h(number_format($order->total_amount ?? 0, 2)) ?>
        </td></tr>
    <tr><th><strong>Total</strong></th><td><strong>$<?= h(number_format($order->total_amount, 2)) ?></strong></td></tr>
</table>

<p style="margin-top:30px;">
    If you have any questions, contact us at
    <a href="mailto:support@powerproshop.com">support@powerproshop.com</a>.
</p>
<p>We hope to see you again soon!</p>

</body>
</html>
