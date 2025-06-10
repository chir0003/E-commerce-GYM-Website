<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ContactForm $contactForm
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
                            <div class="col-md-6">
                                <?= $this->Form->postLink(__('Delete Customer Inquiry'), ['action' => 'delete', $contactForm->id], [
                                    'confirm' => __('Are you sure you want to delete Customer Inquiry #{0} ?', $contactForm->id),
                                    'class' => 'btn btn-outline-danger w-100'
                                ]) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $this->Html->link(__('List Contact Forms'), ['action' => 'index'], ['class' => 'btn btn-warning w-100']) ?>
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
            <h3 class="mb-0">Contact Form #<?= h($contactForm->id) ?> Details</h3>
        </div>

        <div class="card-body">
            <!-- Service Info -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <h5 class="mb-3">Contact Form Details</h5>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Customer Name:</strong> <?= h($contactForm->name) ?></li>
                        <li class="list-group-item">
                            <strong>Customer Email:</strong>
                            <?= h($contactForm->email) ?>
                            <i class="fas fa-copy ms-2" style="cursor: pointer;" onclick="copyEmail()" title="Copy email"></i>
                            <span id="copyMessage" class="ms-2 text-success" style="opacity: 0; transition: opacity 0.3s;">Copied!</span>
                        </li>
                        <li class="list-group-item"><strong>Message:</strong> <?= h($contactForm->message) ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<script>
    function copyEmail() {
        const email = '<?= h($contactForm->email) ?>';
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



<!-- Modal Structure (This will automatically appear when the page loads) -->
<!--<div class="modal fade show" id="contactFormModal" tabindex="-1" aria-labelledby="contactFormModalLabel" aria-hidden="true" style="display: block; background: rgba(0, 0, 0, 0.5);">-->
<!--    <div class="modal-dialog modal-dialog-centered modal-lg"> -->
<!--        <div class="modal-content">-->
            <!-- Modal Header -->
<!--            <div class="modal-header">-->
<!--                <h5 class="modal-title" id="contactFormModalLabel">--><?php //= h($contactForm->name) ?><!--</h5>-->
<!--                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
<!--            </div>-->
            <!-- Modal Body -->
<!--            <div class="modal-body">-->
                <!-- Contact Form Details (Displayed outside a table) -->
<!--                <div class="contact-details">-->
<!--                    <p><strong>--><?php //= __('Name:') ?><!--</strong> --><?php //= h($contactForm->name) ?><!--</p>-->
<!--                    <p><strong>--><?php //= __('Email:') ?><!--</strong> --><?php //= h($contactForm->email) ?><!--</p>-->
<!--                    <p><strong>--><?php //= __('Created At:') ?><!--</strong> --><?php //= h($contactForm->created) ?><!--</p>-->
<!--                </div>-->

                <!-- Message Section -->
<!--                <div class="text mt-4">-->
<!--                    <strong>--><?php //= __('Message') ?><!--</strong>-->
<!--                    <blockquote class="blockquote text-dark bg-light p-3 rounded">-->
<!--                        --><?php //= $this->Text->autoParagraph(h($contactForm->message)); ?>
<!--                    </blockquote>-->
<!--                </div>-->
<!--            </div>-->
            <!-- Modal Footer -->
<!--            <div class="modal-footer">-->
                <!-- Delete Button -->
<!--                --><?php //= $this->Form->postLink(__('Delete Contact Form'), ['action' => 'delete', $contactForm->id], [
//                    'confirm' => __('Are you sure you want to delete {0}?', h($contactForm->name)),
//                    'class' => 'btn btn-danger'
//                ]) ?>
                <!-- Close Button (Redirect to contact-form page) -->
<!--                <a href="--><?php //= $this->Url->build(['controller' => 'ContactForms', 'action' => 'index']) ?><!--" class="btn btn-secondary">--><?php //= __('Close') ?><!--</a>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<!-- Link to the CSS file (Theme-related styles) -->
<?php //= $this->Html->css(['view']) ?>

<!-- Bootstrap JS and Popper.js (Make sure to include these for modal functionality) -->
<?php //= $this->Html->script(['https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js']) ?>
