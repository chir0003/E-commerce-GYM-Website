<!-- templates/Pages/home.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PowerProShop - Equip with Confidence</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <?= $this->Html->css('landing') ?>
</head>






<!--  Hero Section -->
<!-- Hero Section -->
<header>
    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="4000">

        <!-- Indicators -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>

        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="d-block w-100 bg-cover"
                <?php $imgUrl = $this->ContentBlock->imagePath('hero-image-1'); ?>
                <div style="background-image: url('<?= $this->Url->build($imgUrl, ['fullBase' => true]) ?>'); height: 81vh; background-size: cover; background-position: center;">


                <!-- You can add conten here inside the carousel item if needed -->
                    <div class="container h-100 d-flex align-items-center justify-content-center">
                        <div class="hero-overlay-box text-white p-5 rounded text-center">
                            <p class="hero-subheading"><?= $this->ContentBlock->text('hero-title') ?: 'FUELING YOUR FITNESS JOURNEY'; ?></p>
                            <h1 class="display-5 fw-bold hero-heading">
                                <span class="hero-line-yellow">POWER YOUR GYM</span><br>
                            </h1>
                            <p class="mt-3"><?= $this->ContentBlock->text('hero-subtitle') ?: 'Explore top-tier gym equipment & professional services built for performance and durability.'; ?></p>
                            <div class="d-flex justify-content-center gap-3">
                                <?= $this->Html->link($this->ContentBlock->text('hero-button-1-text') ?: 'Shop Now', ['controller' => 'Products', 'action' => 'shop'], ['class' => 'btn btn-warning btn-lg hero-btn']) ?>
                                <?= $this->Html->link($this->ContentBlock->text('hero-button-2-text') ?: 'Book Now', ['controller' => 'Appointments', 'action' => 'add'], ['class' => 'btn btn-warning btn-lg hero-btn']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>





            <!-- Slide 2 -->
            <div class="carousel-item">
                <?php $imgUrl2 = $this->ContentBlock->imagePath('hero-image-2'); ?>
                <div class="d-block w-100 bg-cover"
                     style="background-image: url('<?= $this->Url->build($imgUrl2, ['fullBase' => true]) ?>');
                         height: 81vh;
                         background-size: cover;
                         background-position: center;
                         background-repeat: no-repeat;">
                    <div class="container h-100 d-flex align-items-center justify-content-center">
                        <div class="hero-overlay-box text-white p-5 rounded text-center">
                            <p class="hero-subheading"><?= $this->ContentBlock->text('hero-title') ?: 'FUELING YOUR FITNESS JOURNEY'; ?></p>

                            <h1 class="display-5 fw-bold hero-heading">
                                <span class="hero-line-yellow">POWER YOUR GYM</span><br>
                            </h1>
                            <p class="mt-3"><?= $this->ContentBlock->text('hero-subtitle') ?: 'Explore top-tier gym equipment & professional services built for performance and durability.'; ?></p>
                            <div class="d-flex justify-content-center gap-3">
                                <?= $this->Html->link($this->ContentBlock->text('hero-button-1-text') ?: 'Shop Now', ['controller' => 'Products', 'action' => 'shop'], ['class' => 'btn btn-warning btn-lg hero-btn']) ?>
                                <?= $this->Html->link($this->ContentBlock->text('hero-button-2-text') ?: 'Book Now', ['controller' => 'Appointments', 'action' => 'add'], ['class' => 'btn btn-warning btn-lg hero-btn']) ?>
                            </div>
                        </div>
                    </div>
                    <div class="hero-fade-overlay"></div>
                </div>
            </div>


            <!-- Slide 3 -->
            <div class="carousel-item">
                <?php $imgUrl3 = $this->ContentBlock->imagePath('hero-image-3'); ?>
                <div class="d-block w-100 bg-cover"
                     style="background-image: url('<?= $this->Url->build($imgUrl3, ['fullBase' => true]) ?>');
                         height: 81vh;
                         background-size: cover;
                         background-position: center;
                         background-repeat: no-repeat;">
                    <div class="container h-100 d-flex align-items-center justify-content-center">
                        <div class="hero-overlay-box text-white p-5 rounded text-center">
                            <p class="hero-subheading"><?= $this->ContentBlock->text('hero-title') ?: 'FUELING YOUR FITNESS JOURNEY'; ?></p>

                            <h1 class="display-5 fw-bold hero-heading">
                                <span class="hero-line-yellow">POWER YOUR GYM</span><br>
                            </h1>
                            <p class="mt-3"><?= $this->ContentBlock->text('hero-subtitle') ?: 'Explore top-tier gym equipment & professional services built for performance and durability.'; ?></p>
                            <div class="d-flex justify-content-center gap-3">
                                <?= $this->Html->link($this->ContentBlock->text('hero-button-1-text') ?: 'Shop Now', ['controller' => 'Products', 'action' => 'shop'], ['class' => 'btn btn-warning btn-lg hero-btn']) ?>
                                <?= $this->Html->link($this->ContentBlock->text('hero-button-2-text') ?: 'Book Now', ['controller' => 'Appointments', 'action' => 'add'], ['class' => 'btn btn-warning btn-lg hero-btn']) ?>
                            </div>
                        </div>
                    </div>
                    <div class="hero-fade-overlay"></div>
                </div>
            </div>


        <!-- Carousel Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</header>


        </div>

        <!-- Carousel Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>

    </div>
</header>





<!--  Features Section -->
<section class="features">
    <div class="features-header">
        <div class="features-tagline">
            <p class="tagline">Built to Perform</p>
        </div>
        <h2>What We Offer</h2>
        <p class="intro">Everything you need to set up, manage, and grow your fitness facility — all in one place.</p>
    </div>

    <div class="feature-cards">

        <!-- Card 1 -->
        <div class="feature-card position-relative">
            <h3>Retail Equipment Sales</h3>
            <p>
                We supply high-quality gym equipment for home users, personal trainers, and commercial gyms.
                From essential weights to professional-grade machines, we help you build a fitness space that lasts.
            </p>
            <a  class="stretched-link"></a>
        </div>
        <br>
        <!-- Card 2 -->
        <div class="feature-card position-relative">
            <h3>Installation & Repairs</h3>
            <p>
                Need a complete gym setup or routine maintenance? Our experienced technicians handle delivery,
                installation, and repairs with professionalism and speed - so you can stay focused on your clients.
            </p>
            <a  class="stretched-link"></a>
        </div>
        <br>
        <!-- Card 3 -->
        <div class="feature-card position-relative">
            <h3>Wholesale & B2B Customers</h3>
            <p>
                We offer tailored solutions for various commercial gyms around Melbourne.
                Browse our B2B catalog & feel free to contact us for personalized support.
            </p>
            <a  class="stretched-link"></a>
        </div>

    </div>

    </div>
</section>



<!-- Bottom Section -->
<section id="hero-1618">
    <div class="fade-top-overlay"></div>
    <div class="cs-container">
        <div class="cs-content">
            <span class="cs-topper">Why PowerProShop ?</span>
            <h1 class="cs-title">Strong Equipment, Stronger Support Your Gym’s Best Partner</h1>
            <div class="d-flex flex-wrap gap-2 mt-3">
                <?= $this->Html->link('Explore Products', ['controller' => 'Products', 'action' => 'shop'], ['class' => 'cs-button-solid']) ?>
                <?= $this->Html->link('Explore Services', ['controller' => 'Pages', 'action' => 'display', 'services'], ['class' => 'cs-button-outline']) ?>
            </div>
        </div>
        <div class="cs-card-group">
            <div class="cs-item">
                <img class="cs-icon" src="https://csimg.nyc3.cdn.digitaloceanspaces.com/Images/Icons/check-circle.svg" alt="icon">
                <h3 class="cs-h3">Browse & Buy Anytime</h3>
                <p class="cs-item-text">Discover our deals & discounts! Explore our latest range of products from the market. Shop securely anywhere, anytime without having to visit our store or call us</p>
            </div>
            <div class="cs-item">
                <img class="cs-icon" src="https://csimg.nyc3.cdn.digitaloceanspaces.com/Images/Icons/speedometer.svg" alt="icon">
                <h3 class="cs-h3">Purchase With Confidence</h3>
                <p class="cs-item-text">Get real-time updates on your orders. No guesswork, no surprises - just peace of mind</p>
            </div>
            <div class="cs-item">
                <img class="cs-icon" src="https://csimg.nyc3.cdn.digitaloceanspaces.com/Images/Icons/Like.svg" alt="icon">
                <h3 class="cs-h3">Book Appointments Online</h3>
                <p class="cs-item-text">Choose your preferred time for equipment servicing. Skip the phone queues - book an appointment directly from our website.</p>
            </div>
        </div>
    </div>

    <picture class="cs-background">
        <source media="(max-width: 600px)" srcset="<?= $this->Url->build('/img/4_8ab7bbc8-f4c4-46ec-abbb-380f46461d9e.png', ['fullBase' => true]) ?>">
        <source media="(min-width: 601px)" srcset="<?= $this->Url->build('/img/4_8ab7bbc8-f4c4-46ec-abbb-380f46461d9e.png', ['fullBase' => true]) ?>">
        <img src="<?= $this->Url->build('/img/4_8ab7bbc8-f4c4-46ec-abbb-380f46461d9e.png', ['fullBase' => true]) ?>" alt="PowerProShop Gym Background">
    </picture>
</section>




<!--<footer>-->
<!--    <div class="footer-content">-->
<!--        <div class="footer-column">-->
<!--            <h4>CUSTOMER SUPPORT</h4>-->
<!--            <ul>-->
<!--                <li><a href="#">FAQs</a></li>-->
<!--                <li><a href="#">Track My Order</a></li>-->
<!--                <li><a href="#">Scheduling Appointments </a></li>-->
<!--            </ul>-->
<!--        </div>-->
<!---->
<!--        <div class="footer-column">-->
<!--            <h4>SHIPPING & DELIVERY</h4>-->
<!--            <ul>-->
<!--                <li><a href="#">Shipping & Rates</a></li>-->
<!--                <li><a href="#">Online Purchases & Delivery </a></li>-->
<!--                <li><a href="#">Click n Collect </a></li>-->
<!--            </ul>-->
<!--        </div>-->
<!---->
<!--        <div class="footer-column">-->
<!--            <h4>CONTACT US</h4>-->
<!--            <div class="social-icons">-->
<!--                <a href="#" title="Phone" class="fa-solid fa-phone"></a>-->
<!--                <a href="#" title="Email" class="fa-solid fa-envelope"></a>-->
<!--                <a href="#" title="Facebook"><i class="fab fa-facebook"></i></a>-->
<!--                <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--    <div class="footer-bottom">-->
<!--        <br>-->
<!--        <p>Copyright © 2025 PowerProShop</p>-->
<!--    </div>-->
<!--</footer>-->
</html>
<?= $this->Html->script('https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js') ?>
</body>
</html>
