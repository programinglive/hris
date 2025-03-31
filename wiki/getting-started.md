# Getting Started with BeautyHRIS

## Prerequisites

Before you begin, ensure you have the following installed:

- PHP 8.1 or higher
- Composer
- Node.js and npm
- MySQL 8.0 or higher
- Git

## Installation

1. Clone the repository:
```bash
git clone https://gitlab.com/beautyworld_repository/hrisnew.git
```

2. Install PHP dependencies:
```bash
cd hrisnew
composer install
```

3. Install Node.js dependencies:
```bash
npm install
```

4. Copy the environment file and configure it:
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
# Start PHP development server
php artisan serve

# Start React development server
npm run dev
```

## Company Registration Flow

1. **Contact Information**
   - Enter company contact details
   - Validate email/phone
   - Receive verification code

2. **Verification**
   - Enter 6-digit verification code
   - Confirm contact information

3. **Company Details**
   - Enter company information
   - Create admin user
   - Set up main branch

4. **Success**
   - Complete registration
   - Access admin dashboard

## Multi-Company Support

BeautyHRIS supports multi-company functionality where:

- Users can belong to multiple companies
- Each user has a primary company
- Company data is isolated
- Users can have roles across different companies
- Primary company determines main organization context

## Next Steps

- [Architecture Overview](architecture.md)
- [Development Guidelines](development-guidelines.md)
- [API Documentation](api-documentation.md)