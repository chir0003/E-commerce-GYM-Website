<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order $order
 * @var \Cake\Collection\CollectionInterface|string[] $products
 */
?>
<?= $this->Html->css('table') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="container mt-5">
    <!-- Action bar -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-black text-white">
                    <h3 class="mb-0"><?= __('Actions') ?></h3>
                </div>
                <div class="card-body">
                    <?= $this->Html->link(__('List Orders'), ['action' => 'index'], ['class' => 'btn btn-outline-primary w-100']) ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Form -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-header bg-warning text-black">
                    <h3 class="mb-0"><?= __('Add Order') ?></h3>
                </div>
                <div class="card-body">
                    <?= $this->Form->create($order, ['class' => 'needs-validation']) ?>
                    <div class="row g-3">
                        <div class="col-md-6"><?= $this->Form->control('total_amount', ['class' => 'form-control']) ?></div>
                        <div class="col-md-6"><?= $this->Form->control('status', ['class' => 'form-control']) ?></div>
                        <div class="col-md-6"><?= $this->Form->control('created_date', ['class' => 'form-control']) ?></div>
                        <div class="col-md-6"><?= $this->Form->control('delivery_method', ['class' => 'form-control']) ?></div>
                        <div class="col-md-6"><?= $this->Form->control('delivery_status', ['class' => 'form-control']) ?></div>
                        <div class="col-md-6"><?= $this->Form->control('delivery_date', ['empty' => true, 'class' => 'form-control']) ?></div>
                        <div class="col-md-12"><?= $this->Form->control('notes', ['class' => 'form-control']) ?></div>
                        <div class="col-md-12"><?= $this->Form->control('products._ids', ['options' => $products, 'class' => 'form-select', 'multiple' => true]) ?></div>
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

<!-- Global styles -->
<style>
    .bg-black {
        background-color: #000 !important;
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

    .table-dark a {
        color: #ffc107;
        text-decoration: none;
    }

    .table-dark a:hover {
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        table th, table td {
            font-size: 12px;
        }

        .btn {
            font-size: 13px;
            padding: 6px 10px;
        }

        .pagination {
            flex-wrap: wrap;
            justify-content: center;
        }
    }
</style>
