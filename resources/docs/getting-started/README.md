# Getting Started

Welcome to the HRIS documentation! This guide will help you get started with the system.

## Prerequisites

- PHP 8.1 or higher
- Node.js 16 or higher
- Composer
- npm or yarn
- MySQL 8.0 or higher

## Installation Wizard

### Step 1: System Setup

1. Clone the repository
2. Install PHP dependencies:
   ```bash
   composer install
   ```
3. Install Node.js dependencies:
   ```bash
   npm install
   ```
4. Copy the environment file:
   ```bash
   cp .env.example .env
   ```
5. Generate application key:
   ```bash
   php artisan key:generate
   ```

### Step 2: Database Configuration

1. Configure your database settings in `.env`:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=hris
   DB_USERNAME=root
   DB_PASSWORD=your_password
   ```
2. Run database migrations:
   ```bash
   php artisan migrate
   ```

### Step 3: Initial User Setup

1. Create your first user account:
   - Email: admin@example.com
   - Password: password
2. Log in to the system

### Step 4: Company Setup Wizard

1. **Company Information**
   - Enter company name
   - Set company code (auto-generated)
   - Add company email
   - Add company phone
   - Enter company address
   - Select country
   - Select city
   - Set company as primary (checked by default for first company)

2. **Basic Configuration**
   - Set company logo
   - Add company description
   - Configure company settings
   - Set up initial departments
   - Configure work schedules

3. **User Roles**
   - Set up initial admin user
   - Configure user permissions
   - Set up user roles
   - Assign departments

### Step 5: Final Configuration

1. Configure email settings
2. Set up storage configuration
3. Customize application settings
4. Configure backup settings

## Accessing the Application

- Frontend: http://localhost:5173
- Backend: http://localhost:8000

## Troubleshooting

### Common Issues

1. **Database Connection**
   - Verify database credentials in `.env`
   - Check database server status
   - Ensure proper permissions

2. **User Authentication**
   - Reset password if needed
   - Verify email address
   - Check user permissions

3. **Company Setup**
   - Ensure company is marked as primary
   - Verify company settings
   - Check user-company associations

## Support

For support, please contact the development team or check the [API documentation](../api/README.md).
