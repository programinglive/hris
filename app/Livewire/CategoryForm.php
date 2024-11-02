<?php

namespace App\Livewire;

use App\Models\Branch;
use App\Models\Category;
use App\Models\Company;
use DB;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CategoryForm extends Component
{
    public $company;

    #[Url(keep: true)]
    public $companyCode;

    public $branch;

    #[Url(keep: true)]
    public $branchCode;

    #[Validate('required|unique:categories|min:3')]
    public $code;

    #[Validate('required|unique:categories|min:3')]
    public $name;

    public $description;

    public $category;

    public $actionForm = 'save';

    public function mount(): void
    {
        $this->ifCompanyCodeNotEmpty();
        $this->ifBranchCodeNotEmpty();
    }

    public function ifCompanyCodeNotEmpty(): void
    {
        if ($this->companyCode != '') {
            $this->company = Company::where('code', $this->companyCode)->first();
        }
    }

    public function ifBranchCodeNotEmpty(): void
    {
        if ($this->branchCode != '') {
            $this->branch = Branch::where('code', $this->branchCode)->first();
        }
    }

    #[On('set-company')]
    public function setCompany(string $companyCode): void
    {
        if ($companyCode === '') {
            return;
        }

        $this->companyCode = $companyCode;
        $this->company = Company::where('code', $companyCode)->first();
    }

    #[On('set-branch')]
    public function setBranch(string $branchCode): void
    {
        if ($branchCode === '') {
            return;
        }

        $this->branchCode = $branchCode;
        $this->branch = $this->company->branches()->where('code', $branchCode)->first();
    }

    /**
     * The default data for the form.
     */
    public function categoryData(): array
    {
        return [
            'company_id' => $this->company?->id,
            'branch_id' => $this->branch?->id,
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
            'company_code' => $this->companyCode,
            'company_name' => $this->company?->name,
            'branch_code' => $this->branchCode,
            'branch_name' => $this->branch?->name,
            'created_bt' => auth()->user()->id,
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

        $this->dispatch('refresh');
        $this->dispatch('hide-form');
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
        $this->description = $this->category->description;

        $this->company = Company::where('code', $this->category->company_code)->first();
        $this->dispatch('set-company', $this->company->code);

        $this->branch = Branch::where('code', $this->category->branch_code)->first();
        $this->dispatch('set-branch', $this->branch->code);

        $this->actionForm = 'update';

        $this->dispatch('show-form');
    }

    /**
     * Updates the category details in the database.
     */
    public function update(): void
    {
        DB::transaction(function () {
            $data = $this->categoryData();
            $data['updated_by'] = auth()->user()->id;

            $this->category->update($data);
        }, 5);

        $this->dispatch('refresh');
        $this->dispatch('hide-form');
    }

    /**
     * Deletes the category from the database.
     */
    #[On('delete')]
    public function destroy($code): void
    {
        $this->category = Category::where('code', $code)->first();
        $this->category->code = $this->category->code.time().'-deleted';
        $this->category->save();

        $this->category->delete();

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
        return view('livewire.category-form');
    }
}
