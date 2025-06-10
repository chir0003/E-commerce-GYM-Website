<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 * @var \Cake\Collection\CollectionInterface|string[] $productCategories
 * @var \Cake\Collection\CollectionInterface|string[] $orders
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
                            <div class="col-md-12">
                                <?= $this->Html->link(__('List Products'), ['action' => 'index'], ['class' => 'btn btn-warning w-100']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>


    <!-- Add Product Form -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-header bg-warning text-black">
                    <h3 class="mb-0"><?= __('Add Product') ?></h3>
                </div>
                <div class="card-body">
                    <?= $this->Form->create($product, ['class' => 'needs-validation']) ?>
                    <div class="row g-3">
                        <div class="col-md-6"><?= $this->Form->control('name', ['class' => 'form-control']) ?></div>
                        <div class="col-md-6"><?= $this->Form->control('description', ['class' => 'form-control']) ?></div>
                        <div class="col-md-4"><?= $this->Form->control('stock', ['class' => 'form-control', 'min' => '0']) ?></div>
                        <div class="col-md-4"><?= $this->Form->control('retail_price', ['class' => 'form-control', 'min' => '0.01']) ?></div>
                        <div class="col-md-4"><?= $this->Form->control('wholesale_price', ['class' => 'form-control', 'min' => '0.01']) ?></div>
                        <div class="col-md-6"><?= $this->Form->control('discount_percent', ['class' => 'form-control', 'required' => false, 'min' => '0.01']) ?></div>
                        <div class="col-md-6"><?= $this->Form->control('gst_percentage', ['class' => 'form-control', 'min' => '0.01']) ?></div>
                        <div class="col-md-6"><?= $this->Form->control('gst_amount', ['class' => 'form-control', 'min' => '0.01']) ?></div>
                        <div class="col-md-6"><?= $this->Form->control('size', ['class' => 'form-control', 'required' => false]) ?></div>
                        <div class="col-md-6"><?= $this->Form->control('color', ['class' => 'form-control']) ?></div>
                        <div class="col-md-6"><?= $this->Form->control('product_category_id', ['options' => $productCategories, 'class' => 'form-select']) ?></div>
                        <div class="col-md-12"><?= $this->Form->control('image_url', ['class' => 'form-control']) ?></div>
                    </div>

                    <!-- Submit -->
                    <div class="mt-4 d-grid">
                        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success btn-lg']) ?>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
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
