<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>
<?= $this->Html->css('table') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- Actions -->
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 mb-8">
            <div class="text-end mb-3">
                <a href="<?= $this->Url->build(['controller' => 'Services', 'action' => 'dashboard']) ?>" class="btn btn-warning">
                    <i class="fas fa-house me-2"></i>Back to Admin Dashboard
                </a>
            </div>

            <div class="card shadow-sm">
                <!-- Header with toggle button -->
                <div class="card-header bg-black text-white d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Actions</h3>
                    <button class="btn btn-sm btn-light text-dark toggle-arrow" type="button" data-bs-toggle="collapse" data-bs-target="#actionButtons" aria-expanded="true" aria-controls="actionButtons">
                        <i class="fas fa-chevron-up"></i>
                    </button>
                </div>

                <div class="collapse show" id="actionButtons">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <?= $this->Form->postLink(__('Remove Listing'), ['action' => 'delete', $product->id], [
                                    'confirm' => __('Are you sure you want to Remove this Listing ?', $product->id),
                                    'class' => 'btn btn-outline-danger w-100'
                                ]) ?>
                            </div>
                            <div class="col-md-3">
                                <?= $this->Html->link(__('Edit Product'), ['action' => 'edit', $product->id], ['class' => 'btn btn-warning w-100']) ?>
                            </div>
                            <div class="col-md-3">
                                <?= $this->Html->link(__('List Products'), ['action' => 'index'], ['class' => 'btn btn-warning w-100']) ?>
                            </div>
                            <div class="col-md-3">
                                <?= $this->Html->link(__('New Product'), ['action' => 'add'], ['class' => 'btn btn-warning w-100']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Product Details -->
<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-warning text-black">
            <h3 class="mb-0">PRODUCT #<?= h($product->id) ?> DETAILS</h3>
        </div>

        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-4 text-center">
                    <img src="<?= h($product->image_url ?: '/img/default-product.png') ?>" alt="<?= h($product->name) ?>" class="img-fluid rounded shadow-sm" style="max-height: 280px;">
                </div>
                <div class="col-md-8">
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Name:</strong> <?= h($product->name) ?></li>
                        <li class="list-group-item"><strong>Description:</strong> <?= h($product->description) ?></li>
                        <li class="list-group-item"><strong>Size:</strong> <?= h($product->size) ?></li>
                        <li class="list-group-item"><strong>Color:</strong> <?= h($product->color) ?></li>
                        <li class="list-group-item"><strong>Category:</strong> <?= $product->hasValue('product_category') ? $this->Html->link($product->product_category->category, ['controller' => 'ProductCategories', 'action' => 'view', $product->product_category->id]) : '—' ?></li>
                        <li class="list-group-item"><strong>Stock:</strong>
                            <?php if ($product->stock > 0): ?>
                                <?= $this->Number->format($product->stock) ?>
                                <?php if ($product->stock <= 5): ?>
                                    <span class="text-danger fw-bold ms-2">(Low stock!)</span>
                                <?php endif; ?>
                            <?php else: ?>
                                <span class="text-danger fw-bold">Out of Stock</span>
                            <?php endif; ?>
                        </li>
                        <li class="list-group-item"><strong>Retail Price:</strong> $<?= $this->Number->format($product->retail_price) ?></li>
                        <li class="list-group-item"><strong>Wholesale Price:</strong> $<?= $this->Number->format($product->wholesale_price) ?></li>
                        <li class="list-group-item"><strong>Discount:</strong> <?= $this->Number->format($product->discount_percent) ?>%</li>
                        <li class="list-group-item"><strong>GST %:</strong> <?= $this->Number->format($product->gst_percentage) ?>%</li>
                        <li class="list-group-item"><strong>GST Amount:</strong> $<?= $this->Number->format($product->gst_amount) ?></li>
                        <li class="list-group-item"><strong>Product ID:</strong> <?= $this->Number->format($product->id) ?></li>
                    </ul>
                </div>
            </div>

            <!-- Related Orders -->
            <?php if (!empty($product->orders)) : ?>
                <h5 class="mb-3">Related Orders</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Method</th>
                            <th>Delivery</th>
                            <th>Date</th>
                            <th>Notes</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($product->orders as $order): ?>
                            <tr>
                                <td><?= h($order->id) ?></td>
                                <td>$<?= h($order->total_amount) ?></td>
                                <td><?= h($order->status) ?></td>
                                <td><?= h($order->created_date) ?></td>
                                <td><?= h($order->delivery_method) ?></td>
                                <td><?= h($order->delivery_status) ?></td>
                                <td><?= h($order->delivery_date) ?></td>
                                <td><?= h($order->notes) ?></td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <?= $this->Html->link(__('View'), ['controller' => 'Orders', 'action' => 'view', $order->id], ['class' => 'btn btn-warning']) ?>
                                        <?= $this->Html->link(__('Edit'), ['controller' => 'Orders', 'action' => 'edit', $order->id], ['class' => 'btn btn-warning']) ?>
                                        <?= $this->Form->postLink(__('Remove Listing'), ['controller' => 'Orders', 'action' => 'delete', $order->id], [
                                            'confirm' => __('Are you sure you want to Remove this Listing ?', $order->id),
                                            'class' => 'btn btn-outline-danger'
                                        ]) ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<br>

<script>
    const toggleBtn = document.querySelector('.toggle-arrow');
    const icon = toggleBtn.querySelector('i');
    const target = document.querySelector('#actionButtons');

    target.addEventListener('show.bs.collapse', () => {
        icon.classList.remove('fa-chevron-down');
        icon.classList.add('fa-chevron-up');
    });

    target.addEventListener('hide.bs.collapse', () => {
        icon.classList.remove('fa-chevron-up');
        icon.classList.add('fa-chevron-down');
    });
</script>
