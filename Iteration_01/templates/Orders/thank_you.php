<div class="container d-flex flex-column align-items-center justify-content-center text-center" style="min-height: 60vh; padding-top: 100px;">
    <div class="card shadow p-4 bg-white text-black" style="max-width: 600px; width: 100%;">
        <h2 class="mb-3">Thank you for your order!</h2>
        <p class="mb-4">We’ll send you a confirmation email shortly.</p>
        <a href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'shop']) ?>" class="btn btn-warning text-dark">
            Back to Shop
        </a>
    </div>
</div>
<?php
// show the last 10 lines of the debug‐transport email log
$path = LOGS . 'email.log';
if (file_exists($path)) {
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $last10 = array_slice($lines, -10);
    echo '<h5>–– last 10 lines of email.log ––</h5>';
    echo '<pre style="max-height:200px;overflow:auto;background:#f8f9fa;padding:10px;border:1px solid #ddd;">'
        . h(implode("\n", $last10))
        . '</pre>';
}
?>
