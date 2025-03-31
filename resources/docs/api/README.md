# API Documentation

This section contains detailed documentation for the HRIS API endpoints.

## Table of Contents

- [Authentication](#authentication)
- [Employee Management](#employee-management)
- [Organization Management](#organization-management)
- [Attendance Management](#attendance-management)
- [Best Practices](#best-practices)

## Authentication

### Endpoints

- `POST /api/login` - Authenticate user
- `POST /api/register` - Register new user
- `GET /api/user` - Get authenticated user details

## Employee Management

### Endpoints

- `GET /api/employees` - List all employees
- `POST /api/employees` - Create new employee
- `GET /api/employees/{id}` - Get employee details
- `PUT /api/employees/{id}` - Update employee
- `DELETE /api/employees/{id}` - Delete employee

## Organization Management

### Endpoints

- `GET /api/companies` - List all companies
- `POST /api/companies` - Create new company
- `GET /api/companies/{id}` - Get company details
- `PUT /api/companies/{id}` - Update company
- `DELETE /api/companies/{id}` - Delete company

## Attendance Management

### Endpoints

- `GET /api/attendance` - List attendance records
- `POST /api/attendance` - Create attendance record
- `GET /api/attendance/{id}` - Get attendance record
- `PUT /api/attendance/{id}` - Update attendance record
- `DELETE /api/attendance/{id}` - Delete attendance record

## Best Practices

1. Always use proper authentication headers
2. Handle rate limiting appropriately
3. Implement proper error handling
4. Use pagination for large datasets
5. Follow RESTful conventions
