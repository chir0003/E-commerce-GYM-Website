<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\ContentBlocks\Model\Entity\ContentBlock> $contentBlocksGrouped
 */

$this->assign('title', 'Content Blocks');

$this->Html->css('ContentBlocks.content-blocks', ['block' => true]);

$slugify = function($text) {
    return preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower(trim($text)));
};

$identity = $this->Identity->get(); // Get the identity object
if (!$identity || $identity->user_type_id !== 2) { // Replace 'user_type_id' and 2 with your actual admin check
    // $this->Flash->error(__('You are not authorized to access this page.'));

    // Redirect to the homepage
    $url = $this->Url->build([
            'controller' => 'Users',
            'action' => 'accessDenied',
            'plugin' => null,
            'prefix' => false // Add this line
        ]);
    // Redirect to the accessDenied page
    header('Location: ' . $url);
    exit();
}
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0 bg-warning text-dark p-3 rounded"><?= __('Content Blocks') ?></h2>

        <!-- Go Back Button -->
        <div>
            <?= $this->Html->link(__('Go Back to Admin Dashboard'), ['controller' => 'Services', 'action' => 'dashboard','plugin' => null], ['class' => 'btn btn-warning']) ?>
        </div>
    </div>

    <div class="mb-3">
        <h5>Quick Links</h5>
        <nav class="nav flex-wrap">
            <?php foreach (array_keys($contentBlocksGrouped) as $parent) { ?>
                <a class="nav-link px-2 py-1" href="#<?= $slugify($parent) ?>"><?= $parent ?></a>
            <?php } ?>
        </nav>
    </div>

    <?php foreach ($contentBlocksGrouped as $parent => $contentBlocks) { ?>
        <div class="card mb-4">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0">
                    <a href="#<?= $slugify($parent) ?>" id="<?= $slugify($parent) ?>" class="text-dark text-decoration-none">
                        <?= $parent ?>
                    </a>
                </h4>
            </div>

            <ul class="list-group list-group-flush">
                <?php foreach ($contentBlocks as $contentBlock) { ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1"><?= h($contentBlock['label']) ?></h5>
                            <p class="mb-0 text-muted"><?= h($contentBlock['description']) ?></p>
                        </div>
                        <div>
                            <?= $this->Html->link(
                                __('Edit'),
                                ['action' => 'edit', $contentBlock->id],
                                ['class' => 'btn btn-sm btn-warning me-2']
                            ) ?>

                            <?php if (!empty($contentBlock->previous_value)) { ?>
                                <?= $this->Form->postLink(
                                    __('Restore'),
                                    ['action' => 'restore', $contentBlock->id],
                                    [
                                        'class' => 'btn btn-sm btn-secondary',
                                        'confirm' => __("Are you sure you want to restore the previous version for this item?\n{0}/{1}\nNote: You cannot cancel this action!", $contentBlock->parent, $contentBlock->slug)
                                    ]
                                ) ?>
                            <?php } ?>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </div>
    <?php } ?>
</div>
