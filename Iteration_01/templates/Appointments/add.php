<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Appointment $appointment
 * @var \Cake\Collection\CollectionInterface|string[] $services
 */
?>
<!-- Remove Google reCAPTCHA -->
<!-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> -->

<!-- Add Cloudflare Turnstile -->
<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>

<?= $this->Html->script('https://code.jquery.com/jquery-3.6.0.min.js') ?>
<?= $this->Html->script('appointmentValidation') ?>
<?= $this->Html->script('resizeCaptcha'); ?>
<?= $this->Html->css(['custom']) ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-lg p-4">
                <h2 class="text-center mb-4">Book an Appointment</h2>

                <?= $this->Form->create($appointment, ['id' => 'appointment', 'novalidate' => true]) ?>

                <!--HIDDEN Appointment Creation Date-->
                <div class="mb-3">
                    <?= $this->Form->hidden('created_date', ['value' => date('Y-m-d H:i:s')]) ?>
                </div>

                <!--HIDDEN Status-->
                <div class="mb-3">
                    <?= $this->Form->hidden('status', ['value' => 'processing']) ?>
                </div>

                <!--Name-->
                <div class="mb-3">
                    <?= $this->Form->label('name', __('Name:'), ['class' => 'form-label']) ?>
                    <?= $this->Form->control('name', [
                        'class' => 'form-control',
                        'label' => false,
                        'placeholder' => __('John Appleseed')
                    ]) ?>
                </div>

                <!--Email Address-->
                <div class="mb-3">
                    <?= $this->Form->label('email', __('Email Address:'), ['class' => 'form-label']) ?>
                    <?= $this->Form->control('email', [
                        'type' => 'email',
                        'class' => 'form-control',
                        'label' => false,
                        'placeholder' => __('your.email@example.com')
                    ]) ?>
                </div>

                <!--Phone Number-->
                <div class="mb-3">
                    <?= $this->Form->label('phone', __('Phone Number:'), ['class' => 'form-label']) ?>
                    <?= $this->Form->control('phone', [
                        'class' => 'form-control',
                        'label' => false,
                        'placeholder' => __('0412345678')
                    ]) ?>
                </div>

                <!--Appointment Date-->
                <div class="mb-3">
                    <?= $this->Form->label('scheduled_date', __('Appointment Date:'), ['class' => 'form-label']) ?>
                    <?= $this->Form->control('scheduled_date', [
                        'type' => 'datetime-local',
                        'class' => 'form-control',
                        'label' => false,
                        'required' => true,
                        'min' => date('Y-m-d\TH:i')
                    ]) ?>
                </div>

                <!--Address-->
                <div class="mb-3">
                    <?= $this->Form->label('address', __('Address:'), ['class' => 'form-label']) ?>
                    <?= $this->Form->control('address', [
                        'class' => 'form-control',
                        'label' => false,
                        'placeholder' => __('123 McFarlaine Road, Hawthorn VIC 3173')
                    ]) ?>
                </div>

                <!--Requested Service-->
                <div class="mb-3">
                    <?= $this->Form->label('service_id', __('Service Option:'), ['class' => 'form-label']) ?>
                    <?= $this->Form->control('service_id', [
                        'class' => 'form-control',
                        'label' => false,
                        'options' => $services
                    ]) ?>
                </div>

                <!--Additional Notes Service-->
                <div class="mb-3">
                    <?= $this->Form->label('notes', __('Additional Notes:'), ['class' => 'form-label']) ?>
                    <?= $this->Form->control('notes', [
                        'type' => 'textarea',
                        'class' => 'form-control',
                        'rows' => 6,
                        'label' => false,
                        'placeholder' => __('Please enter any additional information here...')
                    ]) ?>
                </div>

                <!-- Cloudflare Turnstile CAPTCHA -->
                <div class="mb-3">
                    <div class="cf-turnstile" data-sitekey="0x4AAAAAAA_U6Q5J3m9hRkYk"></div>
                </div>

                <div class="d-grid">
                    <div class="text-end">
                        <?= $this->Form->button(__('Book Appointment'), ['class' => 'btn btn-primary w-100']) ?>
                    </div>
                </div>
                <?= $this->Form->end() ?>

            </div>
        </div>
    </div>
</div>
<br>
