# HRIS By ProgramingLive Community

Welcome to our community-driven Human Resource Information System (HRIS) project.
This open-source project is initiated and actively maintained by the Programing Live Community.

## Overview

Our HRIS solution is designed to support multiple tenants,
allowing different organizations
to manage their respective human resource requirements in isolated instances within the same HRIS.
This improves the utility and efficiency of our system,
making it a suitable choice for software service providers, organizational franchises,
large scale corporations with semi-independent branches, and more.

<details>
<summary>Minimum Viable Product (MVP)</summary>

The primary feature set we aim to achieve for our MVP includes:

1. **Company Registration:** Companies need to be able to register themselves to use this application. This process would involve providing company details, setting up an administrator account, and agreeing to any applicable terms and conditions. Once registered, the company should have its own isolated space within the application to operate independently.
2. **Sister Company Management:** Aside from operating their own space, registered companies should be able to add and manage sister companies within their system. This facilitates centralized HR management for business conglomerates or franchises having multiple sister companies.

</details>

## Features

- Employee Management: Manage all details of your employees in one place.
- Payroll System: Seamless payroll process with accurate computations.
- Recruitment: Streamlined hiring process from job posting to onboarding.
- Training: Keep track of employee training and professional development.
- Compliance: Ensure your organization is compliant with labor laws and regulations.

## Getting Started

To get started contributing to this project, please see the [CONTRIBUTING.md](CONTRIBUTING.md) guide.

## Tech Stack

This project uses various technologies:

- PHP 8.2 with Laravel Framework v11.10.0
- Laravel Livewire for real-time interfaces
- SQLite for database
- PHPUnit for testing
- Various Composer and JavaScript packages

## Installation Instructions

Make sure you have PHP, Composer, Node.js and Yarn installed on your machine before starting the installation.

```shell
# Clone the repository using git
git clone https://github.com/programinglive/hris.git
# Navigate into the directory
cd hris
# Install PHP dependencies with Composer
composer install
# Install Node.js dependencies with Yarn
yarn install
# Copy .env.example file to .env
cp .env.example .env
# Generate a fresh app key
php artisan key:generate
# Run the database migrations and seeders
php artisan migrate --seed
# Compile the frontend assets
yarn dev
# Serve the application
php artisan serve
```

The application should now be running at `http://localhost:8000`.

## Contributions

We value your contributions!
Whether it's a bug report, new feature, correction, or additional documentation, we greatly appreciate any improvements.

We hope you enjoy exploring our project, and we're excited to have you here!

## License

This project is licensed under the MIT License.