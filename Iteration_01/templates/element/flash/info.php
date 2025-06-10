<?php
/**
 * @var \App\View\AppView $this
 * @var array $params
 * @var string $message
 */
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="message" onclick="this.classList.add('hidden');"><?= $message ?></div>

<style>
    .message {
        background-color: rgba(14, 14, 14, 0.08); /* Light yellow background */
        border: 1px solid rgba(9, 9, 9, 0.16); /* Yellow border */
        color: #020202; /* Yellow text */
        font-weight: bold;
        padding: 12px;
        border-radius: 6px;
        text-align: center;
        margin-top: 15px;

        cursor: pointer; /* Indicate it's clickable */
    }

    .hidden {
        display: none;
    }
</style>
