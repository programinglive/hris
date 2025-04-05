# HRIS SaaS Open Source Project

A comprehensive Human Resource Information System (HRIS) built with Laravel, Inertia.js, React, and TypeScript. This open-source project is designed to help businesses streamline their HR operations, and while it's being used by BeautyWorld, it's available for anyone to use and contribute to.

## About HRIS Project

HRIS Project is a modern human resource management system designed to help businesses streamline their HR operations. The platform provides tools for managing employees, company structure, attendance, and more, all within a user-friendly interface.

### Key Features

- **Organization Management**
  - Create and manage companies, branches, departments, divisions, sub-divisions, positions, and position levels
  - Import branch data using templates
  - Manage multiple brands
  - Organize company structure hierarchically
  - Secure company registration with verification

- **Employee Management**
  - Comprehensive employee database with detailed records
  - Import employee data in bulk
  - View and manage employee users
  - Support for multiple roles per user
  - Associate employees with multiple brands

- **User Management**
  - Role-based access control
  - Multiple roles per user
  - Multiple brands per user
  - Multiple work schedules per user
  - One work shift per day

- **Modern Interface**
  - Built with React and Inertia.js
  - Responsive design for desktop and mobile
  - Intuitive navigation
  - Real-time updates

## Installation

Follow these steps to set up the HRIS Project on your local machine:

### Prerequisites

- PHP 8.3 or higher
- Composer
- Node.js and npm
- SQLite (for development)
- MySQL or PostgreSQL (for production)

### Setup Instructions

1. **Clone the repository**

```bash
git clone https://github.com/beautyworld_repository/hrisnew.git
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

For development (SQLite):
Edit the `.env` file:

```
DB_CONNECTION=sqlite
```

For production (MySQL/PostgreSQL):
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

7. **Start the development server**

```bash
php artisan serve
npm run dev
```

## Installation Wizard

The Installation Wizard is a one-time setup process that runs when you first pull and install the application. It is used to set up the initial company configuration and administrator account. This wizard:

- Runs only once during fresh installation
- Sets up the primary company that will be used to manage the HRIS system
- Creates the initial administrator account
- Configures essential system settings
- Must be completed before any other functionality is accessible

### Key Differences

| Feature | Installation Wizard | Company Registration |
|---------|---------------------|----------------------|
| Purpose | Initial system setup | New company registration |
| Usage   | One-time during installation | Available after installation |
| Access  | First-time users only | Available to all users |
| Result  | Sets up primary company | Creates additional company |
| Flow    | Required before use | Optional after setup |

## Company Registration

Company Registration is a feature for users who want to use the HRIS system as a SaaS application. It allows:

- Existing users to register new companies
- Users to join the HRIS system as a new company
- Multiple companies to use the same HRIS instance
- Companies to have their own separate data and configurations

## Security Features

- All registration data is validated before submission
- Password requirements are enforced for admin accounts
- Company information is validated against existing records
- Session-based security to prevent unauthorized access
- 6-digit verification code system
- Contact verification through email or phone

### Verification System

- Contact verification through email or phone
- 6-digit verification code system
- Automatic code sending
- Secure session-based verification
- Multiple verification attempts allowed

### Error Handling

- Clear error messages for each step
- Validation feedback
- Progress tracking
- Ability to go back and edit previous steps

## Usage

Once the installation wizard is complete, you can access the HRIS system through your web browser. The system provides a comprehensive interface for managing all HR-related tasks.

### Accessing the System

- Login URL: `http://localhost:8000`
- Default admin credentials will be set during the installation wizard

### Features

1. **Organization Management**
   - Create and manage companies, branches, departments, divisions, sub-divisions, positions, and position levels
   - Import branch data using templates
   - Manage multiple brands
   - Organize company structure hierarchically

2. **Employee Management**
   - Comprehensive employee database with detailed records
   - Import employee data in bulk
   - View and manage employee users
   - Support for multiple roles per user
   - Associate employees with multiple brands

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
