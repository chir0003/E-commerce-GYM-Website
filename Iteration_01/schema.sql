DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS user_types;
DROP TABLE IF EXISTS addresses;
DROP TABLE IF EXISTS contact_forms;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS product_categories;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS fulfilment_methods;
DROP TABLE IF EXISTS orders_products;
DROP TABLE IF EXISTS services;
DROP TABLE IF EXISTS service_types;
DROP TABLE IF EXISTS appointments;
DROP TABLE IF EXISTS appointments_services;
DROP TABLE IF EXISTS document_types;
DROP TABLE IF EXISTS documents;
DROP TABLE IF EXISTS documents_items;
DROP TABLE IF EXISTS payments;
DROP TABLE IF EXISTS payment_types;
DROP TABLE IF EXISTS receipts;

-- users table
CREATE TABLE `users` (
                         `id`            INT AUTO_INCREMENT PRIMARY KEY,
                         `email`         VARCHAR(255) NOT NULL UNIQUE,
                         `password`      VARCHAR(255) NOT NULL,
                         `nonce`         VARCHAR(255),
                         `nonce_expiry`  DATETIME,
                         `modified`      DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                         `created`       DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                         `user_type_id`  INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- user_types table
CREATE TABLE `user_types` (
                              `id`   INT AUTO_INCREMENT PRIMARY KEY,
                              `type` VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- addresses table
CREATE TABLE `addresses` (
                             `id`              INT AUTO_INCREMENT PRIMARY KEY,
                             `name`            VARCHAR(100) NOT NULL,
                             `street`          VARCHAR(255) NOT NULL,
                             `suburb`          VARCHAR(100) NOT NULL,
                             `state`           VARCHAR(10) NOT NULL,
                             `postcode`        VARCHAR(4) NOT NULL,
                             `default_address` BOOLEAN DEFAULT FALSE,
                             `user_id`         INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- contact_forms table
CREATE TABLE `contact_forms` (
                                 `id`              INT AUTO_INCREMENT PRIMARY KEY,
                                 `name`            VARCHAR(255) NOT NULL,
                                 `email`           VARCHAR(255) NOT NULL,
                                 `message`         TEXT NOT NULL,
                                 `created`         DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- products table
CREATE TABLE `products` (
                            `id`              INT AUTO_INCREMENT PRIMARY KEY,
                            `name`            VARCHAR(100) NOT NULL,
                            `description`     VARCHAR(100) NOT NULL,
                            `stock`           INT NOT NULL,
                            `retail_price`    DECIMAL(10, 2) NOT NULL,
                            `wholesale_price` DECIMAL(10, 2) NOT NULL,
                            `contact_number`  VARCHAR(100) NOT NULL,
                            `gst_percentage`  DECIMAL(10, 2) NOT NULL,
                            `gst_amount`      DECIMAL(10, 2) NOT NULL,
                            `size`            VARCHAR(10) NOT NULL,
                            `color`           VARCHAR(100) NOT NULL,
                            `product_category_id` INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- product_categories table
CREATE TABLE `product_categories` (
                                      `id` INT AUTO_INCREMENT PRIMARY KEY,
                                      `category` VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `orders` (
                          `id` INT AUTO_INCREMENT PRIMARY KEY,
                          `total_amount` DECIMAL(65, 2) NOT NULL,
                          `status` VARCHAR(100) NOT NULL,
                          `created_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                          `pickup_location` VARCHAR(100) NOT NULL,
                          `delivery_status` VARCHAR(100) NOT NULL,
                          `delivery_date` VARCHAR(100) NOT NULL,
                          `notes` VARCHAR(255) NOT NULL,
                          `delivery_address_id` INT NOT NULL,
                          `user_id` INT NOT NULL,
                          `fulfilment_method_id` INT NOT NULL,
                          `payment_id` INT NOT NULL,
                          `receipt_id` INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- fulfilment_methods table
CREATE TABLE `fulfilment_methods` (
                                      `id`   INT AUTO_INCREMENT PRIMARY KEY,
                                      `type` VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- orders_products table
CREATE TABLE `orders_products` (
                                   `id`         INT AUTO_INCREMENT PRIMARY KEY,
                                   `quantity`   DECIMAL(65) NOT NULL,
                                   `price`      DECIMAL(65, 2) NOT NULL,
                                   `order_id`   INT NOT NULL,
                                   `product_id` INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- services table
CREATE TABLE `services` (
                            `id`              INT AUTO_INCREMENT PRIMARY KEY,
                            `name`            VARCHAR(100) NOT NULL,
                            `details`         VARCHAR(100) NOT NULL,
                            `service_type_id` INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- service_types table
CREATE TABLE `service_types` (
                                 `id`   INT AUTO_INCREMENT PRIMARY KEY,
                                 `type` VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- appointments table
CREATE TABLE `appointments` (
                                `id`             INT AUTO_INCREMENT PRIMARY KEY,
                                `name`           VARCHAR(100) NOT NULL,
                                `created_date`   TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                `scheduled_date` DATETIME NOT NULL,
                                `location`       VARCHAR(100) NOT NULL,
                                `status`         VARCHAR(100) NOT NULL,
                                `notes`          VARCHAR(255) NOT NULL,
                                `service_id`     INT NOT NULL,
                                `customer_id`    INT NOT NULL,
                                `technician_id`  INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- appointments_services table
CREATE TABLE `appointments_services` (
                                         `id`             INT AUTO_INCREMENT PRIMARY KEY,
                                         `quantity`       DECIMAL(65) NOT NULL,
                                         `price`          DECIMAL(65, 2) NOT NULL,
                                         `notes`          TEXT NOT NULL,
                                         `service_id`     INT NOT NULL,
                                         `appointment_id` INT NOT NULL,
                                         `technician_id`  INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- document_types table
CREATE TABLE document_types (
                                id   INT AUTO_INCREMENT PRIMARY KEY,
                                type VARCHAR(100) NOT NULL
);

-- documents table
CREATE TABLE documents (
                           id               INT AUTO_INCREMENT PRIMARY KEY,
                           created_date     TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                           due_date         DATE,
                           status           VARCHAR(50) NOT NULL,
                           total_amount     DECIMAL(65, 2) NOT NULL,
                           notes            TEXT,
                           document_type_id INT NOT NULL,
                           user_id          INT NOT NULL,
                           order_id         INT NOT NULL
);

-- documents_items table
CREATE TABLE documents_items (
                                 id           INT AUTO_INCREMENT PRIMARY KEY,
                                 item_id      INT,
                                 document_id  INT,
                                 quantity     INT NOT NULL,
                                 price        DECIMAL(65, 2) NOT NULL,
                                 description  TEXT,
                                 total_amount DECIMAL(65, 2) NOT NULL
);

-- payments table
CREATE TABLE payments (
                          id           INT AUTO_INCREMENT PRIMARY KEY,
                          amount       DECIMAL(65, 2) NOT NULL,
                          created_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                          status       VARCHAR(50) NOT NULL,
                          user_id      INT,
                          order_id     INT,
                          receipt_id   INT
);

-- payment_types table
CREATE TABLE payment_types (
                               id   INT AUTO_INCREMENT PRIMARY KEY,
                               type VARCHAR(100) NOT NULL
);

-- receipts table
CREATE TABLE receipts (
                          id           INT AUTO_INCREMENT PRIMARY KEY,
                          name         VARCHAR(255) NOT NULL,
                          created_date DATE NOT NULL,
                          amount       DECIMAL(65, 2) NOT NULL,
                          payment_date DATE NOT NULL,
                          payment_id   INT,
                          document_id  INT
);

-- Add foreign keys
-- users FK
ALTER TABLE `users`
    ADD CONSTRAINT `fk_users_user_types` FOREIGN KEY (`user_type_id`) REFERENCES `user_types`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- addresses FK
ALTER TABLE `addresses`
    ADD CONSTRAINT `fk_addresses_users` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- products FK
ALTER TABLE `products`
    ADD CONSTRAINT `fk_products_product_categories` FOREIGN KEY (`product_category_id`) REFERENCES `product_categories`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- orders_products FK
ALTER TABLE `orders_products`
    ADD CONSTRAINT `fk_orders_products_orders` FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `fk_orders_products_products` FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- orders FK
ALTER TABLE `orders`
    ADD CONSTRAINT `fk_orders_addresses` FOREIGN KEY (`delivery_address_id`) REFERENCES `addresses`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `fk_orders_users` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `fk_orders_fulfilment_methods` FOREIGN KEY (`fulfilment_method_id`) REFERENCES `fulfilment_methods`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `fk_orders_payments` FOREIGN KEY (`payment_id`) REFERENCES `payments`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `fk_orders_receipts` FOREIGN KEY (`receipt_id`) REFERENCES `receipts`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- services FK
ALTER TABLE `services`
    ADD CONSTRAINT `fk_services_service_types` FOREIGN KEY (`service_type_id`) REFERENCES `service_types`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- appointments_services FK
ALTER TABLE `appointments_services`
    ADD CONSTRAINT `fk_appointments_services_appointments` FOREIGN KEY (`appointment_id`) REFERENCES `appointments`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `fk_appointments_services_services` FOREIGN KEY (`service_id`) REFERENCES `services`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- documents_items FK
ALTER TABLE `documents_items`
    ADD CONSTRAINT `fk_documents_items_documents` FOREIGN KEY (`document_id`) REFERENCES `documents`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--  Add the payment_type_id column to the payments table
ALTER TABLE `payments`
    ADD COLUMN `payment_type_id` INT NOT NULL;
-- payments FK

ALTER TABLE `payments`
    ADD CONSTRAINT `fk_payments_payment_types` FOREIGN KEY (`payment_type_id`) REFERENCES `payment_types`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;
