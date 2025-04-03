<?php

namespace App\Http\Controllers\Installation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class DatabaseSetupController extends Controller
{
    public function index()
    {
        return inertia('Installation/DatabaseSetup', [
            'currentStep' => 2,
            'totalSteps' => 4,
            'databaseConfig' => Config::get('database'),
        ]);
    }

    public function store(Request $request)
    {
        // Validate database configuration
        $validated = $request->validate([
            'database_host' => 'required|string|max:255',
            'database_port' => 'required|numeric',
            'database_name' => 'required|string|max:255',
            'database_username' => 'required|string|max:255',
            'database_password' => 'nullable|string|max:255',
        ]);

        // Update database configuration
        Config::set('database.connections.mysql', [
            'driver' => 'mysql',
            'host' => $validated['database_host'],
            'port' => $validated['database_port'],
            'database' => $validated['database_name'],
            'username' => $validated['database_username'],
            'password' => $validated['database_password'] ?? '',
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
        ]);

        try {
            // Test database connection
            DB::connection()->getPdo();
            
            // Redirect to next step
            return redirect()->route('install.company');
        } catch (\Exception $e) {
            return back()->withErrors([
                'database_connection' => 'Could not connect to the database. Please check your configuration.',
            ]);
        }
    }
}
