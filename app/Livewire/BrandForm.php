<?php

namespace App\Livewire;

use App\Models\Branch;
use App\Models\Brand;
use App\Models\Company;
use DB;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;

class BrandForm extends Component
{
    public $company;

    #[Url(keep: true)]
    public $companyCode;

    public $branch;

    #[Url(keep: true)]
    public $branchCode;

    #[Validate('required|unique:brands|min:3')]
    public $code;

    #[Validate('required|unique:brands|min:3')]
    public $name;

    public $description;

    public $brand;

    public $createdBy;

    public $updatedBy;

    public $actionForm = 'save';

    /**
     * Mount the component
     */
    public function mount(): void
    {
        $this->company = Company::first();

        $this->branch = $this->company->branches()->first();
        $this->branchCode = $this->branch->code;

        $this->createdBy = auth()->user()->id;
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
        if ($key == 'name') {
            $this->validateOnly($key);
        }
    }

    /**
     * The default data for the form.
     */
    public function brandData()
    {
        if ($this->companyCode == '') {
            $this->dispatch('companyRequired');

            return;
        }

        return [
            'company_id' => 1,
            'branch_id' => 1,
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
            'company_code' => $this->companyCode,
            'company_name' => $this->companyName,
            'branch_code' => $this->branchCode,
            'branch_name' => $this->branchName,
            'created_by' => $this->createdBy,
            'updated_by' => $this->updatedBy,
        ];
    }

    /**
     * Saves the brand details to the database and dispatches a 'brand-created' event.
     */
    public function save(): void
    {
        $this->validate();

        DB::transaction(function () {
            $this->brand = Brand::create($this->brandData());
        }, 5);

        $this->dispatch('refresh');
        $this->dispatch('hide-form');
        $this->reset();
    }

    /**
     * Edit the brand details.
     */
    #[On('edit')]
    public function edit($code): void
    {
        $this->brand = Brand::where('code', $code)->first();
        $company = Company::where('code', $this->brand->company_code)->first();
        $this->dispatch('set-company', $company->code);
        $branch = Branch::where('code', $this->brand->branch_code)->first();
        $this->dispatch('set-branch', $branch->code);
        $this->code = $this->brand->code;
        $this->name = $this->brand->name;
        $this->description = $this->brand->description;
        $this->updatedBy = auth()->user()->id;

        $this->actionForm = 'update';

        $this->dispatch('show-form');
    }

    /**
     * Updates the brand details in the database.
     */
    public function update(): void
    {
        DB::transaction(function () {
            $this->brand->update($this->brandData());
        }, 5);

        $this->dispatch('refresh');
        $this->dispatch('hide-form');

        $this->getResetExcept();
    }

    /**
     * Deletes the brand from the database.
     */
    #[On('delete')]
    public function destroy($code): void
    {
        $this->brand = Brand::where('code', $code)->first();
        $this->brand->code = $this->brand->code.time().'-deleted';
        $this->brand->save();

        $this->brand->delete();

        $this->dispatch('refresh');
        $this->dispatch('hide-form');

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
            'companyCode',
            'branch',
            'branchCode',
        ]);
    }

    /**
     * Render the livewire component.
     */
    public function render(): View
    {
        return view('livewire.brand-form');
    }
}
