<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

$this->assign('title', 'Reset Password');
?>
<?= $this->Flash->render() ?>

<!-- Header -->
<div class="top-bar">
    <div class="top-logo">PowerProShop</div>
    <div class="admin-login">Admin Login</div>
</div>

<!-- Reset password -->
<div class="center-container">
    <div class="login-card">
        <h1 class="login-title">Reset Your Password</h1>

        <?= $this->Form->create($user) ?>

        <div class="form-group password-wrapper">
            <?= $this->Form->control('password', [
                'type' => 'password',
                'label' => false,
                'placeholder' => 'New Password',
                'required' => true,
                'autofocus' => true,
                'value' => '',
                'class' => 'form-control'
            ]) ?>
        </div>

        <div class="form-group password-wrapper">
            <?= $this->Form->control('password_confirm', [
                'type' => 'password',
                'label' => false,
                'placeholder' => 'Repeat New Password',
                'required' => true,
                'value' => '',
                'class' => 'form-control'
            ]) ?>
        </div>

        <?= $this->Form->submit('Reset Password', ['class' => 'login-button']) ?>

        <div style="text-align: center; margin-top: 20px;">
            <?= $this->Html->link('Back to login', ['controller' => 'Auth', 'action' => 'login'], ['class' => 'secondary-button']) ?>
        </div>

        <?= $this->Form->end() ?>
    </div>
</div>




<!-- Styles -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Open+Sans:wght@400;600;700&display=swap');

    body {
        margin: 0;
        padding: 0;
        font-family: 'Open Sans', Arial, sans-serif;
        background-color: white;
        color: black;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .top-bar {
        display: flex;
        justify-content: space-between;
        padding: 24px 32px;
    }

    .top-logo,
    .admin-login {
        font-size: 20px;
        font-weight: bold;
        color: black; /* 原为 #ffc107 */
        font-family: 'Bebas Neue', sans-serif;
    }

    .center-container {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-grow: 1;
        padding: 40px 16px;
    }

    .login-card {
        background-color: black; /* 改为黑色背景 */
        width: 100%;
        max-width: 400px;
        padding: 40px 32px 36px 32px;
        border-radius: 8px;
        box-shadow: 0 0 0 1px #ffc107;
        color: white; /* 内容变白色以增强可读性 */
    }

    .login-title {
        font-size: 28px;
        margin-bottom: 24px;
        text-align: center;
        font-family: 'Bebas Neue', sans-serif;
        letter-spacing: 1px;
        color: white;
    }

    .form-control {
        width: 100%;
        padding: 10px 12px;
        font-size: 14px;
        border: 1px solid #888;
        border-radius: 4px;
        background-color: #f9f9f9;
        color: black;
        box-sizing: border-box;
    }

    .form-control::placeholder {
        color: #555;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .password-wrapper {
        position: relative;
    }

    .show-text {
        position: absolute;
        right: 12px;
        top: 10px;
        color: #ccc;
        font-size: 14px;
        cursor: pointer;
        user-select: none;
    }

    .show-text:hover {
        text-decoration: underline;
    }

    .login-button {
        width: 100%;
        background-color: #ffc107;
        color: black;
        border: none;
        font-size: 16px;
        font-weight: bold;
        border-radius: 24px;
        cursor: pointer;
        padding: 14px 0;
    }

    .error-message {
        color: #ffc107;
        font-weight: bold;
        background-color: rgba(255, 255, 255, 0.1);
        padding: 8px;
        border-radius: 4px;
        text-align: center;
        margin-bottom: 10px;
    }

    .button-clear,
    .secondary-button {
        color: #ffc107;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
    }

    .button-clear:hover,
    .secondary-button:hover {
        text-decoration: underline;
    }

</style>
