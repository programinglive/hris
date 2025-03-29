<?php

namespace Tests\Fixtures;

use Spatie\SimpleExcel\SimpleExcelWriter;

class TestEmployeeExcelGenerator
{
    /**
     * Generate a test Excel file for employee import testing
     *
     * @param string $filePath Path where the Excel file should be saved
     * @param int $numberOfEmployees Number of test employees to generate
     * @return string The path to the generated file
     */
    public static function generate(string $filePath, int $numberOfEmployees = 3): string
    {
        $writer = SimpleExcelWriter::create($filePath);
        
        // Add header row
        $writer->addRow([
            'name' => 'Employee Name',
            'email' => 'Email',
            'password' => 'Password',
            'employee_id' => 'Employee ID',
            'position' => 'Position',
            'department' => 'Department',
            'join_date' => 'Join Date (YYYY-MM-DD)',
            'status' => 'Status',
            'gender' => 'Gender',
            'birth_date' => 'Birth Date (YYYY-MM-DD)',
            'marital_status' => 'Marital Status',
            'phone' => 'Phone',
            'address' => 'Address',
            'emergency_contact_name' => 'Emergency Contact Name',
            'emergency_contact_relationship' => 'Emergency Contact Relationship',
            'emergency_contact_phone' => 'Emergency Contact Phone',
        ]);
        
        // Add sample data
        for ($i = 1; $i <= $numberOfEmployees; $i++) {
            $writer->addRow([
                'name' => "Test Employee {$i}",
                'email' => "test.employee{$i}@example.com",
                'password' => "password123",
                'employee_id' => "EMP" . str_pad($i, 3, '0', STR_PAD_LEFT),
                'position' => "Test Position {$i}",
                'department' => "Test Department",
                'join_date' => date('Y-m-d'),
                'status' => 'Active',
                'gender' => ($i % 2 == 0) ? 'Male' : 'Female',
                'birth_date' => '1990-01-01',
                'marital_status' => 'Single',
                'phone' => '1234567890',
                'address' => "123 Test Street, City {$i}",
                'emergency_contact_name' => "Emergency Contact {$i}",
                'emergency_contact_relationship' => 'Family',
                'emergency_contact_phone' => '0987654321',
            ]);
        }
        
        return $filePath;
    }
}
