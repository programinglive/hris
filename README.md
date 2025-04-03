# HRIS Project

A comprehensive Human Resource Information System (HRIS) built with Laravel, Inertia.js, React, and TypeScript.

## About HRIS Project

HRIS Project is a modern human resource management system designed to help businesses streamline their HR operations. The platform provides tools for managing employees, company structure, attendance, and more, all within a user-friendly interface.

### Key Features

- **Organization Management**
  - Create and manage companies, branches, departments, divisions, sub-divisions, positions, and position levels
  - Import branch data using templates
  - Manage multiple brands
  - Organize company structure hierarchically

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

After completing the setup steps, you'll need to run through the installation wizard to configure your HRIS system. The wizard consists of several steps:

1. **Company Setup**
   - Register your company information
   - Enter company name, email, and phone
   - Configure company address
   - Accept terms and conditions

2. **System Setup**
   - Configure system settings
   - Set up default configurations
   - Configure email settings

3. **Admin Setup**
   - Create the first admin user
   - Set up admin credentials
   - Configure admin permissions

4. **Complete**
   - Review all configurations
   - Complete the installation
   - Access the main HRIS system

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

## Company Registration Wizard

The Company Registration Wizard is a step-by-step process that guides administrators through setting up their organization in HRIS Project. This wizard is essential for new installations and ensures that all necessary company information is properly configured before users can access the system.

### Installation Process

1. **System Setup**
   - Environment configuration
   - Database connection
   - Initial data setup

2. **Company Setup**
   - Company information
   - Contact verification
   - Admin user creation

3. **Basic Configuration**
   - Company logo
   - Description
   - Settings

4. **Final Configuration**
   - Email settings
   - Storage configuration
   - Application settings

### Registration Process

1. **Company Information**
   - Enter basic company details
   - Set up primary company information
   - Configure company contact information
   - Upload company logo (optional)

2. **Administrator Setup**
   - Create the first admin user
   - Set up admin credentials
   - Assign initial roles and permissions

3. **Basic Configuration**
   - Set up initial departments
   - Configure work schedules
   - Set up default settings

### Accessing the Registration Wizard

- The wizard is automatically triggered when no companies exist in the system
- Users attempting to access any authentication routes (login, register) will be redirected to the wizard
- The wizard must be completed before any other functionality can be accessed

### Security Features

- All registration data is validated before submission
- Password requirements are enforced for admin accounts
- Company information is validated against existing records
- Session-based security to prevent unauthorized access

### Verification System

- Contact verification through email or phone
- 6-digit verification code system
- Automatic code sending
- Secure session-based verification

### Error Handling

- Clear error messages for each step
- Validation feedback
- Progress tracking
- Ability to go back and edit previous steps

### Technical Requirements

- Uses Inertia.js for frontend
- Laravel middleware for routing
- Secure session handling
- Comprehensive testing coverage

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
