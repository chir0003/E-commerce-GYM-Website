<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-body">
            <h2 class="mb-4">Your Cart</h2>

            <?php if (empty($products)): ?>
                <div class="alert alert-warning text-black bg-warning-subtle">Your cart is empty.</div>
                <?= $this->Html->link('Back to Shop', ['controller' => 'Products', 'action' => 'shop'], ['class' => 'btn btn-yellow']) ?>
            <?php else: ?>
                <!-- Product list -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-dark">
                        <tr>
                            <th>Product</th>
                            <th>Retail Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?= h($product->name) ?></td>
                                <td>$<?= number_format($product->retail_price, 2) ?></td>
                                <td><?= h($product->cart_quantity) ?></td>
                                <td>$<?= number_format($product->subtotal, 2) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Summary -->
                <div class="mt-4">
                    <p><strong>Total Quantity:</strong> <?= $totalQuantity ?></p>
                    <p><strong>Total Price:</strong> $<?= number_format($totalPrice, 2) ?></p>
                </div>

                <!-- Customer information -->
                <div class="mt-4">
                    <h4>Customer Details</h4>
                    <?= $this->Form->create(null, ['url' => ['action' => 'placeOrder']]) ?>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <?= $this->Form->control('customer_name', ['label' => 'Full Name', 'required' => true, 'class' => 'form-control']) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $this->Form->control('address', ['label' => 'Address', 'required' => true, 'class' => 'form-control']) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $this->Form->control('phone', ['label' => 'Phone Number', 'required' => true, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-yellow mt-3">Place Order</button>
                    <?= $this->Form->end() ?>
                </div>

                <!-- Return link -->
                <div class="mt-4">
                    <?= $this->Html->link('Continue Shopping', ['controller' => 'Products', 'action' => 'shop'], ['class' => 'btn btn-yellow']) ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- style-->
<style>
    .table-dark a {
        color: #ffc107;
        text-decoration: none;
    }

    .table-dark a:hover {
        text-decoration: underline;
    }

    .btn-yellow {
        background-color: #ffc107;
        color: black;
        border: none;
        border-radius: 6px;
        font-weight: bold;
        text-transform: uppercase;
    }

    .btn-yellow:hover {
        background-color: #e0a800;
        color: black;
    }

    th a {
        color: white !important;
        text-decoration: none !important;
        font-weight: bold;
    }

    th a:hover {
        text-decoration: underline !important;
        color: #ffc107 !important;
    }

    .btn-yellow {
        background-color: #ffc107;
        color: black;
        border: none;
        border-radius: 6px;
        font-weight: bold;
        text-transform: uppercase;
        transition: background-color 0.3s ease;
    }

    .btn-yellow:hover {
        background-color: #e0a800;
        color: black;
    }

    .table-dark a {
        color: #ffc107;
        text-decoration: none;
    }
    .table-dark a:hover {
        text-decoration: underline;
    }

    /* mobile responsiveness */
    @media (max-width: 768px) {
        th:nth-child(3), td:nth-child(3),  /* Description */
        th:nth-child(7), td:nth-child(7),  /* Discount % */
        th:nth-child(9), td:nth-child(9),  /* GST Amount */
        th:nth-child(10), td:nth-child(10), /* Size */
        th:nth-child(11), td:nth-child(11) /* Color */ {
            display: none;
        }

        td img {
            max-width: 50px;
            height: auto;
        }


        .d-flex.justify-content-between.align-items-center {
            flex-direction: column;
            align-items: stretch !important;
        }

        .d-flex.justify-content-between.align-items-center h3 {
            margin-bottom: 10px;
            text-align: center;
        }


        .pagination {
            flex-wrap: wrap;
            justify-content: center;
        }

        .pagination .page-link {
            margin: 3px;
        }

        table th, table td {
            font-size: 12px;
        }

        .btn {
            font-size: 13px;
            padding: 6px 10px;
        }
    }
</style>
