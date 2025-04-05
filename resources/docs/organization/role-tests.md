# Role Model Unit Tests

This document outlines the unit tests for the Role model in the organization module.

## Test Overview

The Role model tests cover the following aspects:

1. **Role Creation**
   - Tests the ability to create a new role with required fields
   - Verifies database persistence and relationships
   - Checks slug generation from name

2. **Role Finding and Creation**
   - Tests the `updateOrCreate` method for role creation
   - Verifies unique constraints on name and company_id
   - Ensures existing roles are found instead of recreated

3. **Role Updates**
   - Tests updating role properties
   - Ensures relationships remain intact
   - Verifies slug remains unchanged

4. **Role Deletion**
   - Tests the deletion of roles
   - Verifies proper cleanup in database

5. **Role-User Relationships**
   - Tests the many-to-many relationship between roles and users
   - Verifies user assignment to roles
   - Checks company context for role assignments

## Required Fields

When creating or updating a role, the following fields are required:

- `name`: The unique name of the role within a company
- `display_name`: The human-readable name of the role
- `description`: Description of the role's responsibilities
- `company_id`: The company to which the role belongs
- `slug`: Automatically generated from name (unique)

## Important Notes

1. **Unique Constraints**
   - Role names must be unique per company
   - Slugs must be globally unique
   - The combination of name and company_id must be unique

2. **Slug Generation**
   - Slugs are automatically generated from the name field
   - Uses hyphens instead of underscores
   - Maintains uniqueness across all roles

3. **Role-User Relationship**
   - Roles can be assigned to multiple users
   - Each user-role assignment requires a company_id
   - Uses the `user_roles` pivot table

## Test Structure

The tests follow modern PHPUnit practices:

1. Uses `#[Test]` attribute instead of `/** @test */`
2. Each test is self-contained
3. Uses `RefreshDatabase` trait for clean database state
4. Follows AAA (Arrange-Act-Assert) pattern
5. Includes proper assertions for all expected outcomes

## Example Usage

```php
// Creating a role
$role = Role::create([
    'name' => 'testrole',
    'display_name' => 'Test Role',
    'description' => 'Test Role Description',
    'company_id' => $company->id,
]);

// Finding or creating a role
$role = Role::updateOrCreate([
    'name' => 'admin',
    'company_id' => $company->id,
], [
    'display_name' => 'Administrator',
    'description' => 'Administrator Role',
]);

// Assigning a role to a user
UserRole::create([
    'user_id' => $user->id,
    'role_id' => $role->id,
    'company_id' => $company->id,
]);
```
