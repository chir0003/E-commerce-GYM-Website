<div class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="contact-form success-message text-center">
        <h2 class="text-warning">🎉 Thank you for your enquiry!</h2> <!-- Change the text color to yellow (using text-warning) -->
        <p class="text-light">Your message has been successfully submitted. We will get back to you shortly.</p> <!-- Light text for contrast -->

        <a href="<?= $this->Url->build(['action' => 'add']) ?>" class="btn btn-primary mt-3">
            Submit Another Enquiry
        </a>
        <?= $this->Html->css(['custom']) ?>
    </div>
</div>
