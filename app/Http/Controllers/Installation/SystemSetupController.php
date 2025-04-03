<?php

namespace App\Http\Controllers\Installation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class SystemSetupController extends Controller
{
    public function index()
    {
        return inertia('Installation/SystemSetup', [
            'currentStep' => 1,
            'totalSteps' => 4,
            'systemConfig' => Config::get('app'),
        ]);
    }

    public function store(Request $request)
    {
        // Validate system configuration
        $validated = $request->validate([
            'environment' => 'required|in:development,production',
            'app_name' => 'required|string|max:255',
            'app_url' => 'required|url',
        ]);

        // Save configuration
        Config::set('app.environment', $validated['environment']);
        Config::set('app.name', $validated['app_name']);
        Config::set('app.url', $validated['app_url']);

        // Redirect to next step
        return redirect()->route('install.database');
    }
}
