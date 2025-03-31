<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Company;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use App\Models\WorkSchedule;
use App\Models\WorkShift;
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
        $validated = $request->validate([
            'contact' => 'required|string',
            'contact_type' => 'required|in:email,phone',
            'verification_code' => 'required|string',
            'company_name' => 'required|string|max:255',
            'company_email' => 'required|email|unique:companies,email|unique:users,email',
            'company_phone' => 'required|string|unique:companies,phone',
            'company_address' => 'required|string',
            'company_city' => 'required|string',
            'company_country' => 'required|string',
            'admin_name' => 'required|string|max:255',
            'admin_email' => 'required|email|unique:users,email',
            'admin_password' => 'required|string|min:8|confirmed',
        ]);

        // Verify the verification code
        $storedCode = session('verification_code');
        if (!$storedCode || $validated['verification_code'] !== $storedCode) {
            return redirect()->back()->withErrors([
                'verification_code' => 'Invalid verification code',
            ])->withInput();
        }

        DB::transaction(function () use ($validated) {
            // Create company
            $company = Company::create([
                'name' => $validated['company_name'],
                'email' => $validated['company_email'],
                'phone' => $validated['company_phone'],
                'address' => $validated['company_address'],
                'city' => $validated['company_city'],
                'country' => $validated['company_country'],
                'is_primary' => true,
                'is_active' => true,
            ]);

            // Create admin user
            $admin = User::create([
                'name' => $validated['admin_name'],
                'email' => $validated['admin_email'],
                'password' => Hash::make($validated['admin_password']),
                'primary_company_id' => $company->id,
            ]);

            // Create user details
            $admin->userDetails()->create([
                'user_id' => $admin->id,
                'phone' => $validated['company_phone'],
                'address' => $validated['company_address'],
                'city' => $validated['company_city'],
                'country' => $validated['company_country'],
            ]);

            // Create default work schedule
            $workSchedule = WorkSchedule::create([
                'name' => 'Default Work Schedule',
                'start_time' => '09:00:00',
                'end_time' => '17:00:00',
                'grace_period_minutes' => 15,
                'working_days' => ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'],
                'is_default' => true,
                'company_id' => $company->id,
                'is_active' => true,
            ]);

            // Create work shifts
            $morningShift = WorkShift::create([
                'name' => 'Morning Shift',
                'start_time' => '09:00:00',
                'end_time' => '17:00:00',
                'code' => 'WSH'.str_pad($company->id.'1', 4, '0', STR_PAD_LEFT),
                'company_id' => $company->id,
                'is_active' => true,
            ]);

            $eveningShift = WorkShift::create([
                'name' => 'Evening Shift',
                'start_time' => '17:00:00',
                'end_time' => '23:00:00',
                'code' => 'WSH'.str_pad($company->id.'2', 4, '0', STR_PAD_LEFT),
                'company_id' => $company->id,
                'is_active' => true,
            ]);

            // Create default roles
            $roles = [
                'admin' => [
                    'name' => 'admin',
                    'display_name' => 'Administrator',
                    'description' => 'Full access to all company features',
                ],
                'manager' => [
                    'name' => 'manager',
                    'display_name' => 'Manager',
                    'description' => 'Manage employees and departments',
                ],
                'employee' => [
                    'name' => 'employee',
                    'display_name' => 'Employee',
                    'description' => 'Basic employee access',
                ],
            ];

            foreach ($roles as $role) {
                $roleModel = Role::create([
                    'name' => $role['name'],
                    'display_name' => $role['display_name'],
                    'description' => $role['description'],
                    'company_id' => $company->id,
                ]);

                // Assign admin role to the admin user
                if ($role['name'] === 'admin') {
                    UserRole::create([
                        'user_id' => $admin->id,
                        'role_id' => $roleModel->id,
                        'company_id' => $company->id,
                    ]);
                }
            }

            // Assign default work schedule to admin
            $admin->workSchedules()->attach($workSchedule->id, [
                'effective_date' => now(),
                'is_active' => true,
            ]);

            // Assign morning shift to admin for today
            $admin->workShifts()->attach($morningShift->id, [
                'date' => now()->toDateString(),
            ]);

            // Login the admin user
            Auth::login($admin);
        });

        return redirect()->route('dashboard')->with('success', 'Company and admin account created successfully!');
    }
}
