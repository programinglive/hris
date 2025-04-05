<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Http\Requests\CompanyRegistrationRequest;
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
        return Inertia::render('RegisterCompany', [
            'title' => 'Installation'
        ]);
    }

    /**
     * Store company registration
     */
    public function store(CompanyRegistrationRequest $request)
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try {
            // Create company
            $company = Company::create([
                'name' => $validated['name'],
                'code' => $validated['code'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'city' => $validated['city'],
                'state' => $validated['state'],
                'postal_code' => $validated['postal_code'],
                'country' => $validated['country'],
                'is_active' => true,
                'is_primary' => true,
            ]);

            // Create admin user
            $admin = User::create([
                'name' => $validated['administrator']['name'],
                'email' => $validated['administrator']['email'],
                'password' => Hash::make($validated['administrator']['password']),
                'company_id' => $company->id,
            ]);

            // Create user details
            $admin->userDetails()->create([
                'user_id' => $admin->id,
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'city' => $validated['city'],
                'state' => $validated['state'],
                'postal_code' => $validated['postal_code'],
                'country' => $validated['country'],
            ]);

            // Create default roles
            $slug = 'super-admin-' . $company->id;
            $adminRole = Role::firstOrCreate([
                'name' => 'Super Admin',
                'company_id' => $company->id,
            ], [
                'slug' => $slug,
                'description' => 'Super Administrator',
            ]);

            // Assign role to admin
            UserRole::create([
                'user_id' => $admin->id,
                'role_id' => $adminRole->id,
                'company_id' => $company->id,
            ]);

            // Set primary company for the user
            $admin->update([
                'primary_company_id' => $company->id,
            ]);

            // Login the user
            Auth::login($admin, true); // true for remember token

            DB::commit();

            return Inertia::location(route('dashboard'));

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to complete registration: ' . $e->getMessage());

            return back()
                ->withInput()
                ->withErrors([
                    'registration' => 'Registration failed. Please try again.',
                ]);
        }
    }
}
