<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Appointment $appointment
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
                                <?= $this->Form->postLink(__('Delete Appointment'), ['action' => 'delete', $appointment->id], [
                                    'confirm' => __('Are you sure you want to delete Appointment #{0} {1}?', $appointment->id, $appointment->name),
                                    'class' => 'btn btn-outline-danger w-100'
                                ]) ?>
                            </div>
                            <div class="col-md-4">
                                <?= $this->Html->link(__('List Appointments'), ['action' => 'index'], ['class' => 'btn btn-warning w-100']) ?>
                            </div>
                            <div class="col-md-4">
                                <?= $this->Html->link(__('New Appointment'), ['action' => 'add'], ['class' => 'btn btn-warning w-100']) ?>
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
            <h3 class="mb-0">Appointment #<?= h($appointment->id) ?> Details</h3>
        </div>

        <div class="card-body">
            <!-- Customer & Appointment Info -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5 class="mb-3">Customer Details</h5>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Name:</strong> <?= h($appointment->name) ?></li>
                        <li class="list-group-item">
                            <strong>Email:</strong>
                            <?= h($appointment->email) ?>
                            <i class="fas fa-copy ms-2" style="cursor: pointer;" onclick="copyEmail()" title="Copy email"></i>
                            <span id="copyMessage" class="ms-2 text-success" style="opacity: 0; transition: opacity 0.3s;">Copied!</span>
                        </li>
                        <li class="list-group-item"><strong>Phone:</strong> <?= h($appointment->phone) ?></li>
                        <li class="list-group-item"><strong>Address:</strong> <?= h($appointment->address) ?></li>
                    </ul>
                </div>

                <div class="col-md-6">
                    <h5 class="mb-3">Appointment Details</h5>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Created Date:</strong> <?= h($appointment->created_date) ?></li>
                        <li class="list-group-item"><strong>Scheduled Date:</strong> <?= h($appointment->scheduled_date) ?></li>
                        <li class="list-group-item"><strong>Status:</strong> <?= h($appointment->status) ?></li>
                        <li class="list-group-item"><strong>Requested Service:</strong> ID<?= h($appointment->service->id) ?> - <?= h($appointment->service->name) ?></li>
                        <li class="list-group-item"><strong>Notes:</strong> <?= h($appointment->notes) ?></li>
                    </ul>
                </div>
            </div>

            <hr>

            <!-- Update Form -->
            <h5 class="mb-3">Update Appointment</h5>
            <?= $this->Form->create($appointment) ?>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <?= $this->Form->control('status', [
                        'class' => 'form-select',
//                        'type' => 'select',
                        'options' => [
                            'processing' => 'Processing',
                            'confirmed' => 'Confirmed',
                            'in progress' => 'In Progress',
                            'completed' => 'Completed'
                        ],
                        'label' => 'Appointment Status:'
                    ]) ?>
                </div>
                <div class="col-md-4 mb-3">
                    <?= $this->Form->control('scheduled_date', [
                        'type' => 'datetime-local', // Changed from 'date' to 'datetime-local'
                        'label' => 'Scheduled Date:',
                        'value' => $appointment->scheduled_date->format('Y-m-d\TH:i'), // Format the date for datetime-local input
                        'class' => 'form-control',
                        'required' => true,
                        'min' => date('Y-m-d\TH:i')
                    ]) ?>
                </div>
                <div class="col-md-4 mb-3">
                    <?= $this->Form->control('service_id', [
//                        'type' => 'datetime-local', // Changed from 'date' to 'datetime-local'
                        'label' => 'Requested Service:',
//                        'value' => $appointment->scheduled_date->format('Y-m-d\TH:i'), // Format the date for datetime-local input
                        'class' => 'form-select',
//                        'required' => true,
//                        'min' => date('Y-m-d\TH:i')
                    ]) ?>
                </div>
            </div>

            <div class="mb-3">
                <?= $this->Form->control('notes', [
                    'type' => 'textarea',
                    'label' => 'Appointment Notes:',
                    'class' => 'form-control',
                    'rows' => 4,
                    'placeholder' => 'Add any relevant notes about this appointment...'
                ]) ?>
            </div>

            <div class="d-grid">
                <?= $this->Form->button('Update Appointment', ['class' => 'btn btn-success btn-lg']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
<br>

<script>
    function copyEmail() {
        const email = '<?= h($appointment->email) ?>';
        const copyMessage = document.getElementById('copyMessage');

        navigator.clipboard.writeText(email).then(function() {
            copyMessage.style.opacity = '1';
            setTimeout(() => {
                copyMessage.style.opacity = '0';
            }, 1000);
        });
    }
</script>

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
