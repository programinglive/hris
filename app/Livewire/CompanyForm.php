<?php

namespace App\Livewire;

use App\Models\Company;
use DB;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CompanyForm extends Component
{

    #[Validate('required|unique:companies,code,deleted_at|min:3')]
    public $code;

    #[Validate('required|min:3')]
    public $name;
    
    public $address;

    #[Validate('required|email:unique:companies') ]
    public $email;
    public $phone;

    public $company;

    public function save(): void
    {
        $this->validate();

        DB::transaction(function () {
            $this->company = Company::create([
                'code' => $this->code,
                'name' => $this->name,
                'address' => $this->address,
                'email' => $this->email,
                'phone' => $this->phone
            ]);
        }, 5);

        $this->dispatch('company-created', companyId: $this->company->id);

        $this->reset();
    }


    /**
     * Render the livewire component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.company-form');
    }
}