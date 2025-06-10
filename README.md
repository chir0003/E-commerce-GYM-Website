# PowerProShop - Gym Equipment E-commerce Website

PowerProShop is a comprehensive e-commerce platform for gym equipment and services, built using CakePHP framework. The platform offers equipment sales, repair services, and professional installation services for both home and commercial gyms.

## Features

- E-commerce functionality for gym equipment
- Service booking system for repairs and installations
- User authentication and role-based access control
- Shopping cart and order management
- Stripe payment integration
- Contact form for inquiries
- Admin dashboard for managing products, services, and orders
- Responsive design for all devices

## Prerequisites

- PHP 8.2 or higher
- MySQL 10.4 or higher
- Composer (PHP package manager)
- Web server (Apache/Nginx)
- Node.js and npm (for frontend assets)

## Installation

1. Clone the repository:
```bash
git clone https://github.com/chir0003/E-commerce-GYM-Website.git
cd E-commerce-GYM-Website
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install frontend dependencies:
```bash
npm install
```

4. Configure your web server to point to the `webroot` directory

## Database Setup

### Option 1: Using phpMyAdmin

1. Open phpMyAdmin in your web browser (typically at `http://localhost/phpmyadmin`)
2. Click on "New" in the left sidebar to create a new database
3. Enter `powerproshop_testdb` as the database name and click "Create"
4. Select the newly created database from the left sidebar
5. Click on the "Import" tab at the top
6. Click "Choose File" and select the `powerproshop_testdb.sql` file from your project directory
7. Scroll down and click "Go" to import the database

### Option 2: Using MySQL Command Line

1. Create a new MySQL database:
```sql
CREATE DATABASE powerproshop_testdb;
```

2. Import the database schema and initial data:
```bash
mysql -u your_username -p powerproshop_testdb < powerproshop_testdb.sql
```

### Configure Database Connection

After setting up the database using either method:

1. Copy `config/app_local.example.php` to `config/app_local.php`
2. Update the database credentials in `config/app_local.php`:
```php
'Datasources' => [
    'default' => [
        'host' => 'localhost',
        'username' => 'your_username',
        'password' => 'your_password',
        'database' => 'powerproshop_testdb',
    ],
]
```

## Running the Application

1. Start your web server and MySQL service

2. Run database migrations:
```bash
bin/cake migrations migrate
```

3. Start the development server:
```bash
bin/cake server
```

4. Access the application at `http://localhost:8765`

## Default Admin Credentials

- Email: paul.powerproshop@gmail.com
- Password: powerproshop2025

## Core Database Tables

The database consists of the following main tables:

1. `users` - User accounts and authentication
2. `products` - Gym equipment and accessories
3. `product_categories` - Categories for products
4. `orders` - Customer orders
5. `orders_products` - Order items
6. `appointments` - Service bookings
7. `services` - Available services
8. `customers` - Customer information
9. `contact_forms` - Customer inquiries
10. `reviews` - Product reviews
11. `content_blocks` - Dynamic content management

## Development

### Directory Structure

- `config/` - Configuration files
- `src/` - Application source code
- `templates/` - View templates
- `webroot/` - Public assets
- `tests/` - Test files

### Running Tests

```bash
vendor/bin/phpunit
```

## Contributing

1. Fork the repository
2. Create your feature branch
3. Commit your changes
4. Push to the branch
5. Create a Pull Request

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Support

For support, please contact:
- Email: paul.powerproshop@gmail.com
- Phone: 0412 345 678
- Address: 740/742 Burwood Hwy, Ferntree Gully VIC 3156
