<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Company;
use App\Models\Role;
use App\Models\SystemSetting;
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
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class CompanyRegistrationController extends Controller
{
    /**
     * Show the company registration form - step 1.
     */
    public function showRegistrationForm()
    {
        return Inertia::render('auth/register-company', [
            'title' => 'Installation'
        ]);
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
                'contact' => 'email|unique:companies,email',
            ]);

        } else {
            $request->validate([
                'contact' => 'regex:/^[0-9+\s]+$/|unique:companies,phone',
            ]);
        }

        // Generate a 6-digit verification code
        $verificationCode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Store verification data in session with expiration
        $registrationData = [
            'contact' => $contact,
            'contact_type' => $contactType,
            'verification_code' => $verificationCode,
            'verified' => false,
            'created_at' => now(),
            'expires_at' => now()->addMinutes(5), // 5 minute expiration
        ];

        Session::put('registration_data', $registrationData);

        // Send verification code
        if ($contactType === 'email') {
            try {
                Mail::to($contact)->send(new \App\Mail\VerificationCodeMail($verificationCode));
                Log::info('Verification code sent to email: '.$contact);
            } catch (\Exception $e) {
                Log::error('Failed to send verification email: '.$e->getMessage());
                return back()
                    ->withInput()
                    ->withErrors([
                        'contact' => 'Failed to send verification code. Please try again.',
                    ]);
            }
        } else {
            Log::info('SMS verification code for '.$contact.': '.$verificationCode);
        }

        return Inertia::render('auth/register-company', [
            'contactData' => $validated,
            'currentStep' => 'Verification',
            'error' => null
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
            return back()
                ->withInput()
                ->withErrors([
                    'verification_code' => 'Session expired. Please start over.',
                ]);
        }

        // Check if code has expired
        if ($registrationData['expires_at'] < now()) {
            return back()
                ->withInput()
                ->withErrors([
                    'verification_code' => 'Verification code has expired. Please request a new code.',
                ]);
        }

        if ($validated['verification_code'] !== $registrationData['verification_code']) {
            return back()
                ->withInput()
                ->withErrors([
                    'verification_code' => 'The verification code is invalid.',
                ]);
        }

        // Mark as verified
        $registrationData['verified'] = true;
        Session::put('registration_data', $registrationData);

        return back()->with('success', 'Verification successful! Please proceed to the next step.');
    }

    /**
     * Resend verification code
     */
    public function resendCode(Request $request)
    {
        $registrationData = Session::get('registration_data');

        if (! $registrationData) {
            return back()
                ->withInput()
                ->withErrors([
                    'contact' => 'Session expired. Please start over.',
                ]);
        }

        if ($registrationData['verified']) {
            return back()
                ->withInput()
                ->withErrors([
                    'contact' => 'Already verified. Please proceed to the next step.',
                ]);
        }

        // Generate new verification code
        $verificationCode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Update session with new code and expiration
        $registrationData['verification_code'] = $verificationCode;
        $registrationData['expires_at'] = now()->addMinutes(5);
        Session::put('registration_data', $registrationData);

        // Send new verification code
        $contact = $registrationData['contact'];
        $contactType = $registrationData['contact_type'];

        if ($contactType === 'email') {
            try {
                Mail::to($contact)->send(new \App\Mail\VerificationCodeMail($verificationCode));
                Log::info('New verification code : '.$verificationCode);
            } catch (\Exception $e) {
                Log::error('Failed to send new verification email: '.$e->getMessage());
                return back()
                    ->withInput()
                    ->withErrors([
                        'contact' => 'Failed to send new verification code. Please try again.',
                    ]);
            }
        } else {
            Log::info('New SMS verification code for '.$contact.': '.$verificationCode);
        }

        return back()->with('success', 'New verification code sent to '.$contact);
    }

    /**
     * Step 3: Save company and admin details
     */
    public function saveCompanyDetails(Request $request)
    {
        $validated = $request->validate([
            // Company information
            'company_name' => 'required|string|max:255',
            'company_email' => 'required|email|unique:companies,email|unique:users,email',
            'company_phone' => 'required|string|unique:companies,phone',
            'company_address' => 'required|string',
            'company_city' => 'required|string',
            'company_country' => 'required|string',

            // Admin user information
            'admin_name' => 'required|string|max:255',
            'admin_email' => 'required|email|unique:users,email',
            'admin_password' => 'required|string|min:8|confirmed',

            // Contact information (from previous steps)
            'contact_type' => 'required|in:email,phone',
            'contact' => 'required|string',
            'verification_code' => 'required|string|size:6',
        ]);

        // Verify the verification code
        $storedCode = Session::get('registration_data');
        if (! $storedCode || $validated['verification_code'] !== $storedCode['verification_code']) {
            return back()
                ->withInput()
                ->withErrors([
                    'verification_code' => 'Invalid verification code',
                ]);
        }

        // Create the user
        $user = User::create([
            'name' => $validated['admin_name'],
            'email' => $validated['admin_email'],
            'password' => Hash::make($validated['admin_password']),
            'primary_company_id' => null, // Will be set after company creation
        ]);

        // Create the company
        $company = Company::create([
            'name' => $validated['company_name'],
            'email' => $validated['company_email'],
            'phone' => $validated['company_phone'],
            'address' => $validated['company_address'],
            'city' => $validated['company_city'],
            'country' => $validated['company_country'],
            'owner_id' => $user->id,
        ]);

        // Set company as primary for admin
        $user->primary_company_id = $company->id;
        $user->save();

        // Create the main branch
        Branch::create([
            'name' => 'Main Branch',
            'code' => 'MB-'.strtoupper(substr(str_replace(' ', '', $company->name), 0, 3)).'001',
            'email' => $company->email,
            'phone' => $company->phone,
            'company_id' => $company->id,
            'is_main_branch' => true,
        ]);

        // Create admin role
        $adminRole = Role::firstOrCreate([
            'name' => 'admin',
            'display_name' => 'Administrator',
            'description' => 'System administrator with full access',
            'is_system' => true,
            'slug' => 'admin',
            'company_id' => $company->id
        ]);

        // Create user role relationship
        UserRole::create([
            'user_id' => $user->id,
            'role_id' => $adminRole->id,
            'company_id' => $company->id
        ]);

        // Verify contact
        if ($validated['contact_type'] === 'email') {
            $user->email_verified_at = now();
            $user->save();
        } else {
            $user->phone_verified_at = now();
            $user->save();
        }

        // Log the user in
        Auth::login($user);

        // Clear registration session data
        Session::forget('registration_data');

        return redirect()->route('dashboard')->with('success', 'Company and admin account created successfully!');
    }

    /**
     * Step 3: Complete registration with company and admin details
     */
    public function completeRegistration(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'company_email' => 'required|email|unique:companies',
            'company_phone' => 'required|string',
            'company_address' => 'required|string',
            'company_city' => 'required|string',
            'company_country' => 'required|string',
            'admin_name' => 'required|string|max:255',
            'admin_email' => 'required|email|unique:users',
            'admin_password' => 'required|string|min:8|confirmed',
            'contact' => 'required|string',
            'contact_type' => 'required|in:email,phone',
            'verification_code' => 'required|string|size:6',
        ]);

        try {
            DB::beginTransaction();

            // Create company
            $company = Company::create([
                'name' => $validated['company_name'],
                'email' => $validated['company_email'],
                'phone' => $validated['company_phone'],
                'address' => $validated['company_address'],
                'city' => $validated['company_city'],
                'country' => $validated['company_country'],
            ]);

            // Create admin user
            $admin = User::create([
                'name' => $validated['admin_name'],
                'email' => $validated['admin_email'],
                'password' => Hash::make($validated['admin_password']),
                'company_id' => $company->id,
            ]);

            // Create admin role
            $adminRole = Role::firstOrCreate([
                'name' => 'admin',
                'display_name' => 'Administrator',
                'description' => 'System administrator with full access',
                'is_system' => true,
                'slug' => 'admin',
                'company_id' => $company->id
            ]);

            // Create user role relationship
            UserRole::create([
                'user_id' => $admin->id,
                'role_id' => $adminRole->id,
                'company_id' => $company->id
            ]);

            // Set company as primary for admin
            $admin->primary_company_id = $company->id;
            $admin->save();

            // Verify contact
            if ($validated['contact_type'] === 'email') {
                $admin->email_verified_at = now();
                $admin->save();
            } else {
                // For phone verification, you might want to implement a different verification system
                $admin->phone_verified_at = now();
                $admin->save();
            }

            DB::commit();

            // Log the user in
            Auth::guard('web')->login($admin);

            return redirect()->route('dashboard')->with('success', 'Company and admin account created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Registration failed: ' . $e->getMessage());
            return back()->withInput()->withErrors([
                'company_name' => 'Failed to complete registration',
            ]);
        }
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
        if (! $storedCode || $validated['verification_code'] !== $storedCode) {
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

            // Create system settings
            $defaultSettings = [
                'attendance' => [
                    'late_threshold' => '15',
                    'early_threshold' => '15',
                    'overtime_start' => '18:00:00',
                    'overtime_threshold' => '30',
                    'allow_manual_attendance' => 'true',
                ],
                'leave' => [
                    'maximum_leave_balance' => '30',
                    'minimum_leave_balance' => '0',
                    'leave_approval_required' => 'true',
                    'maximum_leave_request_days' => '30',
                ],
                'payroll' => [
                    'default_pay_period' => 'monthly',
                    'payroll_processing_days' => '7',
                    'tax_deduction' => 'true',
                ],
                'general' => [
                    'company_time_zone' => 'Asia/Jakarta',
                    'date_format' => 'Y-m-d',
                    'time_format' => 'H:i',
                    'language' => 'en',
                ],
            ];

            foreach ($defaultSettings as $category => $settings) {
                foreach ($settings as $key => $value) {
                    $settingKey = $category . '.' . $key;
                    SystemSetting::create([
                        'company_id' => $company->id,
                        'key' => $settingKey,
                        'value' => $value,
                        'type' => gettype($value),
                        'is_active' => true,
                    ]);
                }
            }

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
            Auth::guard('web')->login($admin);
        });

        return redirect()->route('dashboard')->with('success', 'Company and admin account created successfully!');
    }

    /**
     * Save system settings
     */
    public function saveSystemSettings(Request $request)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'attendance' => 'required|array',
            'attendance.late_threshold' => 'required|integer|min:0',
            'attendance.early_threshold' => 'required|integer|min:0',
            'attendance.overtime_start' => 'required|date_format:H:i:s',
            'attendance.overtime_threshold' => 'required|integer|min:0',
            'attendance.allow_manual_attendance' => 'required|boolean',
            'leave' => 'required|array',
            'leave.maximum_leave_balance' => 'required|integer|min:0',
            'leave.minimum_leave_balance' => 'required|integer|min:0',
            'leave.leave_approval_required' => 'required|boolean',
            'leave.maximum_leave_request_days' => 'required|integer|min:0',
            'payroll' => 'required|array',
            'payroll.default_pay_period' => 'required|in:monthly,biweekly,weekly',
            'payroll.payroll_processing_days' => 'required|integer|min:0',
            'payroll.tax_deduction' => 'required|boolean',
            'general' => 'required|array',
            'general.company_time_zone' => 'required|timezone',
            'general.date_format' => 'required|in:Y-m-d,d-m-Y,m/d/Y',
            'general.time_format' => 'required|in:H:i,h:i A',
            'general.language' => 'required|in:en,id',
        ]);

        try {
            DB::beginTransaction();

            // Delete existing settings for this company
            SystemSetting::where('company_id', $validated['company_id'])->delete();

            // Save new settings
            foreach ($validated as $category => $settings) {
                if ($category === 'company_id') continue;

                foreach ($settings as $key => $value) {
                    $settingKey = $category . '.' . $key;
                    SystemSetting::create([
                        'company_id' => $validated['company_id'],
                        'key' => $settingKey,
                        'value' => $value,
                        'type' => gettype($value),
                        'is_active' => true,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('landing-page.installation-wizard.save-admin-details');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to save system settings: ' . $e->getMessage());

            return back()
                ->withInput()
                ->withErrors([
                    'system_settings' => 'Failed to save system settings. Please try again.',
                ]);
        }
    }

    /**
     * Save admin details
     */
    public function saveAdminDetails(Request $request)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'admin_name' => 'required|string|max:255',
            'admin_email' => 'required|email|unique:users,email',
            'admin_password' => 'required|string|min:8|confirmed',
        ]);

        try {
            DB::beginTransaction();

            // Create admin user
            $admin = User::create([
                'name' => $validated['admin_name'],
                'email' => $validated['admin_email'],
                'password' => Hash::make($validated['admin_password']),
                'primary_company_id' => $validated['company_id'],
            ]);

            // Create admin role
            $adminRole = Role::firstOrCreate([
                'name' => 'admin',
                'display_name' => 'Administrator',
                'description' => 'System administrator with full access',
                'is_system' => true,
                'slug' => 'admin',
                'company_id' => $validated['company_id']
            ]);

            // Create user role relationship
            UserRole::create([
                'user_id' => $admin->id,
                'role_id' => $adminRole->id,
                'company_id' => $validated['company_id']
            ]);

            DB::commit();

            return redirect()->route('landing-page.installation-wizard.complete');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to save admin details: ' . $e->getMessage());

            return back()
                ->withInput()
                ->withErrors([
                    'admin_details' => 'Failed to save admin details. Please try again.',
                ]);
        }
    }
}
