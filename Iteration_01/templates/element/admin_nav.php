<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?= $cakeDescription ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <?= $this->Html->meta('icon', '/favicon.ico') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
</head>
<body>

<!-- 顶部导航栏 -->
<nav class="navbar">
    <div class="navbar-container">
        <!-- For mobile: Hamburger menu on left -->
        <div class="hamburger-icon" onclick="toggleMenu()">&#9776;</div>

        <!-- Logo in the center (for mobile) or left (for desktop) -->
        <div class="brand-container">
            <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'home','plugin' => null]) ?>" class="brand-name">
                POWERPROSHOP
            </a>
        </div>

        <!-- Desktop navigation links - hidden on mobile -->
        <div class="desktop-nav d-none d-md-flex">
            <a href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'index','plugin' => null]) ?>" class="nav-link">Products</a>
            <a href="<?= $this->Url->build(['controller' => 'Appointments', 'action' => 'index','plugin' => null]) ?>" class="nav-link">Appointments</a>
            <!--            <a href="#about" class="nav-link">About</a>-->
            <a href="<?= $this->Url->build(['controller' => 'Services', 'action' => 'dashboard','plugin' => null]) ?>" class="nav-link">DashBoard</a>


            <!-- Login/Logout and cart buttons - always visible -->
            <div class="right-controls">


                <!-- Cart visible on all screens -->
<!--                <div class="cart-container position-relative">-->
<!--                    <a href="--><?php //= $this->Url->build(['controller' => 'orders', 'action' => 'viewCart','plugin' => null]) ?><!--" class="cart-icon position-relative">-->
<!--                        <i class="fa fa-shopping-cart fa-lg"></i>-->
<!--                        <span id="cart-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">-->
<!--                        --><?php //= $this->getRequest()->getSession()->read('CartCount') ?? 0 ?>
<!--                    </span>-->
<!--                    </a>-->
<!--                </div>-->
            </div>
        </div>
        <div class="auth-container">
            <?php $identity = $this->request->getAttribute('identity'); ?>
            <?php if ($identity): ?>
                <?= $this->Html->link('Logout', ['controller' => 'Auth', 'action' => 'logout','plugin' => null], ['class' => 'btn-auth btn-logout']) ?>
            <?php else: ?>
                <?= $this->Html->link('Login', ['controller' => 'Auth', 'action' => 'login','plugin' => null], ['class' => 'btn-auth btn-dark']) ?>
            <?php endif; ?>
        </div>
    </div>
</nav><!-- Mobile menu - hidden by default -->
<div id="mobileMenu" class="mobile-menu hidden p-3 bg-light d-md-none">
    <a href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'index','plugin' => null]) ?>">Products</a>
    <a href="<?= $this->Url->build(['controller' => 'Appointments', 'action' => 'index','plugin' => null]) ?>">Appointments</a>
    <!--    <a href="#about">About</a>-->
    <a href="<?= $this->Url->build(['controller' => 'Services', 'action' => 'dashboard','plugin' => null]) ?>">DashBoard</a>

    <!-- View Cart inside mobile menu -->
<!--    <a href="--><?php //= $this->Url->build(['controller' => 'orders', 'action' => 'viewCart','plugin' => null]) ?><!--" class="position-relative">-->
<!--        <i class="fa fa-shopping-cart me-2"></i>View Cart-->
<!--        <span class="badge rounded-pill bg-danger position-absolute top-50 start-75 translate-middle-y">-->
<!--        --><?php //= $this->getRequest()->getSession()->read('CartCount') ?? 0 ?>
<!--        </span>-->
<!--    </a>-->

</div>


<!-- 脚本 -->
<script>
    function toggleMenu() {
        const menu = document.getElementById('mobileMenu');
        menu.classList.toggle('hidden');
        menu.classList.toggle('show');
    }
</script>

<!--  样式 -->
<style>
    /* Import Google Fonts */
    @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Open+Sans:wght@400;600;700&display=swap');

    /* Headers/Titles - Bold, Strong Font */
    h1, h2, h3, h4, .cta-button, .btn, .hero-title, .features-header h2 {
        font-family: 'Bebas Neue', sans-serif;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    /* Body Text - Clean, Readable Font */
    body, p, .feature-card p, .nav-links li a {
        font-family: 'Open Sans', Arial, sans-serif;
        font-weight: 400;
        line-height: 1.6;
    }

    /* Additional Gym-Specific Typography Enhancements */
    .tagline {
        font-family: 'Bebas Neue', sans-serif;
        letter-spacing: 2px;
    }

    /* Weights and Styles */
    h1 { font-size: 3rem; font-weight: 700; }
    h2 { font-size: 2.5rem; font-weight: 600; }
    h3 { font-size: 2rem; font-weight: 600; }


    /* Reset */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html {
        margin: 0;
        padding: 0;
        width: 100%;
        overflow-x: hidden;
    }

    body {
        margin: 0;
        padding: 0;
        width: 100%;
    }

    /*NAVBAR*/
    .navbar {
        background-color: #ffc107;
        padding: 12px 20px;
        position: sticky;
        top: 0;
        z-index: 999;
        font-family: 'Bebas Neue', sans-serif;
        text-transform: uppercase;
    }

    .navbar-container {
        max-width: 1200px;
        margin: 0 auto;
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .brand-name {
        font-size: 30px;
        font-weight: bold;
        text-decoration: none;
        color: black;
        white-space: nowrap;
    }

    .desktop-nav {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .nav-link {
        font-size: 1.2rem;
        color: black;
        text-decoration: none;
        font-weight: bold;
        font-family: 'Bebas Neue', sans-serif;
    }

    .nav-link:hover {
        text-decoration: underline;
        color: #333;
    }

    .auth-container {
        white-space: nowrap;
    }

    /* Button Styling */
    .btn-auth {
        font-size: 1rem;  /* Smaller font */
        padding: 5px 12px; /* Compact padding */
        border: none;
        font-weight: 600;
        font-family: 'Bebas Neue', sans-serif;
        text-transform: uppercase;
        text-decoration: none;
        transition: all 0.3s ease-in-out;
        width: auto;
        min-width: 80px;  /* Reduced min-width */
        text-align: center;
        display: inline-block;
    }

    /* Primary Button */
    .btn-dark {
        background-color: #5a4e03;
        color: white;
        border: 2px solid #5a4e03;
    }

    .btn-dark:hover {
        background-color: #4a3f02;
        border-color: #4a3f02;
        transform: scale(1.05);
    }
    .right-controls {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .cart-icon {
        color: black;
        text-decoration: none;
        font-size: 1.2rem;
    }

    .cart-icon:hover {
        color: #333;
        transform: scale(1.05);
    }

    #cart-count {
        font-size: 0.7rem;
        padding: 2px 6px;
    }


    /* Logout Button */
    .btn-logout {
        background-color: #d32f2f;
        color: white;
        border: 2px solid #d32f2f;
    }

    .btn-logout:hover {
        background-color: #b71c1c;
        border-color: #b71c1c;
        transform: scale(1.05);
    }

    .hamburger-icon {
        font-size: 24px;
        cursor: pointer;
        user-select: none;
        color: black;
        display: none;
    }

    .mobile-menu {
        display: none;
        flex-direction: column;
        background-color: #ffc107;
        padding: 10px 20px;
        position: fixed;
        top: 64px;
        left: 10px;
        width: 180px;
        border: 1px solid #ccc;
        border-radius: 4px;
        z-index: 9999;
    }

    .mobile-menu a {
        padding: 10px;
        text-decoration: none;
        font-weight: bold;
        color: black;
        border-bottom: 1px solid #00000020;
    }


    .mobile-menu a:last-child {
        border-bottom: none;
    }

    .mobile-menu.show {
        display: flex;
    }

    .hidden {
        display: none;
    }

    /* Responsive Design */
    @media (max-width: 768px) {

        .desktop-nav {
            display: none !important;
        }

        .mobile-controls {
            background-color: #fff3cd;
        }
        .desktop-nav {
            display: none;
        }

        .hamburger-icon {
            display: block;
            order: 1;
        }

        .brand-container {
            order: 2;
            flex-grow: 1;
            text-align: center;
        }

        .auth-container {
            order: 3;
        }

        .navbar-container {
            display: flex;
            justify-content: space-between;
        }

        /* Adjust button size on small screens */
        .btn-auth {
            font-size: 0.9rem;
            padding: 4px 10px;
            min-width: 70px;
        }

        .mobile-menu {
            left: 10px;
            right: auto;
        }
    }

    @media (min-width: 769px) {
        .brand-container {
            order: 1;
        }

        .desktop-nav {
            order: 2;
            margin-left: auto;
            margin-right: 20px;
        }

        .auth-container {
            order: 3;
        }
    }

    /* Footer section */
    footer {
        background-color: #171616;
        width: 100%; /* Ensure full width */
        margin: 0; /* Remove any default margins */
        padding: 0; /* Remove padding from footer itself */
    }

    .footer-content {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        padding: 40px 60px;
        max-width: 1200px;
        margin: 0 auto;
        width: 100%;
        box-sizing: border-box;
    }

    .footer-column {
        flex: 1 1 200px;
        min-width: 200px;
        text-align: left;
        margin: 0 45px;
    }

    .footer-column h4 {
        margin-bottom: 15px;
        text-transform: uppercase;
        color: #ffc107;
    }

    .footer-column ul {
        list-style: none;
        padding: 0;
    }

    .footer-column ul li {
        margin-bottom: 10px;
    }

    .footer-column a {
        text-decoration: none;
        color: white;
        transition: color 0.3s ease;
    }

    .footer-column a:hover {
        color: #ffc107;
    }

    .contact-us {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
    }

    .footer-bottom {
        /*margin-top: 20px;*/
        padding-bottom: 20px;
        text-align: center;
        border-top: 1px solid #ddd;
        color: white;
        background-color: #171616;
    }

    .footer-bottom-p {
        background-color: #171616 !important;
    }

    /* Responsive Adjustments */
    @media screen and (max-width: 768px) {
        .footer-content {
            flex-direction: column;
        }

        .footer-column {
            flex: 1 1 100%;
            margin: 10px 0;
        }
    }

    @media screen and (max-width: 480px) {
        footer {
            padding: 10px;
        }

        .footer-column {
            text-align: center;
        }
    }

    .social-icons a {
        color: white;
        font-size: 24px;
        margin-right: 15px;
        transition: color 0.3s ease;
    }

    .social-icons a:hover {
        color: #ffc107;
    }

    .footer-cta h3 {
        font-size: 1.8rem;
        margin-bottom: 10px;
        color: #ffffff;
    }

    .footer-cta p {
        font-size: 1.1rem;
        color: #dddddd;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.4rem;
        }

        .feature-cards {
            flex-direction: column;
            align-items: center;
        }

        .navbar {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .nav-links {
            flex-direction: column;
            width: 100%;
        }

        .overlay {
            padding: 20px;
        }
    }

    .feature-card {
        background: #fff;
        padding: 25px;
        border-radius: 12px;
        transition: transform 0.3s ease;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        position: relative;
        overflow: visible !important;
        cursor: pointer;
    }

    .feature-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
    }

    /* CONTACT LIST */
    .contact-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .contact-list li {
        margin-bottom: 12px;
    }

    .contact-list a {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        text-decoration: none;
        color: white;
        transition: color 0.3s ease;
    }

    .contact-list a:hover {
        color: #ffc107;
    }

    .contact-list i {
        font-size: 18px;
        color: #ffc107;
        min-width: 20px; /* Reserve horizontal space for the icon */
        text-align: center;
        margin-top: 4px; /* Optional: fine-tune vertical icon alignment */
    }

    .contact-list span {
        display: inline-block;
        max-width: 250px;
        word-wrap: break-word;
    }


</style>


<!--  JS 和页面脚本 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<?= $this->fetch('script') ?>
<?php

$this->Html->script('scripts');
$this->fetch('script');


?>
</body>
</html>

