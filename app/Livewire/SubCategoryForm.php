<?php

namespace App\Livewire;

use App\Models\Branch;
use App\Models\Category;
use App\Models\Company;
use App\Models\SubCategory;
use DB;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SubCategoryForm extends Component
{
    public $company;

    #[Url(keep: true)]
    public $companyCode;

    public $branch;

    #[Url(keep: true)]
    public $branchCode;

    #[Url(keep: true)]
    public $categories = [];

    public $category;

    #[Url(keep: true)]
    public $categoryCode;

    #[Validate('required|unique:sub_categories,code|min:3')]
    public $code;

    #[Validate('required|min:3')]
    public $name;

    public $description;

    public $subCategory;

    public $actionForm = 'save';

    public function mount(): void
    {
        $this->categoryCode == '' ?
            $this->category = null :
            $this->category = Category::where('code', $this->categoryCode)->first();
        $this->companyCode == '' ?
            $this->company = null :
            $this->company = Company::where('code', $this->companyCode)->first();
        $this->branchCode == '' ?
            $this->branch = null :
            $this->branch = Branch::where('code', $this->branchCode)->first();
    }

    /**
     * Sets the company code.
     *
     * @param  string  $companyCode
     * @return void
     */
    #[On('set-company')]
    public function setCompany(string $companyCode): void
    {
        $this->companyCode = $companyCode;
        $this->company = $this->companyCode != '' ?
                            Company::where('code', $companyCode)->first() :
                            null;
    }

    /**
     * Sets the branch code.
     *
     * @param  string  $branchCode
     * @return void
     */
    #[On('set-branch')]
    public function setBranch(string $branchCode): void
    {
        $this->branchCode = $branchCode;
        $this->branch = $this->branchCode != '' ?
                            Branch::where('code', $branchCode)->first() :
                            null;
    }

    /**
     * Sets the category code.
     *
     * @param string $categoryCode
     * @return void
     */
    #[On('set-category')]
    public function setCategory(string $categoryCode): void
    {
        $this->categoryCode = $categoryCode;

        if ($this->categoryCode != '') {
            $this->category = Category::where('code', $this->categoryCode)->first();
        }
    }
    /**
     * The default data for the form.
     */
    public function subCategoryData(): array
    {
        return [
            'company_id' => $this->company->id,
            'branch_id' => $this->branch->id,
            'category_id' => $this->category?->id,
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
            'company_code' => $this->companyCode,
            'company_name' => $this->company->name,
            'branch_code' => $this->branchCode,
            'branch_name' => $this->branch->name,
            'category_code' => $this->categoryCode,
            'category_name' => $this->category?->name,
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

        $this->dispatch('refresh');
        $this->dispatch('hide-form');
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
        $this->description = $this->subCategory->description;

        $this->actionForm = 'update';

        $this->dispatch('show-form');
    }

    /**
     * Updates the subCategory details in the database.
     */
    public function update(): void
    {
        DB::transaction(function () {
            $data = $this->subCategoryData();
            $data['updated_by'] = auth()->user()->id;

            $this->subCategory->update($data);
        }, 5);

        $this->dispatch('refresh');
        $this->dispatch('hide-form');
    }

    /**
     * Deletes the subCategory from the database.
     */
    #[On('delete')]
    public function destroy($code): void
    {
        $this->subCategory = SubCategory::where('code', $code)->first();
        $this->subCategory->code = $this->subCategory->code.time().'-deleted';
        $this->subCategory->save();

        $this->subCategory->delete();

        $this->dispatch('refresh');
    }

    #[On('clear-form')]
    public function clearForm(): void
    {
        $this->reset();
        $this->resetErrorBag();
    }

    /**
     * Render the livewire component.
     */
    public function render(): View
    {
        return view('livewire.sub-category-form');
    }
}