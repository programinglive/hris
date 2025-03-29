<?php

namespace Tests\Fixtures;

use Spatie\SimpleExcel\SimpleExcelWriter;

class TestBranchExcelGenerator
{
    /**
     * Generate a test Excel file for branch imports
     *
     * @param string $filePath Path where the Excel file should be saved
     * @param int $count Number of test branches to generate
     * @return void
     */
    public static function generate(string $filePath, int $count = 3): void
    {
        // Create a writer
        $writer = SimpleExcelWriter::create($filePath);
        
        // Add headers by adding a row with the header values
        $writer->addRow([
            'name' => 'name',
            'code' => 'code',
            'address' => 'address',
            'city' => 'city',
            'phone' => 'phone',
            'email' => 'email',
            'is_active' => 'is_active'
        ]);
        
        // Add test data
        for ($i = 1; $i <= $count; $i++) {
            $writer->addRow([
                'name' => "Test Branch {$i}",
                'code' => "BR" . str_pad($i, 3, '0', STR_PAD_LEFT),
                'address' => "123 Test Street {$i}",
                'city' => "Test City {$i}",
                'phone' => "555-123-{$i}" . str_pad($i, 3, '0', STR_PAD_LEFT),
                'email' => "branch{$i}@example.com",
                'is_active' => "Yes"
            ]);
        }
        
        // Close the writer to save the file
        $writer->close();
    }
    
    /**
     * Generate an invalid Excel file for testing validation
     *
     * @param string $filePath Path where the Excel file should be saved
     * @return void
     */
    public static function generateInvalid(string $filePath): void
    {
        // Create a writer
        $writer = SimpleExcelWriter::create($filePath);
        
        // Set headers with missing required columns
        $writer->addRow([
            'name' => 'name',
            'address' => 'address',
            'city' => 'city' // Missing 'code' which is required
        ]);
        
        // Add test data
        for ($i = 1; $i <= 2; $i++) {
            $writer->addRow([
                'name' => "Invalid Branch {$i}",
                'address' => "123 Test Street {$i}",
                'city' => "Test City {$i}"
            ]);
        }
        
        // Close the writer to save the file
        $writer->close();
    }
}
