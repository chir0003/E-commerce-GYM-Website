<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProductCategory $productCategory
 */
?>
<?= $this->Html->css('table') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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
                                <?= $this->Html->link(__('List Product Categories'), ['action' => 'index'], ['class' => 'btn btn-warning w-100']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>

    <!-- Add Form -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-header bg-warning text-black">
                    <h3 class="mb-0"><?= __('Add Product Category') ?></h3>
                </div>
                <div class="card-body">
                    <?= $this->Form->create($productCategory) ?>
                    <div class="mb-3">
                        <?= $this->Form->control('category', [
                            'label' => 'Category Name',
                            'class' => 'form-control',
                            'placeholder' => 'e.g. gym_equipments'
                        ]) ?>
                    </div>
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

