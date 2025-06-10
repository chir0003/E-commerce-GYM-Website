<?= $this->Html->css('table') ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 mb-8">
            <div class="text-end mb-3">
                <a href="<?= $this->Url->build(['controller' => 'Services', 'action' => 'dashboard']) ?>" class="btn btn-warning">
                    <i class="fas fa-house me-2"></i>Back to Admin Dashboard
                </a>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-black text-white d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Actions</h3>
                </div>
                <div class="card-body">
                    <div class="d-flex gap-2">
                        <?= $this->Html->link(__('List Reviews'), ['action' => 'index'], ['class' => 'btn btn-warning']) ?>
                        <?= $this->Form->postLink(__('Delete Review'), ['action' => 'delete', $review->id], ['confirm' => __('Are you sure you want to delete This Review ', $review->id), 'class' => 'btn btn-outline-danger']) ?>
                        <?php if ($review->status == 0): ?>
                            <?= $this->Html->link('Approve', ['action' => 'approve', $review->id], ['class' => 'btn btn-warning']) ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-warning text-black">
            <h3 class="mb-0">Review #<?= h($review->id) ?> Details</h3>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5 class="mb-3">Review Info</h5>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>User:</strong> <?= $review->hasValue('user') ? $this->Html->link($review->user->email, ['controller' => 'Users', 'action' => 'view', $review->user->id]) : '-' ?></li>
                        <li class="list-group-item"><strong>Product:</strong> <?= $review->hasValue('product') ? $this->Html->link($review->product->name, ['controller' => 'Products', 'action' => 'view', $review->product->id]) : '-' ?></li>
                        <li class="list-group-item"><strong>Rating:</strong> <?= $this->Number->format($review->rating) ?> ⭐</li>
                        <li class="list-group-item"><strong>Created Date:</strong> <?= h($review->created_date) ?></li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h5 class="mb-3">Review Text</h5>
                    <blockquote class="blockquote">
                        <?= $this->Text->autoParagraph(h($review->review_text)); ?>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
