<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Product> $products
 */
?>
<?= $this->Html->css('table') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3><?= __('Products') ?></h3>
        <div class="d-flex gap-2">
            <?= $this->Html->link(__('New Product'), ['action' => 'add'], ['class' => 'btn btn-warning px-4 py-2']) ?>
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
                        <?= $this->Paginator->sort('category', 'Category') ?>
                        <span class="sort-icon">
                            <i class="fas fa-sort<?= ($this->request->getQuery('sort') === 'category') ?
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
                        <?= $this->Paginator->sort('stock', 'Stock') ?>
                        <span class="sort-icon">
                            <i class="fas fa-sort<?= ($this->request->getQuery('sort') === 'stock') ?
                                ($this->request->getQuery('direction') === 'asc' ? '-up' : '-down') :
                                '' ?>"></i>
                        </span>
                    </th>
                    <th>
                        <?= $this->Paginator->sort('retail_price', 'Retail Price') ?>
                        <span class="sort-icon">
                            <i class="fas fa-sort<?= ($this->request->getQuery('sort') === 'retail_price') ?
                                ($this->request->getQuery('direction') === 'asc' ? '-up' : '-down') :
                                '' ?>"></i>
                        </span>
                    </th>
                    <th>
                        <?= $this->Paginator->sort('name', 'Wholesale Price') ?>
                        <span class="sort-icon">
                            <i class="fas fa-sort<?= ($this->request->getQuery('sort') === 'wholesale_price') ?
                                ($this->request->getQuery('direction') === 'asc' ? '-up' : '-down') :
                                '' ?>"></i>
                        </span>
                    </th>
                    <th>
                        <?= $this->Paginator->sort('discount_percent', 'Discount %') ?>
                        <span class="sort-icon">
                            <i class="fas fa-sort<?= ($this->request->getQuery('sort') === 'discount_percent') ?
                                ($this->request->getQuery('direction') === 'asc' ? '-up' : '-down') :
                                '' ?>"></i>
                        </span>
                    </th>
                    <th>
                        <?= $this->Paginator->sort('gst_percentage', 'GST %') ?>
                        <span class="sort-icon">
                            <i class="fas fa-sort<?= ($this->request->getQuery('sort') === 'gst_percentage') ?
                                ($this->request->getQuery('direction') === 'asc' ? '-up' : '-down') :
                                '' ?>"></i>
                        </span>
                    </th>
                    <th>
                        <?= $this->Paginator->sort('gst_amount', 'GST Amount') ?>
                        <span class="sort-icon">
                            <i class="fas fa-sort<?= ($this->request->getQuery('sort') === 'gst_amount') ?
                                ($this->request->getQuery('direction') === 'asc' ? '-up' : '-down') :
                                '' ?>"></i>
                        </span>
                    </th>
                    <th>
                        <?= $this->Paginator->sort('size', 'Size') ?>
                        <span class="sort-icon">
                            <i class="fas fa-sort<?= ($this->request->getQuery('sort') === 'size') ?
                                ($this->request->getQuery('direction') === 'asc' ? '-up' : '-down') :
                                '' ?>"></i>
                        </span>
                    </th>
                    <th>
                        <?= $this->Paginator->sort('color', 'Color') ?>
                        <span class="sort-icon">
                            <i class="fas fa-sort<?= ($this->request->getQuery('color') === 'gst_amount') ?
                                ($this->request->getQuery('direction') === 'asc' ? '-up' : '-down') :
                                '' ?>"></i>
                        </span>
                    </th>
                    <th><?= __('Image') ?></th>
                    <th><?= __('Actions') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= $this->Number->format($product->id) ?></td>
                        <td><?= $product->product_category ? h($product->product_category->category) : '' ?></td>
                        <td><?= h($product->name) ?></td>
                        <td><?= $this->Number->format($product->stock) ?></td>
                        <td>$<?= $this->Number->format($product->retail_price) ?></td>
                        <td>$<?= $this->Number->format($product->wholesale_price) ?></td>
                        <td><?= $this->Number->format($product->discount_percent) ?>%</td>
                        <td><?= $this->Number->format($product->gst_percentage) ?>%</td>
                        <td>$<?= $this->Number->format($product->gst_amount) ?></td>
                        <td><?= h($product->size) ?></td>
                        <td><?= h($product->color) ?></td>
                        <td>
                            <?php if (!empty($product->image_url)): ?>
                                <a href="<?= h($product->image_url) ?>" target="_blank">
                                    <img src="<?= h($product->image_url) ?>" alt="Product Image" style="width: 60px; height: auto; border-radius: 4px;">
                                </a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <?= $this->Html->link(__('View'), ['action' => 'view', $product->id], ['class' => 'btn btn-outline-primary']) ?>
                                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $product->id], ['class' => 'btn btn-outline-warning']) ?>
                                <?= $this->Form->postLink(__('Remove'), ['action' => 'delete', $product->id], [
                                    'confirm' => __('Are you sure you want to Remove this Listing ?', $product->id, $product->name),
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
