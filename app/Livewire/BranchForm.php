<?php

namespace App\Livewire;

use App\Http\Controllers\ToolController;
use App\Models\Branch;
use App\Models\Company;
use DB;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;

class BranchForm extends Component
{
    public $company;

    #[Url(keep: true)]
    public $companyCode;

    #[Validate('required|unique:branches|min:3')]
    public $code;

    #[Validate('required|min:3')]
    public $name;

    public $type = 'branch';

    public $phone;

    public $address;

    public $branch;

    public $actionForm = 'save';

    /**
     * Mount the component
     */
    public function mount(): void
    {
        $this->company = Company::where('code', $this->companyCode)->first();
    }

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
        if ($key == 'code') {
            $this->validateOnly($key);
        }
    }

    /**
     * Sets the company code to the given value and dispatches a 'get-branch' event.
     *
     * @param string $companyCode  The company code to set.
     */
    #[On('set-company')]
    public function setCompany(string $companyCode): void
    {
        $this->companyCode = $companyCode;
    }

    /**
     * The default data for the form.
     */
    public function branchData(): array
    {
        return [
            'company_id' => $this->company->id,
            'code' => ToolController::sanitizeString($this->code),
            'name' => $this->name,
            'phone' => $this->phone,
            'address' => $this->address,
            'type' => $this->type,
            'company_code' => $this->company->code,
            'company_name' => $this->company->name,
            'created_by' => auth()->user()->id,
        ];
    }

    /**
     * Saves the branch details to the database and dispatches a 'branch-created' event.
     */
    public function save(): void
    {
        if (! $this->company) {
            $this->dispatch('companyRequired');

            return;
        }

        $this->validate();

        DB::transaction(function () {
            $this->branch = Branch::create($this->branchData());
        }, 5);

        $this->dispatch('hide-form');
        $this->dispatch('refresh');

        $this->dispatch('refresh-announcement');

        $this->getResetExcept();
    }

    /**
     * Edit the branch details.
     */
    #[On('edit')]
    public function edit($code): void
    {
        $this->code = $code;
        $this->branch = Branch::where('code', $code)->first();

        $this->dispatch('set-company', $this->branch->company_code);

        $this->name = $this->branch->name;
        $this->type = $this->branch->type;
        $this->phone = $this->branch->phone;
        $this->address = $this->branch->address;
        $this->companyCode = $this->branch->company_code;

        $this->actionForm = 'update';

        $this->dispatch('show-form');
    }

    /**
     * Updates the branch details in the database.
     */
    public function update(): void
    {
        if (! $this->company) {
            $this->dispatch('companyRequired');

            return;
        }

        DB::transaction(function () {
            $data = $this->branchData();
            $data['updated_by'] = auth()->user()->id;

            $this->branch->update($data);
        }, 5);

        $this->dispatch('hide-form');

        $this->dispatch('refresh');

        $this->getResetExcept();
    }

    /**
     * Deletes the branch from the database.
     */
    #[On('delete')]
    public function destroy($code): void
    {
        $this->branch = Branch::where('code', $code)->first();
        $this->branch->code = $this->branch->code.time().'-deleted';
        $this->branch->save();

        $this->branch->delete();

        $this->dispatch('refresh-announcement');

        $this->dispatch('refresh');
    }

    /**
     * Resets the form values except for the given properties.
     */
    public function getResetExcept(): void
    {
        $this->resetExcept([
            'companyCode',
            'company',
            'branch',
        ]);
    }

    /**
     * Render the livewire component.
     */
    public function render(): View
    {
        return view('livewire.branch-form');
    }
}