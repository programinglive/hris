# Getting Started with HRIS

Welcome to the HRIS (Human Resource Information System) documentation. This guide will help you get started with the application.

## Prerequisites

Before you begin, make sure you have the following installed on your system:

- PHP 8.1 or higher
- Node.js 18 or higher
- Composer
- npm or yarn
- MySQL 8.0 or higher

## Installation

1. Clone the repository:
```bash
git clone https://github.com/programinglive/hris.git
```

2. Navigate to the project directory:
```bash
cd hris
```

3. Install PHP dependencies:
```bash
composer install
```

4. Install Node.js dependencies:
```bash
npm install
```

5. Copy the environment file:
```bash
cp .env.example .env
```

6. Generate application key:
```bash
php artisan key:generate
```

7. Run database migrations:
```bash
php artisan migrate
```

8. Build the React assets:
```bash
npm run build
```

9. Start the development server:
```bash
php artisan serve
```

## Configuration

### Environment Variables

The application uses environment variables for configuration. Make sure to set the following in your `.env` file:

- `APP_NAME` - Application name
- `APP_ENV` - Application environment (local, production, etc.)
- `APP_KEY` - Application key (generated automatically)
- `DB_CONNECTION` - Database connection (mysql)
- `DB_HOST` - Database host
- `DB_PORT` - Database port
- `DB_DATABASE` - Database name
- `DB_USERNAME` - Database username
- `DB_PASSWORD` - Database password

### Database Setup

The application uses MySQL as its database. Ensure you have a MySQL server running and create a database for the application.

## First Steps

After installation, you can:

1. Access the application at `http://localhost:8000`
2. Log in using the default admin credentials:
   - Email: admin@example.com
   - Password: password

## Next Steps

Once you're logged in, you should:

1. Set up your primary company
2. Configure your organization structure
3. Add employees
4. Set up work schedules and shifts

## Support

For support, please:

- Check the documentation
- Open an issue on GitHub
- Contact the development team
