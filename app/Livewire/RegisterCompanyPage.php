<?php

namespace App\Livewire;

use App\Http\Controllers\ToolController;
use App\Models\Company;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Rule;
use Livewire\Component;

class RegisterCompanyPage extends Component
{
    public $companyName;

    #[Rule('required|unique:companies,code')]
    public $companyEmail;

    public $companyAddress;

    public $companyPhone;

    /**
     * Validate and store company data to database
     */
    public function companyData(): array
    {
        $code = ToolController::generateCode('C', 'company');

        return [
            'code' => ToolController::sanitizeString($code),
            'name' => $this->companyName,
            'email' => $this->companyEmail,
            'address' => $this->companyAddress,
            'phone' => $this->companyPhone,
        ];
    }

    /**
     * Handle company registration form
     */
    public function registerCompany(): RedirectResponse
    {
        $this->validate();

        DB::transaction(function () {
            $company = Company::create($this->companyData());

            $user = User::create([
                'name' => $this->companyEmail,
                'email' => $this->companyEmail,
                'password' => bcrypt('password'),
            ]);

            UserDetail::create([
                'company_id' => $company->id,
                'company_code' => $company->code,
                'company_name' => $company->name,
                'user_id' => $user->id,
                'code' => ToolController::sanitizeString(ToolController::generateCode('U', 'user_detail')),
            ]);

            auth()->login($user);
        }, 5);

        return redirect()->route('dashboard');
    }

    public function render(): View
    {
        return view('livewire.register-company-page');
    }
}
