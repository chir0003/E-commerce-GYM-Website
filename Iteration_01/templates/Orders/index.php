<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Order> $orders
 */
?>
<?= $this->Html->css('table') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3><?= __('Orders') ?></h3>
        <div class="d-flex gap-2">
            <a href="<?= $this->Url->build(['controller' => 'Services', 'action' => 'dashboard']) ?>"
               class="btn btn-warning px-4 py-2">
                <i class="fas fa-house me-2"></i>
                <?= __('Back to Admin Dashboard') ?>
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-dark">
                <tr>
                    <th>
                        <?= $this->Paginator->sort('id', 'Order ID') ?>
                        <span class="sort-icon">
                                <i class="fas fa-sort<?= ($this->request->getQuery('sort') === 'id')
                                    ? ($this->request->getQuery('direction') === 'asc' ? '-up' : '-down')
                                    : '' ?>"></i>
                            </span>
                    </th>
                    <th>
                        <?= $this->Paginator->sort('customer_id', 'Customer ID') ?>
                        <span class="sort-icon">
                                <i class="fas fa-sort<?= ($this->request->getQuery('sort') === 'customer_id')
                                    ? ($this->request->getQuery('direction') === 'asc' ? '-up' : '-down')
                                    : '' ?>"></i>
                            </span>
                    </th>
                    <th>
                        <?= $this->Paginator->sort('customer_name', 'Customer Name') ?>
                        <span class="sort-icon">
                                <i class="fas fa-sort<?= ($this->request->getQuery('sort') === 'customer_name')
                                    ? ($this->request->getQuery('direction') === 'asc' ? '-up' : '-down')
                                    : '' ?>"></i>
                            </span>
                    </th>
                    <th>
                        <?= $this->Paginator->sort('total_amount', 'Total Amount') ?>
                        <span class="sort-icon">
                                <i class="fas fa-sort<?= ($this->request->getQuery('sort') === 'total_amount')
                                    ? ($this->request->getQuery('direction') === 'asc' ? '-up' : '-down')
                                    : '' ?>"></i>
                            </span>
                    </th>
                    <th>
                        <?= $this->Paginator->sort('status', 'Order Status') ?>
                        <span class="sort-icon">
                                <i class="fas fa-sort<?= ($this->request->getQuery('sort') === 'status')
                                    ? ($this->request->getQuery('direction') === 'asc' ? '-up' : '-down')
                                    : '' ?>"></i>
                            </span>
                    </th>
                    <th><?= __('Email Status') ?></th>
                    <th>
                        <?= $this->Paginator->sort('created_date', 'Created Date') ?>
                        <span class="sort-icon">
                                <i class="fas fa-sort<?= ($this->request->getQuery('sort') === 'created_date')
                                    ? ($this->request->getQuery('direction') === 'asc' ? '-up' : '-down')
                                    : '' ?>"></i>
                            </span>
                    </th>
                    <th>
                        <?= $this->Paginator->sort('delivery_method', 'Delivery Method') ?>
                        <span class="sort-icon">
                                <i class="fas fa-sort<?= ($this->request->getQuery('sort') === 'delivery_method')
                                    ? ($this->request->getQuery('direction') === 'asc' ? '-up' : '-down')
                                    : '' ?>"></i>
                            </span>
                    </th>
                    <th>
                        <?= $this->Paginator->sort('delivery_status', 'Delivery Status') ?>
                        <span class="sort-icon">
                                <i class="fas fa-sort<?= ($this->request->getQuery('sort') === 'delivery_status')
                                    ? ($this->request->getQuery('direction') === 'asc' ? '-up' : '-down')
                                    : '' ?>"></i>
                            </span>
                    </th>
                    <th>
                        <?= $this->Paginator->sort('delivery_date', 'Delivery Date') ?>
                        <span class="sort-icon">
                                <i class="fas fa-sort<?= ($this->request->getQuery('sort') === 'delivery_date')
                                    ? ($this->request->getQuery('direction') === 'asc' ? '-up' : '-down')
                                    : '' ?>"></i>
                            </span>
                    </th>
                    <th>
                        <?= $this->Paginator->sort('stripe_payment_id', 'Stripe Payment ID') ?>
                        <span class="sort-icon">
                                <i class="fas fa-sort<?= ($this->request->getQuery('sort') === 'stripe_payment_id')
                                    ? ($this->request->getQuery('direction') === 'asc' ? '-up' : '-down')
                                    : '' ?>"></i>
                            </span>
                    </th>
                    <th><?= __('Actions') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($orders as $order): ?>
                    <?php
                    $rowClass = $order->status === 'email_failed' ? 'table-danger' : '';
                    ?>
                    <tr class="<?= $rowClass ?>">
                        <td><?= $this->Number->format($order->id) ?></td>
                        <td><?= h($order->customer->id) ?></td>
                        <td><?= h($order->customer->name . ' ' . $order->customer->last_name) ?></td>
                        <td>$<?= $this->Number->format($order->total_amount) ?></td>
                        <td><?= h($order->status) ?></td>
                        <td>
                            <?php if ($order->status === 'email_failed'): ?>
                                <span class="text-danger"><?= __('Failed') ?></span>
                            <?php else: ?>
                                <span class="text-success"><?= __('OK') ?></span>
                            <?php endif; ?>
                        </td>
                        <td><?= h($order->created_date) ?></td>
                        <td><?= h($order->delivery_method) ?></td>
                        <td><?= h($order->delivery_status) ?></td>
                        <td><?= h($order->delivery_date) ?></td>
                        <td><?= h($order->stripe_payment_id) ?></td>
                        <td>
                            <div class="btn-group" role="group">
                                <?= $this->Html->link(
                                    __('View'),
                                    ['action' => 'view', $order->id],
                                    ['class' => 'btn btn-warning btn-sm']
                                ) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['action' => 'delete', $order->id],
                                    [
                                        'confirm' => __('Are you sure you want to delete Order #{0}?', $order->id),
                                        'class' => 'btn btn-outline-danger btn-sm'
                                    ]
                                ) ?>
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
