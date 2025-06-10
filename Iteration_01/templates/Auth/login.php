<?php
/**
 * @var \App\View\AppView $this
 */

use Cake\Core\Configure;

$debug = Configure::read('debug');

$this->assign('title', 'Login');
?>
<?= $this->Flash->render() ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
<script src="<?= $this->Url->build('/js/resizeTurnStile.js') ?>"></script>





<!-- Header Section -->
<div class="top-bar">
    <div class="top-logo">PowerProShop</div>
    <div class="admin-login">Admin Login</div>
</div>

<!-- Login Section Without Container -->
<div class="center-container">
    <div class="login-card">
        <h1 class="login-title">Login</h1>


        <?= $this->Form->create(null, ['url' => ['action' => 'login']]) ?>

        <!-- Username -->
        <div class="form-group">
            <?= $this->Form->control('email', [
                'label' => false,
                'placeholder' => 'Email address',
                'required' => true,
                'class' => 'form-control',
                'error' => ['class' => 'error-message']
            ]) ?>
        </div>

        <!-- Password -->
        <div class="form-group password-wrapper">
            <?= $this->Form->control('password', [
                'label' => false,
                'placeholder' => 'Password',
                'required' => true,
                'id' => 'password-field',
                'class' => 'form-control',
                'error' => ['class' => 'error-message']
            ]) ?>
            <span onclick="togglePassword()" class="show-text" id="toggle-pass">show</span>
        </div>

        <!-- Turnstile CAPTCHA -->
        <div id="turnStileError" class="error-message hidden" onclick="this.classList.add('hidden');">
            Please complete the captcha response!
        </div>
        <div id="turnStileBox" tabindex="-1" class="cf-turnstile my-2" data-sitekey="0x4AAAAAAA_U6Q5J3m9hRkYk"></div>

        <!-- Submit -->
        <?= $this->Form->submit(__('Login'), ['class' => 'login-button']) ?>
        <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>

        <!-- Links -->
        <div style="text-align: center; margin-top: 20px;">
            <?= $this->Html->link(
                '<i class="fas fa-key"></i> Forgot password?',
                ['controller' => 'Auth', 'action' => 'forgetPassword'],
                ['class' => 'secondary-button', 'escape' => false]
            ) ?><br>
            <?= $this->Html->link('Register new user', ['controller' => 'Auth', 'action' => 'register'], ['class' => 'button button-clear']) ?>
        </div>

        <?= $this->Form->end() ?>
    </div>


</div>




<script>
    function togglePassword() {
        const field = document.getElementById('password-field');
        const toggle = document.getElementById('toggle-pass');
        const type = field.getAttribute('type') === 'password' ? 'text' : 'password';
        field.setAttribute('type', type);
        toggle.textContent = type === 'password' ? 'show' : 'hide';
    }
    // resizeTurnStile.js
    $(document).ready(function () {
        function resizeTurnstile() {
            const $turnstile = $('.cf-turnstile');
            if ($turnstile.length) {
                $turnstile.css({
                    'transform': 'scale(0.9)',
                    'transform-origin': '0 0',
                    'width': '100%'
                });
            }
        }

        // Initial resize
        resizeTurnstile();

        // Resize on window size change
        $(window).resize(function () {
            resizeTurnstile();
        });
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

    @media (max-width: 480px) {
        .cf-turnstile {
            transform: scale(0.85);
            transform-origin: top left;
        }
        .cf-turnstile {
            max-width: 100%;
            overflow: hidden;
            transform: scale(0.95);
            transform-origin: top left;
            height: auto;
        }
    }



    .top-bar {
        display: flex;
        justify-content: space-between;
        padding: 24px 32px;
    }
    .login-card {
        max-width: 100%;
        padding: 1rem;
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
        color: #dc3545;
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
