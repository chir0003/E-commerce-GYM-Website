<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProductCategory $productCategory
 */
?>
<?= $this->Html->css('table') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- Actions Section -->
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
                                <?= $this->Html->link(__('Edit Category'), ['action' => 'edit', $productCategory->id], ['class' => 'btn btn-warning w-100']) ?>
                            </div>
                            <div class="col-md-3">
                                <?= $this->Html->link(__('List Categories'), ['action' => 'index'], ['class' => 'btn btn-warning w-100']) ?>
                            </div>
                            <div class="col-md-3">
                                <?= $this->Html->link(__('New Category'), ['action' => 'add'], ['class' => 'btn btn-warning w-100']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <!-- Category Details Section -->
    <div class="card shadow-lg">
        <div class="card-header bg-warning text-black">
            <h3 class="mb-0">Category #<?= h($productCategory->id) ?> Details</h3>
        </div>

        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-12">
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Category Name:</strong> <?= h($productCategory->category) ?></li>
                        <li class="list-group-item"><strong>ID:</strong> <?= $this->Number->format($productCategory->id) ?></li>
                    </ul>
                </div>
            </div>

            <!-- Related Products Table -->
            <?php if (!empty($productCategory->products)) : ?>
                <h5 class="mb-3">Related Products</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Stock</th>
                            <th>Retail Price</th>
                            <th>Wholesale Price</th>
                            <th>GST %</th>
                            <th>GST Amount</th>
                            <th>Size</th>
                            <th>Color</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($productCategory->products as $product) : ?>
                            <tr>
                                <td><?= h($product->id) ?></td>
                                <td><?= h($product->name) ?></td>
                                <td><?= h($product->description) ?></td>
                                <td><?= h($product->stock) ?></td>
                                <td>$<?= h($product->retail_price) ?></td>
                                <td>$<?= h($product->wholesale_price) ?></td>
                                <td><?= h($product->gst_percentage) ?>%</td>
                                <td>$<?= h($product->gst_amount) ?></td>
                                <td><?= h($product->size) ?></td>
                                <td><?= h($product->color) ?></td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <?= $this->Html->link(__('View'), ['controller' => 'Products', 'action' => 'view', $product->id], ['class' => 'btn btn-outline-primary']) ?>
                                        <?= $this->Html->link(__('Edit'), ['controller' => 'Products', 'action' => 'edit', $product->id], ['class' => 'btn btn-outline-warning']) ?>
                                        <?= $this->Form->postLink(__('Delete'), ['controller' => 'Products', 'action' => 'delete', $product->id], [
                                            'confirm' => __('Are you sure you want to delete # {0}?', $product->id),
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
