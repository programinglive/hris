<?php

namespace App\Livewire;

use App\Models\Company;
use DB;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CompanyForm extends Component
{
    #[Url]
    #[Validate('required|unique:companies|min:3')]
    public $code;

    #[Validate('required|min:3')]
    public $name;

    public $npwp;

    public $address;

    #[Validate('required|email:unique:companies') ]
    public $email;

    #[Validate('required|unique:companies') ]
    public $phone;

    public $company;

    public $actionForm = 'save';

    /**
     * Updates the specified property with the given value and performs validation if the property is 'code',
     * 'email', or 'phone'.
     *
     * @param  string  $key  The name of the property to be updated.
     * @param  mixed  $value  The new value for the property.
     *
     * @throws ValidationException
     */
    public function updated(string $key, mixed $value): void
    {
        if ($key == 'code' || $key == 'email' || $key = 'phone') {
            $this->validateOnly($key);
        }
    }

    /**
     * The default data for the form.
     */
    public function companyData(): array
    {
        return [
            'code' => $this->code,
            'name' => $this->name,
            'npwp' => $this->npwp,
            'address' => $this->address,
            'email' => $this->email,
            'phone' => $this->phone,
        ];
    }

    /**
     * Saves the company details to the database and dispatches a 'company-created' event.
     */
    public function save(): void
    {
        $this->validate();

        DB::transaction(function () {
            $this->company = Company::create($this->companyData());
        }, 5);

        $this->dispatch('company-created', companyId: $this->company->id);

        $this->dispatch('refreshAnnouncement');

        $this->reset();
    }

    /**
     * Edit the company details.
     */
    #[On('edit')]
    public function edit($code): void
    {
        $this->code = $code;
        $this->company = Company::where('code', $code)->first();
        $this->name = $this->company->name;
        $this->npwp = $this->company->npwp;
        $this->address = $this->company->address;
        $this->email = $this->company->email;
        $this->phone = $this->company->phone;

        $this->actionForm = 'update';

        $this->dispatch('show-form');
    }

    /**
     * Updates the company details in the database.
     */
    public function update(): void
    {
        DB::transaction(function () {
            $this->company->update($this->companyData());
        }, 5);

        $this->dispatch('company-updated', companyId: $this->company->id);

        $this->reset();
    }

    /**
     * Deletes the company from the database.
     */
    #[On('delete')]
    public function destroy($code): void
    {
        $this->company = Company::where('code', $code)->first();
        $this->company->code = $this->company->code.'-deleted';
        $this->company->save();

        $this->company->delete();

        $this->dispatch('refreshAnnouncement');

        $this->dispatch('company-deleted', refreshCompanies: true);
    }

    /**
     * Resets the form by clearing all properties and error bag.
     *
     * This function is triggered when the 'refresh-form' event is dispatched.
     */
    #[On('refresh-form')]
    public function refreshCompanyForm(): void
    {
        $this->reset();
        $this->resetErrorBag();
    }

    /**
     * Render the livewire component.
     */
    public function render(): View
    {
        return view('livewire.company-form');
    }
}
