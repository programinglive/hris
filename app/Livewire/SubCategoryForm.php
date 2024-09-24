<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\SubCategory;
use DB;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SubCategoryForm extends Component
{
    #[Url(keep: true)]
    public $companyCode = 'all';
    public $companyName;

    #[Url(keep: true)]
    public $branchCode = 'all';
    public $branchName;

    #[Url(keep: true)]

    public $categories = [];

    public $categoryId;
    public $categoryCode;

    #[Validate('required|unique:categories|min:3')]
    public $code;

    #[Validate('required|unique:categories|min:3')]
    public $name;

    public $subCategory;

    public $actionForm = 'save';

    /**
     * Mounts the component.
     */
    public function mount(): void
    {
        $this->categories = Category::where(
            'company_code', $this->companyCode
        )
            ->get()->toArray();
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
    public function subCategoryData(): array
    {
        return [
            'company_id' => 1,
            'branch_id' => 1,
            'category_id' => $this->categoryId,
            'code' => $this->code,
            'name' => $this->name,
            'company_code' => $this->companyCode,
            'company_name' => $this->companyName,
            'branch_code' => $this->branchCode,
            'branch_name' => $this->branchName,
            'category_code' => $this->categoryCode,
            'category_name' => $this->categoryName,
        ];
    }

    /**
     * Saves the subCategory details to the database and dispatches a 'subCategory-created' event.
     */
    public function save(): void
    {
        $this->validate();

        DB::transaction(function () {
            $this->subCategory = SubCategory::create(
                $this->subCategoryData()
            );
        }, 5);

        $this->dispatch('sub-category-created', subCategoryId: $this->subCategory->id);

        $this->reset();
    }

    /**
     * Edit the subCategory details.
     */
    #[On('edit')]
    public function edit($code): void
    {
        $this->subCategory = SubCategory::where('code', $code)->first();
        $this->code = $this->subCategory->code;
        $this->name = $this->subCategory->name;

        $this->actionForm = 'update';

        $this->dispatch('show-form');
    }

    /**
     * Updates the subCategory details in the database.
     */
    public function update(): void
    {
        DB::transaction(function () {
            $this->subCategory->update($this->subCategoryData());
        }, 5);

        $this->dispatch(
            'sub-category-updated',
            subCategoryId: $this->subCategory->id
        );

        $this->reset();
    }

    /**
     * Deletes the subCategory from the database.
     */
    #[On('delete')]
    public function destroy($code): void
    {
        $this->subCategory = SubCategory::where('code', $code)->first();
        $this->subCategory->code = $this->subCategory->code.'-deleted';
        $this->subCategory->save();

        $this->subCategory->delete();

        $this->reset();

        $this->dispatch('sub-category-deleted', refreshCompanies: true);
    }

    /**
     * Render the livewire component.
     */
    public function render(): View
    {
        return view('livewire.sub-category-form');
    }
}