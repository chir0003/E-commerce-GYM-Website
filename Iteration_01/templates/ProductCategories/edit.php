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


            </div>
        </div>

        <br>

    <!-- Edit Form -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-black">
                    <h3 class="mb-0">Edit Product Category</h3>
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
                        <?= $this->Form->button(__('Update Category'), ['class' => 'btn btn-success btn-lg']) ?>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
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
