<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Service $service
 */
?>

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
                            <div class="col-md-4">
                                <?= $this->Form->postLink(__('Delete Service'), ['action' => 'delete', $service->id], [
                                    'confirm' => __('Are you sure you want to delete Service #{0} {1}?', $service->id, $service->name),
                                    'class' => 'btn btn-outline-danger w-100'
                                ]) ?>
                            </div>
                            <div class="col-md-4">
                                <?= $this->Html->link(__('List Services'), ['action' => 'index'], ['class' => 'btn btn-warning w-100']) ?>
                            </div>
                            <div class="col-md-4">
                                <?= $this->Html->link(__('New Service'), ['action' => 'add'], ['class' => 'btn btn-warning w-100']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-warning text-black">
            <h3 class="mb-0">Service #<?= h($service->id) ?> Details</h3>
        </div>
        <div class="card-body">
            <!-- Service Info -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <h5 class="mb-3">Service Information</h5>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Name:</strong> <?= h($service->name) ?></li>
                        <li class="list-group-item"><strong>Description:</strong> <?= h($service->description) ?></li>
                        <li class="list-group-item"><strong>Price (per hour):</strong> $<?= h($service->price) ?></li>
                    </ul>
                </div>
            </div>
            <hr>

            <!-- Update Form -->
            <h5 class="mb-3">Update Service</h5>
            <?= $this->Form->create($service) ?>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <?= $this->Form->control('name', [
                        'label' => 'Service Name',
                        'class' => 'form-control'
                    ]) ?>
                </div>

                <div class="col-md-4 mb-3">
                    <?= $this->Form->control('description', [
                        'label' => 'Service Description',
                        'class' => 'form-control'
                    ]) ?>
                </div>

                <div class="col-md-4 mb-3">
                    <?= $this->Form->control('price', [
                        'type' => 'number',
                        'step' => '0.01',
                        'label' => 'Price (per hour)',
                        'class' => 'form-control'
                    ]) ?>
                </div>
            </div>


            <div class="d-grid">
                <?= $this->Form->button('Update Service', ['class' => 'btn btn-success btn-lg']) ?>
                <?= $this->Form->end() ?>
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
