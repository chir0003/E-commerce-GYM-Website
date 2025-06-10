<?= $this->Html->css('table') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3><?= __('Reviews') ?></h3>
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
                    <th><?= $this->Paginator->sort('id', 'ID') ?></th>
                    <th><?= $this->Paginator->sort('user_id', 'User') ?></th>
                    <th><?= $this->Paginator->sort('product_id', 'Product') ?></th>
                    <th><?= $this->Paginator->sort('rating', 'Rating') ?></th>
                    <th><?= $this->Paginator->sort('status', 'Status') ?></th>
                    <th><?= $this->Paginator->sort('created_date', 'Created Date') ?></th>
                    <th><?= __('Actions') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($reviews as $review): ?>
                    <tr>
                        <td><?= $this->Number->format($review->id) ?></td>
                        <td><?= $review->hasValue('user') ? $this->Html->link($review->user->email, ['controller' => 'Users', 'action' => 'view', $review->user->id]) : '-' ?></td>
                        <td><?= $review->hasValue('product') ? $this->Html->link($review->product->name, ['controller' => 'Products', 'action' => 'view', $review->product->id]) : '-' ?></td>
                        <td><?= $this->Number->format($review->rating) ?> ⭐</td>
                        <td>
                            <?php if ($review->status == 0): ?>
                                <span class="badge bg-warning">Pending</span>
                            <?php else: ?>
                                <span class="badge bg-success">Approved</span>
                            <?php endif; ?>
                        </td>
                        <td><?= h($review->created_date) ?></td>
                        <td>
                            <div class="btn-group btn-group-sm d-flex flex-wrap">
                                <?= $this->Html->link(__('View'), ['action' => 'view', $review->id], ['class' => 'btn btn-warning']) ?>
                                <?php if ($review->status == 0): ?>
                                    <?= $this->Html->link('Approve', ['action' => 'approve', $review->id], ['class' => 'btn btn-warning']) ?>
                                <?php endif; ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['action' => 'delete', $review->id],
                                    [
                                        'confirm' => __('Are you sure you want to delete this review?'),
                                        'class' => 'btn btn-outline-danger'
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
