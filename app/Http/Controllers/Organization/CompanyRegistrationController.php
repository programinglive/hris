<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class CompanyRegistrationController extends Controller
{
    /**
     * Show the company registration form - step 1.
     */
    public function showRegistrationForm()
    {
        return Inertia::render('auth/register-company');
    }

    /**
     * Step 1: Validate and store contact information
     */
    public function validateContact(Request $request)
    {
        $validated = $request->validate([
            'contact' => 'required|string',
            'contact_type' => 'required|in:email,phone',
        ]);

        $contactType = $validated['contact_type'];
        $contact = $validated['contact'];

        // Additional validation based on contact type
        if ($contactType === 'email') {
            $request->validate([
                'contact' => 'email|unique:users,email|unique:companies,email',
            ]);
        } else {
            $request->validate([
                'contact' => 'regex:/^[0-9+\s]+$/|unique:companies,phone',
            ]);
        }

        // Generate a 6-digit verification code
        $verificationCode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Store verification data in session
        Session::put('registration_data', [
            'contact' => $contact,
            'contact_type' => $contactType,
            'verification_code' => $verificationCode,
            'verified' => false,
        ]);

        // Send verification code
        if ($contactType === 'email') {
            // Send email with verification code
            Log::info('Verification code for '.$contact.': '.$verificationCode);

            try {
                // Send verification email
                Mail::to($contact)->send(new \App\Mail\VerificationCodeMail($verificationCode));
            } catch (\Exception $e) {
                // Log the error but don't fail the process
                Log::error('Failed to send verification email: '.$e->getMessage());
                // Email sending failed, but we still want to proceed with the verification
                // In production, you might want to handle this differently
            }
        } else {
            // Send SMS with verification code
            // In a real app, you would integrate with an SMS service
            Log::info('SMS verification code for '.$contact.': '.$verificationCode);
        }

        return response()->json([
            'success' => true,
            'message' => 'Verification code sent to '.$contact,
            'next_step' => 'verify_code',
        ]);
    }

    /**
     * Step 2: Verify the code
     */
    public function verifyCode(Request $request)
    {
        $validated = $request->validate([
            'verification_code' => 'required|string|size:6',
        ]);

        $registrationData = Session::get('registration_data');

        if (! $registrationData) {
            return response()->json([
                'success' => false,
                'message' => 'Registration session expired. Please start over.',
            ], 400);
        }

        if ($validated['verification_code'] !== $registrationData['verification_code']) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid verification code.',
            ], 400);
        }

        // Mark as verified
        $registrationData['verified'] = true;
        Session::put('registration_data', $registrationData);

        return response()->json([
            'success' => true,
            'message' => 'Verification successful',
            'next_step' => 'company_details',
        ]);
    }

    /**
     * Step 3: Save company and admin details
     */
    public function saveCompanyDetails(Request $request)
    {
        $registrationData = Session::get('registration_data');

        if (! $registrationData || ! $registrationData['verified']) {
            return response()->json([
                'success' => false,
                'message' => 'Please complete verification first.',
            ], 400);
        }

        $validated = $request->validate([
            // Company information
            'company_name' => 'required|string|max:255',

            // Admin user information
            'admin_name' => 'required|string|max:255',
            'admin_email' => 'required|email|unique:users,email',
            'admin_password' => 'required|string|min:8',
        ]);

        // Store company and admin details in session
        $registrationData = array_merge($registrationData, [
            'company_name' => $validated['company_name'],
            'admin_name' => $validated['admin_name'],
            'admin_email' => $validated['admin_email'],
            'admin_password' => $validated['admin_password'],
        ]);

        Session::put('registration_data', $registrationData);

        // Use a transaction to ensure all related records are created or none
        return DB::transaction(function () use ($registrationData) {
            // Create the user
            $user = User::create([
                'name' => $registrationData['admin_name'],
                'email' => $registrationData['admin_email'],
                'password' => Hash::make($registrationData['admin_password']),
            ]);

            // Create the company
            $company = Company::create([
                'name' => $registrationData['company_name'],
                'email' => $registrationData['contact_type'] === 'email' ? $registrationData['contact'] : $registrationData['admin_email'],
                'phone' => $registrationData['contact_type'] === 'phone' ? $registrationData['contact'] : null,
                'owner_id' => $user->id,
            ]);

            // Create the main branch
            Branch::create([
                'name' => 'Main Branch',
                'code' => 'MB-'.strtoupper(substr(str_replace(' ', '', $company->name), 0, 3)).'001',
                'email' => $company->email,
                'phone' => $company->phone,
                'company_id' => $company->id,
                'is_main_branch' => true,
            ]);

            // Log the user in
            Auth::login($user);

            // Clear registration session data
            Session::forget('registration_data');

            return response()->json([
                'success' => true,
                'message' => 'Registration completed successfully',
                'redirect' => route('dashboard'),
            ]);
        });
    }

    /**
     * Complete registration and redirect to dashboard
     */
    public function register(Request $request)
    {
        // This is kept for backward compatibility
        // The new flow uses the step-by-step methods above

        $validated = $request->validate([
            // Company information
            'company_name' => 'required|string|max:255',
            'company_email' => 'required|email|unique:companies,email',
            'company_phone' => 'nullable|string|max:20',
            'company_address' => 'nullable|string',
            'company_city' => 'nullable|string|max:100',
            'company_state' => 'nullable|string|max:100',
            'company_postal_code' => 'nullable|string|max:20',
            'company_country' => 'nullable|string|max:100',

            // User information
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',

            // Main branch information
            'branch_name' => 'required|string|max:255',
        ]);

        // Use a transaction to ensure all related records are created or none
        return DB::transaction(function () use ($validated) {
            // Create the user
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            // Create the company
            $company = Company::create([
                'name' => $validated['company_name'],
                'email' => $validated['company_email'],
                'phone' => $validated['company_phone'] ?? null,
                'address' => $validated['company_address'] ?? null,
                'city' => $validated['company_city'] ?? null,
                'state' => $validated['company_state'] ?? null,
                'postal_code' => $validated['company_postal_code'] ?? null,
                'country' => $validated['company_country'] ?? null,
                'owner_id' => $user->id,
            ]);

            // Create the main branch
            Branch::create([
                'name' => $validated['branch_name'],
                'address' => $validated['company_address'] ?? null,
                'city' => $validated['company_city'] ?? null,
                'state' => $validated['company_state'] ?? null,
                'postal_code' => $validated['company_postal_code'] ?? null,
                'country' => $validated['company_country'] ?? null,
                'phone' => $validated['company_phone'] ?? null,
                'email' => $validated['company_email'],
                'company_id' => $company->id,
                'is_main_branch' => true,
            ]);

            // Log the user in
            Auth::login($user);

            return Redirect::route('dashboard')->with('success', 'Your company has been registered successfully!');
        });
    }
}
