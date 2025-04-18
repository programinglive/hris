# Organization Management

This section covers the organization management features of the HRIS system.

## Table of Contents

- [Company Management](#company-management)
- [Branch Management](#branch-management)
- [Department Management](#department-management)
- [Division Management](#division-management)
- [Sub-Division Management](#sub-division-management)
- [Position Management](#position-management)
- [Level Management](#level-management)
- [Brand Management](#brand-management)
- [Role System](#role-system)

## Company Management

### Overview
- Companies are the top-level organization units
- Each company can have multiple branches and brands
- Companies are isolated in terms of data but users can access multiple companies based on permissions

### Registration Process
1. **Contact Information Validation**
   - System validates contact information (email or phone) for uniqueness
   - Verification code is sent to the provided contact

2. **Contact Verification**
   - Users must enter the verification code received
   - System verifies code against stored session data

3. **Company Details Submission**
   - Company name
   - Company email (must be unique)
   - Company phone (must be unique)
   - Company address
   - Company city
   - Company state
   - Company postal code
   - Company country
   - Admin user details:
     - Admin name
     - Admin email
     - Admin password

### Features
- Create and manage company profiles
- Assign company administrators
- Manage company settings and configurations

## Branch Management

### Overview
- Branches represent physical locations of a company
- Each company can have multiple branches
- Branches can have their own departments and divisions

### Features
- Create and manage branch locations
- Assign branch managers
- Track branch-specific metrics

## Department Management

### Overview
- Departments represent functional units within a company
- Departments can be organized into divisions
- Each department can have multiple positions

### Features
- Create and manage department structures
- Assign department heads
- Track department performance

## Division Management

### Overview
- Divisions represent larger organizational units that contain departments
- Divisions can have sub-divisions
- Used for hierarchical organization structure

### Features
- Create and manage division structures
- Organize departments into divisions
- Track division performance

## Sub-Division Management

### Overview
- Sub-divisions represent smaller units within a division
- Used for more granular organizational structure
- Can contain positions and levels

### Features
- Create and manage sub-division structures
- Organize departments into sub-divisions
- Track sub-division performance

## Position Management

### Overview
- Positions represent job roles within the organization
- Each position can have multiple levels
- Positions are associated with departments

### Features
- Create and manage job positions
- Define position responsibilities
- Track position assignments

## Level Management

### Overview
- Levels represent seniority or hierarchy within a position
- Each position can have multiple levels
- Used for career progression tracking

### Features
- Create and manage position levels
- Define level requirements
- Track employee progression

## Brand Management

### Overview
- Brands represent different business units or product lines
- Users can be associated with multiple brands
- Brands can have their own settings and configurations

### Features
- Create and manage brand profiles
- Assign brand managers
- Track brand-specific metrics

## Role System

### Role Structure
- Each role has a unique name per company
- Roles have a slug for URL-friendly identification
- Description field for role description
- Roles are company-specific
- Role names are used for display purposes
- Slugs are automatically generated from role names

### Role Creation
- Super Admin role is created during company registration
- Admin role is a system role with full access
- Roles are assigned to users through the user_roles pivot table
- Role names must be unique within a company
- Role slugs are automatically generated from names

### Role Management
- Roles can be created, updated, and deleted
- Role assignments can be managed through user_roles table
- Role permissions are managed through role permissions
- Role hierarchy is maintained through parent-child relationships

### Best Practices
1. Use meaningful role names that describe the role's purpose
2. Keep role descriptions clear and concise
3. Use role slugs for URL-friendly identification
4. Regularly review and update role permissions
5. Maintain proper role hierarchy

## Best Practices

1. Maintain a clear hierarchy: company -> branch -> department -> division -> sub-division -> position -> level
2. Use consistent naming conventions across the organization
3. Regularly review and update organizational structures
4. Maintain proper documentation for all organizational changes
5. Ensure proper access control and permissions at each level

## Troubleshooting

### Common Issues

1. **Access Denied**
   - Verify user has proper permissions for the company/brand
   - Check role assignments
   - Ensure user is properly associated with the organization unit

2. **Missing Data**
   - Verify data exists in the correct company context
   - Check for proper data isolation
   - Review data migration scripts

3. **Performance Issues**
   - Optimize queries for large organizations
   - Implement proper caching
   - Review database indexes

## API Reference

Refer to the [API Documentation](../../api/README.md) for detailed API endpoints related to organization management.
