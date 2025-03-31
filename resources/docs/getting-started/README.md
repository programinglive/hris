# Getting Started

Welcome to the HRIS documentation! This guide will help you get started with the system.

## Prerequisites

- PHP 8.1 or higher
- Node.js 16 or higher
- Composer
- npm or yarn
- MySQL 8.0 or higher

## Installation

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
6. Run database migrations:
   ```bash
   php artisan migrate
   ```
7. Start the development server:
   ```bash
   php artisan serve
   npm run dev
   ```

## Accessing the Application

- Frontend: http://localhost:5173
- Backend: http://localhost:8000

## Default Credentials

- Email: admin@example.com
- Password: password

## Next Steps

1. Configure your database settings in `.env`
2. Set up email configuration
3. Configure storage settings
4. Customize the application settings

## Support

For support, please contact the development team or check the [API documentation](../api/README.md).
