<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Service $service
 */
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="container mt-5">
    <!-- Action Bar -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-black text-white">
                    <h3 class="mb-0">Actions</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <?= $this->Form->postLink(
                                __('Delete Service'),
                                ['action' => 'delete', $service->id],
                                [
                                    'confirm' => __('Are you sure you want to delete # {0}?', $service->id),
                                    'class' => 'btn btn-outline-danger w-100'
                                ]
                            ) ?>
                        </div>
                        <div class="col-md-6 mb-2">
                            <?= $this->Html->link(__('List Services'), ['action' => 'index'], ['class' => 'btn btn-outline-primary w-100']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Service Form -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-black">
                    <h3 class="mb-0">Edit Service</h3>
                </div>
                <div class="card-body">
                    <?= $this->Form->create($service) ?>
                    <div class="row g-3">
                        <div class="col-md-7">
                            <?= $this->Form->control('name', [
                                'class' => 'form-control',
                                'label' => 'Service Name:'
                            ]) ?>
                        </div>
                        <div class="col-md-7">
                            <?= $this->Form->control('description', [
                                'class' => 'form-control',
                                'label' => 'Service Description:'
                            ]) ?>
                        </div>
                        <div class="col-md-7">
                            <?= $this->Form->control('price', [
                                'class' => 'form-control',
                                'label' => 'Price (per hour): $'
                            ]) ?>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-4 d-grid">
                        <?= $this->Form->button(__('Update Service'), ['class' => 'btn btn-success btn-lg']) ?>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Unified Styles -->
<style>
    .btn-yellow {
        background-color: #ffc107;
        color: black;
        font-weight: bold;
        border-radius: 6px;
        text-transform: uppercase;
        transition: background-color 0.3s ease;
        border: none;
    }

    .btn-yellow:hover {
        background-color: #e0a800;
    }

    .bg-black {
        background-color: #000 !important;
    }

    .table-dark a {
        color: #ffc107;
        text-decoration: none;
    }

    .table-dark a:hover {
        text-decoration: underline;
    }

    th a {
        color: white !important;
        font-weight: bold;
        text-decoration: none !important;
    }

    th a:hover {
        text-decoration: underline !important;
        color: #ffc107 !important;
    }

    @media (max-width: 768px) {
        .btn {
            font-size: 13px;
            padding: 6px 10px;
        }
    }
</style>
