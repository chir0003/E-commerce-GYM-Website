<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Appointment> $appointments
 */
?>
<!--FOR TABLE-->
<?= $this->Html->css('table') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!--FOR CALENDAR-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="<?= $this->Url->build('/js/fullcalendar/index.global.min.js') ?>"></script>
<script src="<?= $this->Url->build('/js/calendar.js') ?>"></script>


<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3><?= __('Appointments') ?></h3>
        <div class="d-flex gap-2">
            <a href="<?= $this->Url->build(['controller' => 'Services', 'action' => 'dashboard']) ?>" class="btn btn-warning px-4 py-2">
                <i class="fas fa-house me-2"></i>Back to Admin Dashboard
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-dark">
                <tr>
                    <th>
                        <?= $this->Paginator->sort('id', 'ID') ?>
                        <span class="sort-icon">
                            <i class="fas fa-sort<?= ($this->request->getQuery('sort') === 'id') ?
                                ($this->request->getQuery('direction') === 'asc' ? '-up' : '-down') :
                                '' ?>"></i>
                        </span>
                    </th>
                    <th>
                        <?= $this->Paginator->sort('name', 'Name') ?>
                        <span class="sort-icon">
                            <i class="fas fa-sort<?= ($this->request->getQuery('sort') === 'name') ?
                                ($this->request->getQuery('direction') === 'asc' ? '-up' : '-down') :
                                '' ?>"></i>
                        </span>
                    </th>
                    <th>
                        <?= $this->Paginator->sort('email', 'Email') ?>
                        <span class="sort-icon">
                            <i class="fas fa-sort<?= ($this->request->getQuery('sort') === 'email') ?
                                ($this->request->getQuery('direction') === 'asc' ? '-up' : '-down') :
                                '' ?>"></i>
                        </span>
                    </th>
                    <th><?= __('Phone') ?></th>
                    <th><?= __('Address') ?></th>
                    <th>
                        <?= $this->Paginator->sort('scheduled_date', 'Scheduled Date') ?>
                        <span class="sort-icon">
                            <i class="fas fa-sort<?= ($this->request->getQuery('sort') === 'scheduled_date') ?
                                ($this->request->getQuery('direction') === 'asc' ? '-up' : '-down') :
                                '' ?>"></i>
                        </span>
                    </th>
                    <th>
                        <?= $this->Paginator->sort('status', 'Status') ?>
                        <span class="sort-icon">
                            <i class="fas fa-sort<?= ($this->request->getQuery('sort') === 'status') ?
                                ($this->request->getQuery('direction') === 'asc' ? '-up' : '-down') :
                                '' ?>"></i>
                        </span>
                    </th>
                    <th><?= __('Actions') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($appointments as $appointment): ?>
                    <tr>
                        <td><?= $this->Number->format($appointment->id) ?></td>
                        <td><?= h($appointment->name) ?></td>
                        <td><?= h($appointment->email) ?></td>
                        <td><?= h($appointment->phone) ?></td>
                        <td><?= h($appointment->address) ?></td>
                        <td><?= $this->Time->format($appointment->scheduled_date, 'dd MMM yyyy hh:mm a') ?></td>
                        <td><?= h($appointment->status) ?></td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <?= $this->Html->link(__('View'), ['action' => 'view', $appointment->id], ['class' => 'btn btn-warning']) ?>
                                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $appointment->id], [
                                    'confirm' => __('Are you sure you want to delete Appointment #{0}?', $appointment->id),
                                    'class' => 'btn btn-outline-danger'
                                ]) ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mt-3">
        <ul class="pagination mb-0">
            <?= $this->Paginator->first('<i class="fas fa-angle-double-left"></i>', [
                'escape' => false,
                'templates' => [
                    'first' => '<li class="page-item first"><a class="page-link" href="{{url}}">{{text}}</a></li>',
                    'firstDisabled' => '<li class="page-item first disabled"><span class="page-link">{{text}}</span></li>'
                ]
            ]) ?>
            <?= $this->Paginator->prev('<i class="fas fa-angle-left"></i>', [
                'escape' => false,
                'templates' => ['prevActive' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>', 'prevDisabled' => '<li class="page-item disabled"><span class="page-link">{{text}}</span></li>']
            ]) ?>
            <?= $this->Paginator->numbers([
                'templates' => [
                    'number' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
                    'current' => '<li class="page-item active"><span class="page-link">{{text}}</span></li>',
                ]
            ]) ?>
            <?= $this->Paginator->next('<i class="fas fa-angle-right"></i>', [
                'escape' => false,
                'templates' => ['nextActive' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>', 'nextDisabled' => '<li class="page-item disabled"><span class="page-link">{{text}}</span></li>']
            ]) ?>
            <?= $this->Paginator->last('<i class="fas fa-angle-double-right"></i>', [
                'escape' => false,
                'templates' => [
                    'last' => '<li class="page-item last"><a class="page-link" href="{{url}}">{{text}}</a></li>',
                    'lastDisabled' => '<li class="page-item last disabled"><span class="page-link">{{text}}</span></li>'
                ]
            ]) ?>
        </ul>
        <div class="text-muted small">
            <?= $this->Paginator->counter(
                __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')
            ) ?>
        </div>
    </div>

    <div id="calendar" style="height: 600px; margin-top: 30px;" class="mb-5"></div>
</div>
<br>



<style>
    .pagination li a {
        display: block;
        padding: 0.5rem 0.75rem;
        margin-left: -1px;
        line-height: 1.25;
        color: #007bff;
        background-color: #fff;
        border: 1px solid #dee2e6;
    }
</style>

