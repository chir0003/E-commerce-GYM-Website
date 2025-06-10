<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<?= $this->Html->css('table') ?>
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">-->

<!-- Actions Section -->
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
                            <div class="col-md-12">
                                <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'btn btn-warning w-100']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
<!-- User Details Section -->
    <div class="card shadow-lg">
        <div class="card-header bg-warning text-black">
            <h3 class="mb-0">User #<?= h($user->id) ?> Details</h3>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5 class="mb-3">Account Info</h5>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>User ID:</strong> <?= $this->Number->format($user->id) ?></li>
                        <li class="list-group-item">
                            <strong>Email:</strong>
                            <?= h($user->email) ?>
                            <i class="fas fa-copy ms-2" style="cursor: pointer;" onclick="copyEmail()" title="Copy email"></i>
                            <span id="copyMessage" class="ms-2 text-success" style="opacity: 0; transition: opacity 0.3s;">Copied!</span>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h5 class="mb-3">System Metadata</h5>
                    <ul class="list-group">
                    <li class="list-group-item"><strong>Modified:</strong> <?= h($user->modified) ?></li>
                    <li class="list-group-item"><strong>Created:</strong> <?= h($user->created) ?></li>
                    <li class="list-group-item"><strong>Nonce:</strong> <?= empty($user->nonce) ? 'N/A' : h($user->nonce) ?></li>
                    <li class="list-group-item"><strong>Nonce Expiry:</strong> <?= empty($user->nonce_expiry) ? 'N/A' : h($user->nonce_expiry) ?></li>
                </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<script>
    function copyEmail() {
        const email = '<?= h($user->email) ?>';
        const copyMessage = document.getElementById('copyMessage');

        navigator.clipboard.writeText(email).then(function() {
            copyMessage.style.opacity = '1';
            setTimeout(() => {
                copyMessage.style.opacity = '0';
            }, 1000);
        });
    }
</script>
