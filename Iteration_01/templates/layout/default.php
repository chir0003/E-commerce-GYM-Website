<?php
$cakeDescription = "PowerProShop | Australia's leading gym equipment retailer";
$identity = $this->request->getAttribute('identity');
$isAdmin = false;

if ($identity) {
    $authorizationComponent = new \App\Controller\Component\AuthorizationComponent(new \Cake\Controller\ComponentRegistry());
    $isAdmin = $authorizationComponent->isAdmin($this->request);
}
?>
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
<!-- Load Navbar (Admin or Customer) -->
<?php
if ($isAdmin) {
    echo $this->element('admin_nav');
} else {
    echo $this->element('customer_nav');
}
?>

<!-- Main Content -->
<main>
    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>
</main>

<!-- Footer -->
<footer>
    <footer>
        <br>
        <div class="footer-content">
            <div class="footer-column">
                <h4>CUSTOMER SUPPORT</h4>
                <ul>
                    <li><a href="#">FAQs</a></li>
                    <li><a href="#">Track My Order</a></li>
                    <?= $this->Html->link('Scheduling Appointments', ['controller' => 'Appointments', 'action' => 'add']) ?>
                </ul>
            </div>

            <div class="footer-column">
                <h4>SHIPPING & DELIVERY</h4>
                <ul>
                    <li><a href="#">Shipping & Rates</a></li>
                    <li><a href="#">Online Purchases & Delivery</a></li>
                    <li><a href="#">Click n Collect</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h4>CONTACT US</h4>
                <ul class="contact-list">
                    <li>
                        <a href="tel:<?= $this->ContentBlock->text('phone-number'); ?>">
                            <i class="fa-solid fa-phone"></i>
                            <span><?= $this->ContentBlock->text('phone-number'); ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="mailto:<?= $this->ContentBlock->text('email-address'); ?>">
                            <i class="fa-solid fa-envelope"></i>
                            <span><?= $this->ContentBlock->text('email-address'); ?></span>
                        </a>
                    </li>
                    <li>
                        <a id="map-link" target="_blank" href="https://www.google.com/maps?q=<?= urlencode($this->ContentBlock->text('store-address')); ?>">
                            <i class="fa-solid fa-location-dot"></i>
                            <span id="address"><?= $this->ContentBlock->text('store-address'); ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa-solid fa-clock"></i>
                            <span><?= $this->ContentBlock->text('working-hours'); ?></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    <div class="footer-bottom">
        <br>
        <p class="footer-bottom-p">Copyright © 2025 PowerProShop</p>
    </div>
</footer>



<!-- Scripts -->
<script>
    document.getElementById("map-link").href = "https://www.google.com/maps/search/" +
        encodeURIComponent(document.getElementById("address").innerText);

    function toggleMenu() {
        const menu = document.getElementById('mobileMenu');
        menu.classList.toggle('hidden');
        menu.classList.toggle('show');
    }
</script>



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
