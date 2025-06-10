<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ContactForm $contactForm
 */
?>

<!-- Load Turnstile -->
<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
<?= $this->Html->script('https://code.jquery.com/jquery-3.6.0.min.js') ?>
<?= $this->Html->script('resizeCaptcha'); ?>

<div class="d-flex flex-column min-vh-100">
    <div class="container mt-5 flex-grow-1 d-flex justify-content-center align-items-center">
        <div class="row justify-content-center w-100">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-lg p-4">
                    <h2 class="text-center mb-4">Get in Touch</h2>

                    <?= $this->Form->create($contactForm, ['id' => 'contactForm', 'novalidate' => true]) ?>

                    <div class="mb-3">
                        <?= $this->Form->label('name', __('Your Name'), ['class' => 'form-label']) ?>
                        <?= $this->Form->control('name', [
                            'class' => 'form-control',
                            'label' => false,
                            'placeholder' => __('Enter your full name')
                        ]) ?>
                    </div>

                    <div class="mb-3">
                        <?= $this->Form->label('email', __('Email Address'), ['class' => 'form-label']) ?>
                        <?= $this->Form->control('email', [
                            'type' => 'email',
                            'class' => 'form-control',
                            'label' => false,
                            'placeholder' => __('your.email@example.com')
                        ]) ?>
                    </div>

                    <div class="mb-3">
                        <?= $this->Form->label('message', __('Your Message'), ['class' => 'form-label']) ?>
                        <?= $this->Form->control('message', [
                            'type' => 'textarea',
                            'class' => 'form-control',
                            'rows' => 6,
                            'label' => false,
                            'placeholder' => __('Write your message here...')
                        ]) ?>
                    </div>

                    <!-- Cloudflare Turnstile Widget -->
                    <div class="cf-turnstile mb-3" data-sitekey="0x4AAAAAAA_U6Q5J3m9hRkYk"></div>

                    <div class="d-grid">
                        <?= $this->Form->button(__('Send Message'), ['class' => 'btn btn-primary w-100']) ?>
                    </div>
                    <?= $this->Form->end() ?>
                    <?= $this->Html->css(['custom']) ?>
                </div>
            </div>
        </div>
    </div>


</div>
