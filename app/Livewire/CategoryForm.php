<?php

namespace App\Livewire;

use App\Models\Category;
use DB;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CategoryForm extends Component
{
    public $company;

    public $companyId;

    #[Url(keep: true)]
    public $companyCode = 'all';

    public $companyName;

    public $branch;

    public $branchId;

    #[Url(keep: true)]
    public $branchCode = 'all';

    public $branchName;

    #[Validate('required|unique:categories|min:3')]
    public $code;

    #[Validate('required|unique:categories|min:3')]
    public $name;

    public $category;

    public $createdBy;
    public $updatedBy;

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
    public function categoryData(): array
    {
        return [
            'company_id' => 1,
            'branch_id' => 1,
            'code' => $this->code,
            'name' => $this->name,
            'company_code' => $this->companyCode,
            'company_name' => $this->companyName,
            'branch_code' => $this->branchCode,
            'branch_name' => $this->branchName,
            'created_bt' => $this->createdBy,
            'updated_by' => $this->updatedBy,
        ];
    }

    /**
     * Saves the category details to the database and dispatches a 'category-created' event.
     */
    public function save(): void
    {
        $this->validate();

        DB::transaction(function () {
            $this->category = Category::create($this->categoryData());
        }, 5);

        $this->dispatch('category-created', categoryId: $this->category->id);

        $this->reset();
    }

    /**
     * Edit the category details.
     */
    #[On('edit')]
    public function edit($code): void
    {
        $this->category = Category::where('code', $code)->first();
        $this->code = $this->category->code;
        $this->name = $this->category->name;

        $this->actionForm = 'update';

        $this->dispatch('show-form');
    }

    /**
     * Updates the category details in the database.
     */
    public function update(): void
    {
        DB::transaction(function () {
            $this->category->update($this->categoryData());
        }, 5);

        $this->dispatch('category-updated', categoryId: $this->category->id);

        $this->reset();
    }

    /**
     * Deletes the category from the database.
     */
    #[On('delete')]
    public function destroy($code): void
    {
        $this->category = Category::where('code', $code)->first();
        $this->category->code = $this->category->code.'-deleted';
        $this->category->save();

        $this->category->delete();

        $this->reset();

        $this->dispatch('category-deleted', refreshCompanies: true);
    }

    /**
     * Render the livewire component.
     */
    public function render(): View
    {
        return view('livewire.category-form');
    }
}