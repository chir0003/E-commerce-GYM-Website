-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2025 at 07:10 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `powerproshop_testdbv3`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
                                `id` int(11) NOT NULL,
                                `name` varchar(100) NOT NULL,
                                `email` varchar(255) NOT NULL,
                                `phone` varchar(15) NOT NULL,
                                `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
                                `scheduled_date` datetime NOT NULL,
                                `address` varchar(255) NOT NULL,
                                `status` enum('processing','confirmed','in progress','completed') NOT NULL,
                                `notes` varchar(255) NOT NULL,
                                `service_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `name`, `email`, `phone`, `created_date`, `scheduled_date`, `address`, `status`, `notes`, `service_id`) VALUES
                                                                                                                                              (5, 'John Appleseed', 'johnapple.test@gmail.com', '0412345678', '2025-04-16 09:09:11', '2025-04-17 10:00:00', '23 McKinnon Road, McKinnon VIC 3204', 'confirmed', 'Appointment for repairing a broken treadmill and butterfly machine', 2),
                                                                                                                                              (6, 'Sam Singh', 'samsinghs.test@gmail.com', '0498765432', '2025-04-16 09:11:09', '2025-04-30 13:10:00', '170 Maud St, Balwyn North VIC 3104', 'processing', 'Repair an old weightlifting rack, and installation for a new treadmill that was bought', 3),
                                                                                                                                              (7, 'Tina Ting', 'tina.testing@gmail.com', '0432587963', '2025-04-16 09:15:21', '2025-05-06 11:55:00', '13 Hethersett Grove, Carnegie VIC 3163', 'processing', 'Installation of new weightlifting rack in my home gym', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact_forms`
--

CREATE TABLE `contact_forms` (
                                 `id` int(11) NOT NULL,
                                 `name` varchar(255) NOT NULL,
                                 `email` varchar(255) NOT NULL,
                                 `message` text NOT NULL,
                                 `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_forms`
--

INSERT INTO `contact_forms` (`id`, `name`, `email`, `message`, `created`) VALUES
                                                                              (2, 'John Smith', 'jsmith.test@gmail.com', 'Inquiry regarding latest gym equipment', '2025-04-16 19:05:57'),
                                                                              (3, 'Sam smith', 'sam123.test@gmail.com', 'I want to ask about what type of services does PowerProShop offer for commercial gyms. Im asking as a the owner of a commercial gym.', '2025-04-16 19:07:07'),
                                                                              (4, 'cccc', 'ccc@ccc.sdvfv', 'sdvfvgr', '2025-04-16 22:46:04');

-- --------------------------------------------------------

--
-- Table structure for table `content_blocks`
--

CREATE TABLE `content_blocks` (
                                  `id` int(11) NOT NULL,
                                  `parent` varchar(128) NOT NULL,
                                  `slug` varchar(128) NOT NULL,
                                  `label` varchar(255) NOT NULL,
                                  `description` varchar(255) NOT NULL,
                                  `type` varchar(32) NOT NULL,
                                  `value` text DEFAULT NULL,
                                  `previous_value` text DEFAULT NULL,
                                  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `content_blocks`
--

INSERT INTO `content_blocks` (`id`, `parent`, `slug`, `label`, `description`, `type`, `value`, `previous_value`, `modified`) VALUES
                                                                                                                                 (87, 'home', 'hero-title', 'Hero Title', 'The main title text in the hero section of the homepage.', 'text', 'FUELING YOUR FITNESS JOURNEY', NULL, '2025-05-12 14:24:26'),
                                                                                                                                 (88, 'home', 'hero-subtitle', 'Hero Subtitle', 'The subtitle text under the main hero title.', 'text', 'Explore top-tier gym equipment & professional services built for performance and durability.', NULL, '2025-05-12 14:24:26'),
                                                                                                                                 (89, 'home', 'hero-button-1-text', 'Hero Button 1 Text', 'The text for the first hero button.', 'text', 'Shop Now', NULL, '2025-05-12 14:24:26'),
                                                                                                                                 (90, 'home', 'hero-button-2-text', 'Hero Button 2 Text', 'The text for the second hero button.', 'text', 'Book Now', NULL, '2025-05-12 14:24:26'),
                                                                                                                                 (91, 'home', 'hero-image-1', 'Hero Image 1', 'First image for homepage carousel.', 'image', '/content-blocks/uploads/hero-image-1.8e8af4244712e87cd985121beaf4098c.jpg', NULL, '2025-05-12 14:29:26'),
                                                                                                                                 (92, 'home', 'hero-image-2', 'Hero Image 2', 'Second image for homepage carousel.', 'image', '/img/home_equipmentrepair.jpg', NULL, '2025-05-12 14:24:26'),
                                                                                                                                 (93, 'home', 'hero-image-3', 'Hero Image 3', 'Third image for homepage carousel.', 'image', '/img/d0ndaq2m8cgmyaadlmip.jpg', NULL, '2025-05-12 14:24:26'),
                                                                                                                                 (94, 'footer', 'store-address', 'Store Address', 'The physical address of the store shown in the footer.', 'text', '740/742 Burwood Hwy, Ferntree Gully VIC 3156', NULL, '2025-05-12 14:28:38'),
                                                                                                                                 (95, 'footer', 'phone-number', 'Phone Number', 'The contact phone number for the store.', 'text', '0412 345 678', NULL, '2025-05-12 14:29:11'),
                                                                                                                                 (96, 'footer', 'email-address', 'Email Address', 'The contact email for the store.', 'text', 'paul.powerproshop@gmail.com', NULL, '2025-05-12 14:24:26'),
                                                                                                                                 (97, 'footer', 'working-hours', 'Working Hours', 'The working hours of the store shown in the footer.', 'text', 'Monday - Friday, 9am - 5pm', NULL, '2025-05-12 14:28:55');

-- --------------------------------------------------------

--
-- Table structure for table `content_blocks_phinxlog`
--

CREATE TABLE `content_blocks_phinxlog` (
                                           `version` bigint(20) NOT NULL,
                                           `migration_name` varchar(100) DEFAULT NULL,
                                           `start_time` timestamp NULL DEFAULT NULL,
                                           `end_time` timestamp NULL DEFAULT NULL,
                                           `breakpoint` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `content_blocks_phinxlog`
--

INSERT INTO `content_blocks_phinxlog` (`version`, `migration_name`, `start_time`, `end_time`, `breakpoint`) VALUES
    (20230402063959, 'ContentBlocksMigration', '2025-05-09 15:16:45', '2025-05-09 15:16:45', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
                             `id` int(11) NOT NULL,
                             `name` varchar(100) NOT NULL,
                             `email` varchar(100) NOT NULL,
                             `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `address`) VALUES
                                                               (1, 'chirag', 'cnkdjbcdj@hvcjhdc.com', 'cdfefw'),
                                                               (2, 'chirag', 'cnkdjbcdj@hvcjhdc.com', 'cdfefw'),
                                                               (3, 'chirag', 'cnkdjbcdj@hvcjhdc.com', 'cdfefw'),
                                                               (4, 'bhnhg', 'hngn@fgt.yy', 'yreheh'),
                                                               (5, 'kjhgg', 'hgdf@hggh.com', 'gjjffjj'),
                                                               (6, 'chss', 'snskx@dckjc.com', '2 highw road'),
                                                               (7, 'cc', 'cc@cc.som', 'dfdss'),
                                                               (8, 'cgh', 'ccc@ddc.com', 'sddfz@sfd.com'),
                                                               (9, 'Pure Local business directory', 'nathan.doe@gmail.com', '100 Franklin Street '),
                                                               (10, 'sdvds', 'sdbsdbs@gmail.com', 'dsvdvdg'),
                                                               (11, 'svasdvavb', 'as@gmail.com', 'zx z zx'),
                                                               (12, 'wegweg', 'sd@gmail.com', 'adgaeg'),
                                                               (13, 'dsvddv', 'sdv@gmail.com', 'sdvdsv'),
                                                               (14, 'dsbd', 'sdbs@gmail.com', 'ascasac');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
                          `id` int(11) NOT NULL,
                          `total_amount` decimal(65,2) NOT NULL,
                          `status` enum('processed','shipped','completed') NOT NULL,
                          `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
                          `delivery_method` enum('pickup','delivery') DEFAULT NULL,
                          `delivery_status` enum('in transit','delivered') DEFAULT NULL,
                          `delivery_date` date DEFAULT NULL,
                          `notes` varchar(255) DEFAULT NULL,
                          `stripe_payment_id` varchar(255) DEFAULT NULL,
                          `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `total_amount`, `status`, `created_date`, `delivery_method`, `delivery_status`, `delivery_date`, `notes`, `stripe_payment_id`, `customer_id`) VALUES
                                                                                                                                                                              (5, 25.00, 'completed', '2025-04-12 15:40:19', 'delivery', 'in transit', '2025-04-15', 'Update inventory', NULL, 5),
                                                                                                                                                                              (6, 50.00, 'shipped', '2025-04-13 09:45:22', 'delivery', 'in transit', '2025-04-11', 'Update Status', NULL, 6),
                                                                                                                                                                              (7, 2.00, 'processed', '2025-04-14 07:51:30', 'delivery', NULL, NULL, NULL, NULL, 7),
                                                                                                                                                                              (8, 275.00, 'processed', '2025-04-14 15:20:12', 'pickup', NULL, NULL, NULL, NULL, 8),
                                                                                                                                                                              (9, 2.00, 'processed', '2025-04-30 11:03:14', 'pickup', NULL, NULL, NULL, NULL, 9),
                                                                                                                                                                              (10, 100.00, 'processed', '2025-05-14 04:19:26', 'pickup', NULL, NULL, NULL, NULL, 10),
                                                                                                                                                                              (11, 2.00, 'processed', '2025-05-14 04:21:03', 'delivery', NULL, NULL, NULL, NULL, 11),
                                                                                                                                                                              (12, 100.00, 'processed', '2025-05-14 04:23:03', 'pickup', NULL, NULL, NULL, NULL, 12),
                                                                                                                                                                              (13, 100.00, 'processed', '2025-05-14 04:47:21', 'pickup', NULL, NULL, NULL, NULL, 13),
                                                                                                                                                                              (14, 100.00, 'processed', '2025-05-14 04:50:56', 'pickup', NULL, NULL, NULL, 'pi_3ROXH6PwQ8uNzZNs1xJETFts', 14);

-- --------------------------------------------------------

--
-- Table structure for table `orders_products`
--

CREATE TABLE `orders_products` (
                                   `id` int(11) NOT NULL,
                                   `quantity` decimal(65,0) NOT NULL,
                                   `price` decimal(65,2) NOT NULL,
                                   `order_id` int(11) NOT NULL,
                                   `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders_products`
--

INSERT INTO `orders_products` (`id`, `quantity`, `price`, `order_id`, `product_id`) VALUES
                                                                                        (1, 1, 25.00, 5, 1),
                                                                                        (2, 2, 25.00, 6, 1),
                                                                                        (3, 1, 2.00, 7, 3),
                                                                                        (4, 2, 100.00, 8, 2),
                                                                                        (5, 3, 25.00, 8, 1),
                                                                                        (6, 1, 2.00, 9, 3),
                                                                                        (7, 1, 100.00, 10, 2),
                                                                                        (8, 1, 2.00, 11, 3),
                                                                                        (9, 1, 100.00, 12, 2),
                                                                                        (10, 1, 100.00, 13, 2),
                                                                                        (11, 1, 100.00, 14, 2);

-- --------------------------------------------------------

--
-- Table structure for table `phinxlog`
--

CREATE TABLE `phinxlog` (
                            `version` bigint(20) NOT NULL,
                            `migration_name` varchar(100) DEFAULT NULL,
                            `start_time` timestamp NULL DEFAULT NULL,
                            `end_time` timestamp NULL DEFAULT NULL,
                            `breakpoint` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
                            `id` int(11) NOT NULL,
                            `name` varchar(100) NOT NULL,
                            `description` varchar(100) NOT NULL,
                            `stock` int(11) NOT NULL,
                            `retail_price` decimal(10,2) NOT NULL,
                            `wholesale_price` decimal(10,2) NOT NULL,
                            `discount_percent` varchar(255) DEFAULT NULL,
                            `gst_percentage` decimal(10,2) NOT NULL,
                            `gst_amount` decimal(10,2) NOT NULL,
                            `size` varchar(255) DEFAULT NULL,
                            `color` varchar(100) NOT NULL,
                            `product_category_id` int(11) NOT NULL,
                            `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `stock`, `retail_price`, `wholesale_price`, `discount_percent`, `gst_percentage`, `gst_amount`, `size`, `color`, `product_category_id`, `image_url`) VALUES
                                                                                                                                                                                                              (1, 'Dumbell', 'Large size 5kg dumbbell', 0, 25.00, 20.00, '10.00', 10.00, 2.00, 'Large', 'Black', 1, 'https://plus.unsplash.com/premium_photo-1671028546491-f70b21a32cc2?w=900&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8RHVtYmVsbHxlbnwwfHwwfHx8MA%3D%3D'),
                                                                                                                                                                                                              (2, 'Trade Mill', 'Inclined treadmill good for health', 14, 100.00, 80.00, '5.00', 10.00, 10.00, 'Null', 'Black', 2, 'https://5.imimg.com/data5/SELLER/Default/2024/9/452682943/ON/FF/IY/3635530/multi-gym-500x500.jpg'),
                                                                                                                                                                                                              (3, 'Butterfly ', 'Butterfly exercise machine', 0, 2.00, 2.00, '', 2.00, 2.00, 'N/A', 'Black', 1, 'https://www.gymandfitness.com.au/cdn/shop/files/Carousel1_38a81abc-69d5-446b-babd-2083265d5cf0.png?v=1728419671');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
                                      `id` int(11) NOT NULL,
                                      `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `category`) VALUES
                                                        (1, 'Gym Equipments'),
                                                        (2, 'Machines'),
                                                        (3, 'Gym Accessories ');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
                           `id` int(11) NOT NULL,
                           `user_id` int(11) NOT NULL,
                           `product_id` int(11) NOT NULL,
                           `rating` int(1) NOT NULL CHECK (`rating` between 1 and 5),
                           `review_text` text DEFAULT NULL,
                           `status` TINYINT(1) NOT NULL DEFAULT 0,  -- 0 = pending, 1 = approved
                           `created_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
                            `id` int(11) NOT NULL,
                            `name` varchar(100) NOT NULL,
                            `description` varchar(100) NOT NULL,
                            `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `description`, `price`) VALUES
                                                                  (1, 'Installation', 'Installation service', 60.02),
                                                                  (2, 'Repair', 'Repair service', 75.00),
                                                                  (3, 'Both ', 'Both Installation & Repair services', 100.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
                         `id` int(11) NOT NULL,
                         `email` varchar(255) NOT NULL,
                         `password` varchar(255) NOT NULL,
                         `nonce` varchar(255) DEFAULT NULL,
                         `nonce_expiry` datetime DEFAULT NULL,
                         `modified` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
                         `created` datetime NOT NULL DEFAULT current_timestamp(),
                         `user_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `nonce`, `nonce_expiry`, `modified`, `created`, `user_type_id`) VALUES
                                                                                                                    (7, 'paul.powerproshop@gmail.com', '$2y$10$iLmKrOmTeHbG0FLbwv/Ev.x1vc8KKfwgmgXLq.62U6e9cs9M/Yq0S', NULL, NULL, '2025-04-16 19:25:46', '2025-04-16 19:25:13', 2),
                                                                                                                    (8, 'fit@fit.com', '$2y$12$K/wYogsWU3x3fYsfV8lGTeNmEvPKoCbkBNOvXRDWUs6n/H/JsuB82', NULL, NULL, '2025-05-07 22:11:30', '2025-05-07 22:11:30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
                              `id` int(11) NOT NULL,
                              `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `type`) VALUES
                                            (1, 'customer'),
                                            (2, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_forms`
--
ALTER TABLE `contact_forms`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content_blocks`
--
ALTER TABLE `content_blocks`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content_blocks_phinxlog`
--
ALTER TABLE `content_blocks_phinxlog`
    ADD PRIMARY KEY (`version`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `stripe_payment_id` (`stripe_payment_id`),
  ADD KEY `fk_orders_customer` (`customer_id`);

--
-- Indexes for table `orders_products`
--
ALTER TABLE `orders_products`
    ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orders_products_orders` (`order_id`),
  ADD KEY `fk_orders_products_products` (`product_id`);

--
-- Indexes for table `phinxlog`
--
ALTER TABLE `phinxlog`
    ADD PRIMARY KEY (`version`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
    ADD PRIMARY KEY (`id`),
  ADD KEY `fk_products_product_categories` (`product_category_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_product_review` (`user_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_users_user_types` (`user_type_id`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `contact_forms`
--
ALTER TABLE `contact_forms`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `content_blocks`
--
ALTER TABLE `content_blocks`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders_products`
--
ALTER TABLE `orders_products`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
    ADD CONSTRAINT `fk_orders_customer` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders_products`
--
ALTER TABLE `orders_products`
    ADD CONSTRAINT `fk_orders_products_orders` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_orders_products_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
    ADD CONSTRAINT `fk_products_product_categories` FOREIGN KEY (`product_category_id`) REFERENCES `product_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
    ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
    ADD CONSTRAINT `fk_users_user_types` FOREIGN KEY (`user_type_id`) REFERENCES `user_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
