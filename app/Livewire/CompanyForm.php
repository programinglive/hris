<?php

namespace App\Livewire;

use App\Http\Controllers\ToolController;
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
            'code' => ToolController::sanitizeString($this->code),
            'name' => $this->name,
            'npwp' => $this->npwp,
            'address' => $this->address,
            'email' => $this->email,
            'phone' => $this->phone,
            'created_by' => auth()->user()->id,
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

        $this->dispatch('refresh');
        $this->dispatch('hide-form');

        $this->getResetExcept();
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
            $data = $this->companyData();
            $data['updated_by'] = $this->updatedBy;

            $this->company->update($data);
        }, 5);

        $this->dispatch('refresh');
        $this->dispatch('hide-form');

        $this->getResetExcept();
    }

    /**
     * Deletes the company from the database.
     */
    #[On('delete')]
    public function destroy($code): void
    {
        $this->company = Company::where('code', $code)->first();
        $this->company->code = $this->company->code.time().'-deleted';
        $this->company->phone = $this->company->phone.time().'-deleted';
        $this->company->save();

        $this->company->delete();

        $this->dispatch('refresh');
        $this->getResetExcept();
    }

    /**
     * Resets the form values except for the given properties.
     */
    public function getResetExcept(): void
    {
        $this->resetExcept([
            'createdBy',
            'updatedBy',
            'company',
            'companyId',
            'companyCode',
            'companyName',
            'branch',
            'branchId',
            'branchCode',
            'branchName',
        ]);
    }

    #[On('refresh')]

    /**
     * Render the livewire component.
     */
    public function render(): View
    {
        return view('livewire.company-form');
    }
}
