<?php

namespace App\Livewire;

use App\Models\Brand;
use DB;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;

class BrandForm extends Component
{
    #[Url(keep: true)]
    public $companyCode = 'all';

    #[Url(keep: true)]
    public $branchCode = 'all';

    #[Validate('required|unique:brands|min:3')]
    public $code;

    #[Validate('required|unique:brands|min:3')]
    public $name;

    public $brand;

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
        if ($key == 'name') {
            $this->validateOnly($key);
        }
    }

    /**
     * The default data for the form.
     */
    public function brandData(): array
    {
        return [
            'company_id' => 1,
            'branch_id' => auth()->user()->details->branch_id,
            'code' => $this->code,
            'name' => $this->name,
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
        $this->brand->code = $this->brand->code.'-deleted';
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