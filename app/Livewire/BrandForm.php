<?php

namespace App\Livewire;

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

    public $companyName;

    public $branch;

    #[Url(keep: true)]
    public $branchCode;

    public $branchName;

    #[Validate('required|unique:brands|min:3')]
    public $code;

    #[Validate('required|unique:brands|min:3')]
    public $name;

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
        $this->companyName = $this->company->name;

        $this->branch = $this->company->branches()->first();

        $this->branchCode = $this->branch->code;
        $this->branchName = $this->branch->name;

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
        if (is_null($this->companyCode) || $this->companyCode == 'all') {
            $this->dispatch('companyRequired');

            return;
        }

        return [
            'company_id' => 1,
            'branch_id' => 1,
            'code' => $this->code,
            'name' => $this->name,
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

        $this->dispatch('brand-created', brandId: $this->brand->id);

        $this->reset();
    }

    /**
     * Edit the brand details.
     */
    #[On('edit')]
    public function edit($code): void
    {
        $this->brand = Brand::where('code', $code)->first();
        $this->code = $this->brand->code;
        $this->name = $this->brand->name;
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

        $this->dispatch('brand-updated', brandId: $this->brand->id);

        $this->reset();
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

        $this->reset();

        $this->dispatch('brand-deleted', refreshCompanies: true);
    }

    /**
     * Render the livewire component.
     */
    public function render(): View
    {
        return view('livewire.brand-form');
    }
}
