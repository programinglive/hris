# HRIS Project

A comprehensive Human Resource Information System (HRIS) built with Laravel, Inertia.js, React, and TypeScript.

## About HRIS Project

HRIS Project is a modern human resource management system designed to help businesses streamline their HR operations. The platform provides tools for managing employees, company structure, attendance, and more, all within a user-friendly interface.

### Key Features

- **Company Management**: Create and manage multiple companies, branches, departments, and positions
- **Employee Database**: Maintain comprehensive employee records with customizable fields
- **Attendance Tracking**: Monitor employee attendance, leaves, and overtime
- **User Management**: Role-based access control for different user types
- **Responsive Design**: Works seamlessly on desktop and mobile devices

## Installation

Follow these steps to set up the HRIS Project on your local machine:

### Prerequisites

- PHP 8.1 or higher
- Composer
- Node.js and npm
- MySQL or PostgreSQL

### Setup Instructions

1. **Clone the repository**

```bash
git clone <repository-url>
cd hrisnew
```

2. **Install PHP dependencies**

```bash
composer install
```

3. **Install JavaScript dependencies**

```bash
npm install --legacy-peer-deps
```

4. **Set up environment variables**

```bash
cp .env.example .env
php artisan key:generate
```

5. **Configure your database**

Edit the `.env` file and set your database connection details:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hris_project
DB_USERNAME=root
DB_PASSWORD=
```

6. **Run migrations and seed the database**

```bash
php artisan migrate --seed
```

7. **Build assets**

```bash
npm run dev
```

8. **Start the development server**

```bash
php artisan serve
```

The application will be available at http://localhost:8000

## Usage

After installation, you can:

1. Register your company through the registration page
2. Log in with your admin credentials
3. Set up your company structure (departments, positions, etc.)
4. Add employees and manage their information
5. Configure attendance settings and other HR policies

## Development

### Building for production

```bash
npm run build
```

### Running tests

```bash
php artisan test
```

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
