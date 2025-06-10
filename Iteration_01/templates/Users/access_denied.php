
<div class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="contact-form success-message text-center">
        <h2 class="text-warning">Access Denied</h2> <!-- Change the text color to yellow (using text-warning) -->
        <p class="text-light">This page is restricted to administrators only. If you are an admin, please log in.</p> <!-- Light text for contrast -->

        <a href="<?= $this->Url->build(['controller' => 'Auth', 'action' => 'login']) ?>" class="btn btn-primary">
            Go to Login
        </a>
        <?= $this->Html->css(['custom']) ?>
    </div>
</div>
