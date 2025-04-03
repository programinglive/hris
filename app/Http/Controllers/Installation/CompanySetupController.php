<?php

namespace App\Http\Controllers\Installation;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CompanySetupController extends Controller
{
    public function index()
    {
        return inertia('Installation/CompanySetup', [
            'currentStep' => Session::get('company_registration_step', 1),
            'totalSteps' => 3,
        ]);
    }

    public function store(Request $request)
    {
        $step = Session::get('company_registration_step', 1);
        
        // Validate based on current step
        $rules = match ($step) {
            1 => [
                'company_name' => 'required|string|max:255',
                'company_email' => 'required|email|unique:companies',
                'company_phone' => 'required|string|max:20',
            ],
            2 => [
                'company_address' => 'required|string',
                'company_city' => 'required|string|max:255',
                'company_country' => 'required|string|max:255',
            ],
            3 => [
                'terms_accepted' => 'required|boolean',
            ],
            default => [
                'company_name' => 'required|string|max:255',
                'company_email' => 'required|email|unique:companies',
                'company_phone' => 'required|string|max:20',
                'company_address' => 'required|string',
                'company_city' => 'required|string|max:255',
                'company_country' => 'required|string|max:255',
                'terms_accepted' => 'required|boolean',
            ],
        };

        $validated = $request->validate($rules);

        // Store progress in session
        Session::put('company_registration_progress', [
            'step' => $step,
            'data' => array_merge(
                Session::get('company_registration_progress.data', []),
                $validated
            ),
        ]);

        // If last step, create company
        if ($step === 3) {
            $progress = Session::get('company_registration_progress');
            
            $company = Company::create([
                'name' => $progress['data']['company_name'],
                'email' => $progress['data']['company_email'],
                'phone' => $progress['data']['company_phone'],
                'address' => $progress['data']['company_address'],
                'city' => $progress['data']['company_city'],
                'country' => $progress['data']['company_country'],
                'is_active' => true,
                'is_primary' => true,
            ]);

            // Clear session data
            Session::forget('company_registration_progress');
            Session::forget('company_registration_step');

            return redirect()->route('install.admin')->with('company', $company);
        }

        // Move to next step
        Session::put('company_registration_step', $step + 1);
        
        return redirect()->route('install.company');
    }

    public function back()
    {
        $step = Session::get('company_registration_step', 1);
        if ($step > 1) {
            Session::put('company_registration_step', $step - 1);
        }
        return redirect()->route('install.company');
    }
}
