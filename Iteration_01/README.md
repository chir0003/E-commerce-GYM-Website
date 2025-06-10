# E-commerce Application

A modern e-commerce application built with CakePHP 5.1, featuring product management, user authentication, and Stripe payment integration.

## Project Structure

```
├── bin/                    # Command-line tools and scripts
├── config/                 # Application configuration files
├── logs/                   # Application logs
├── plugins/               # CakePHP plugins
├── resources/             # Frontend assets and resources
├── src/                   # Application source code
│   ├── Controller/       # Controller classes
│   ├── Model/           # Model classes
│   ├── View/            # View templates
│   ├── Console/         # Console commands
│   └── Component/       # Reusable components
├── templates/            # View templates
├── tests/               # Test files
├── tmp/                 # Temporary files
├── vendor/              # Composer dependencies
└── webroot/             # Public web root directory
```

## Naming Conventions

### Controllers
- Located in `src/Controller/`
- Named in PascalCase with 'Controller' suffix
- Example: `ProductsController.php`, `OrdersController.php`

### Models
- Located in `src/Model/`
- Named in PascalCase
- Example: `Product.php`, `Order.php`

### Views/Templates
- Located in `templates/`
- Organized by controller name
- Template files use `.php` extension
- Example: `templates/Products/shop.php`

### Database Tables
- Use snake_case
- Plural form
- Example: `products`, `orders`, `users`

### Components
- Located in `src/Component/`
- Named in PascalCase with 'Component' suffix
- Example: `AuthorizationComponent.php`

## How to Navigate the Codebase

### Key Components

1. **Controllers**
   - Handle HTTP requests and responses
   - Located in `src/Controller/`
   - Main controllers include:
     - `ProductsController`: Product listing and management
     - `OrdersController`: Order processing and management
     - `UsersController`: User authentication and management
     - `AuthController`: Handles user authentication (both admin and customer)
     - `AppointmentsController`: Manages appointment scheduling and tracking

2. **Models**
   - Handle data and business logic
   - Located in `src/Model/`
   - Key models include:
     - `Product`: Product data and relationships
     - `Order`: Order processing and validation
     - `User`: User authentication and management (supports both admin and customer roles)
     - `Appointment`: Appointment scheduling and management

3. **Views/Templates**
   - Located in `templates/`
   - Organized by controller name
   - Use CakePHP's template engine

4. **Components**
   - Located in `src/Component/`
   - Key components include:
     - `AuthorizationComponent`: Handles admin authentication and authorization
     - Used in controllers to check for admin privileges

5. **Configuration**
   - Database settings: `config/app_local.php`
   - Application settings: `config/app.php`
   - Routes: `config/routes.php`

### Authentication System

1. **User Authentication**
   - Handled by `AuthController`
   - Supports both admin and customer roles
   - Uses CakePHP Authentication plugin
   - User data stored in `users` table

2. **Admin Authentication**
   - Managed by `AuthorizationComponent`
   - Used in controllers to restrict access to admin-only features
   - Example usage in controllers:
     ```php
     public function beforeFilter(\Cake\Event\EventInterface $event)
     {
         parent::beforeFilter($event);
         $this->requireAdmin(); // Restricts access to admin users only
     }
     ```

### Common Tasks

1. **Adding a New Product**
   - Use `ProductsController::add()`
   - Template: `templates/Products/add.php`
   - Requires admin authentication

2. **Processing Orders**
   - Use `OrdersController::add()`
   - Template: `templates/Orders/add.php`

3. **Managing Appointments**
   - Use `AppointmentsController`
   - Key actions:
     - `index()`: View all appointments
     - `add()`: Schedule new appointment
     - `edit()`: Modify existing appointment
     - `delete()`: Cancel appointment
   - Templates: `templates/Appointments/`
   - Supports both admin and customer views

4. **User Authentication**
   - Handled by `AuthController`
   - Supports both admin and customer login
   - Uses CakePHP Authentication plugin

## Development Setup

1. Install dependencies:
   ```bash
   composer install
   ```

2. Configure database in `config/app_local.php`

3. Run database migrations:
   ```bash
   bin/cake migrations migrate
   ```

4. Start development server:
   ```bash
   bin/cake server
   ```

## Testing

Run tests using:
```bash
composer test
```

