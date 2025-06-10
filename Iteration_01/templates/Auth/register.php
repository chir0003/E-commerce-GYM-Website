<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

$this->assign('title', 'Register new user');
?>
<?= $this->Flash->render() ?>

<!-- Header -->
<div class="top-bar">
    <div class="top-logo">PowerProShop</div>
    <div class="admin-login">Admin Login</div>
</div>

<!-- 注册内容区 -->
<div class="center-container">
    <div class="login-card">
        <h1 class="login-title">Register</h1>

        <?= $this->Form->create($user, ['type' => 'file']) ?>

        <div class="form-group">
            <?= $this->Form->control('email', [
                'label' => false,
                'placeholder' => 'Email',
                'required' => true,
                'type' => 'email',
                'maxlength' => 30,
                'class' => 'form-control'
            ]) ?>
        </div>

        <div class="form-group">
            <?= $this->Form->control('first_name', [
                'label' => false,
                'placeholder' => 'First Name',
                'required' => true,
                'type' => 'text',
                'maxlength' => 30,
                'class' => 'form-control'
            ]) ?>
        </div>

        <div class="form-group">
            <?= $this->Form->control('last_name', [
                'label' => false,
                'placeholder' => 'Last Name',
                'required' => true,
                'type' => 'text',
                'maxlength' => 30,
                'class' => 'form-control'
            ]) ?>
        </div>

        <div class="form-group password-wrapper">
            <?= $this->Form->control('password', [
                'label' => false,
                'placeholder' => 'Password',
                'value' => '',
                'maxlength' => 30,
                'class' => 'form-control',
                'id' => 'reg-password',
                'type' => 'password',
                'required' => true
            ]) ?>
            <div id="password-error" class="error-message" style="display: none;"></div>
        </div>

        <div class="form-group password-wrapper">
            <?= $this->Form->control('password_confirm', [
                'label' => false,
                'placeholder' => 'Retype Password',
                'type' => 'password',
                'value' => '',
                'maxlength' => 30,
                'class' => 'form-control',
                'id' => 'reg-password-confirm',
                'required' => true
            ]) ?>
        </div>

<!--        <div class="form-group">-->
<!--            --><?php //= $this->Form->control('avatar', [
//                'type' => 'file',
//                'label' => false,
//                'class' => 'form-control'
//            ]) ?>
<!--        </div>-->

        <?= $this->Form->submit('Register', ['class' => 'login-button']) ?>

        <div style="text-align: center; margin-top: 20px;">
            <?= $this->Html->link('Back to login', ['controller' => 'Auth', 'action' => 'login'], ['class' => 'secondary-button']) ?>
        </div>

        <?= $this->Form->end() ?>
    </div>
</div>
<script>
    document.querySelector('form').addEventListener('submit', function (e) {
        const password = document.getElementById('reg-password').value.trim();
        const confirmPassword = document.getElementById('reg-password-confirm').value.trim();
        const errorDiv = document.getElementById('password-error');

        // Reset error message
        errorDiv.style.display = 'none';
        errorDiv.innerText = '';

        if (password.length < 8) {
            e.preventDefault();
            errorDiv.innerText = 'Password must be at least 8 characters long.';
            errorDiv.style.display = 'block';
        } else if (password !== confirmPassword) {
            e.preventDefault();
            errorDiv.innerText = 'Passwords do not match.';
            errorDiv.style.display = 'block';
        }
    });
</script>




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
