<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PowerProShop - Equip with Confidence</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= $this->Html->css('services') ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>





<!--  Hero Section -->
<header class="hero">
    <div class="overlay">
        <h1 class="hero-title">OUR SERVICES</h1>
        <p class="tagline">Installations & Repairs</p>
        <?= $this->Html->link('Book Now', ['controller' => 'Appointments', 'action' => 'add'], ['class' => 'btn btn-warning btn-lg mt-4']) ?>
    </div>
</header>





<!-- Service Section -->
<section class="service-section">
    <br>
    <br>
    <!--Repairs Section-->
    <div class="service-container">
        <div class="service-content">
            <div class="service-header">
                <h2 class="service-title">Repairs</h2>
            </div>

            <div class="service-description">
                <p>Downtime is never ideal. That’s why our certified technicians act fast - diagnosing issues accurately and completing repairs efficiently using only genuine parts, ensuring that your fitness routine never skips a beat.</p>

                <div class="service-features">
                    <div class="feature-item">
                        <i class="fas fa-dollar-sign feature-icon"></i>
                        <p>No hidden fees</p>
                    </div>

                    <div class="feature-item">
                        <i class="fas fa-check-circle feature-icon"></i>
                        <p>Genuine parts only</p>
                    </div>

                    <div class="feature-item">
                        <i class="fas fa-certificate feature-icon"></i>
                        <p>Professional certified technicians</p>
                    </div>

                    <div class="feature-item">
                        <i class="fas fa-calendar-check feature-icon"></i>
                        <p>Same-week service available</p>
                    </div>
                </div>
            </div>

            <div class="service-cta">
                <?= $this->Html->link('Ask for a Consultation', ['controller' => 'ContactForms', 'action' => 'add'], ['class' => 'btn btn-warning btn-lg mt-4']) ?>
                <?= $this->Html->link('Book Now', ['controller' => 'Appointments', 'action' => 'add'], ['class' => 'btn btn-warning btn-lg mt-4']) ?>
            </div>
        </div>

        <div class="service-image">
            <?= $this->Html->image('services_repair.jpeg', ['alt' => 'Man repairing a treadmill', 'class' => 'service-img']) ?>
        </div>
    </div>

    <br>

    <!--Installations Section-->
    <div class="service-container">
        <div class="service-image">
            <?= $this->Html->image('services_install.jpg', ['alt' => 'Two men installing a treadmill', 'class' => 'service-img']) ?>
        </div>
        <div class="service-content">
            <div class="service-header">
                <h2 class="service-title">Installations</h2>
            </div>

            <div class="service-description">
                <p>From single units to full gym setups, our certified technicians ensure your equipment is installed according to manufacturer standards - so you can start training without delays.</p>

                <div class="service-features">
                    <div class="feature-item">
                        <i class="fas fa-dollar-sign feature-icon"></i>
                        <p>No hidden fees</p>
                    </div>

                    <div class="feature-item">
                        <i class="fas fa-dumbbell feature-icon"></i>
                        <p>Installations for any and all equipment</p>
                    </div>

                    <div class="feature-item">
                        <i class="fas fa-certificate feature-icon"></i>
                        <p>Professional certified technicians</p>
                    </div>

                    <div class="feature-item">
                        <i class="fas fa-building feature-icon"></i>
                        <p>Tailored setup for each facility</p>
                    </div>
                </div>
            </div>

            <div class="service-cta">
                <?= $this->Html->link('Ask for a Consultation', ['controller' => 'ContactForms', 'action' => 'add'], ['class' => 'btn btn-warning btn-lg mt-4']) ?>
                <?= $this->Html->link('Book Now', ['controller' => 'Appointments', 'action' => 'add'], ['class' => 'btn btn-warning btn-lg mt-4']) ?>
            </div>
        </div>
    </div>

    <br>

    <!--B2B Section-->
    <div class="service-container">
        <div class="service-content">
            <div class="service-header">
                <h2 class="service-title">Commercial Customers</h2>
            </div>

            <div class="service-description">
                <p>Running a commercial gym means equipment uptime is non-negotiable. Our specialized B2B solutions are designed for high-traffic environments, with scalable support that grows with your business.</p>

                <div class="service-features">
                    <div class="feature-item">
                        <i class="fas fa-screwdriver-wrench feature-icon"></i>
                        <p>Bulk installations & repairs</p>
                    </div>

                    <div class="feature-item">
                        <i class="fas fa-gear feature-icon"></i>
                        <p>Custom maintenance plans available</p>
                    </div>

                    <div class="feature-item">
                        <i class="fas fa-tags feature-icon"></i>
                        <p>Discounts available for bulk purchases</p>
                    </div>

                    <div class="feature-item">
                        <i class="fas fa-clipboard-list feature-icon"></i>
                        <p>Priority scheduling for ongoing partnerships</p>
                    </div>
                </div>
            </div>

            <div class="service-cta">
                <?= $this->Html->link('Ask for a Consultation', ['controller' => 'ContactForms', 'action' => 'add'], ['class' => 'btn btn-warning btn-lg mt-4']) ?>
            </div>
        </div>

        <div class="service-image">
            <?= $this->Html->image('services_b2b.png', ['alt' => 'Picture of a commercial gym', 'class' => 'service-img']) ?>
        </div>
    </div>
</section>

</body>
</html>
