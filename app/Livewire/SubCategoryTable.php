<?php

namespace App\Livewire;

use App\Models\Company;
use App\Models\SubCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class SubCategoryTable extends Component
{
    use withPagination;

    public $showForm = false;

    #[Url]
    public $search;

    #[Url(keep: true)]
    public $companyCode = 'all';

    /**
     * Sets the company code.
     *
     * @param  string  $code  The code to set as the company code.
     */
    #[On('setCompany')]
    public function setCompany(string $code): void
    {
        $this->companyCode = $code;
    }

    /**
     * Handles the event when a subCategory is created.
     *
     * @param  int  $subCategoryId  The ID of the created subCategory.
     */
    #[On('sub-category-created')]
    public function subCategoryAdded(int $subCategoryId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a subCategory is updated.
     *
     * @param  int  $subCategoryId  The ID of the updated subCategory.
     */
    #[On('sub-category-updated')]
    public function subCategoryUpdated(int $subCategoryId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a subCategory is deleted.
     */
    #[On('sub-category-deleted')]
    public function subCategoryDeleted(): void
    {
        $this->showForm = false;
        $this->resetPage();
        $this->getCategories();
    }

    /**
     * Shows the form subCategory.
     */
    #[On('show-form')]
    public function showForm(): void
    {
        $this->showForm = true;
    }

    /**
     * Retrieves a paginated list of subCategories based on a search query.
     *
     * @return LengthAwarePaginator The paginated list of subCategories.
     */
    public function getSubCategories(): LengthAwarePaginator
    {
        $subCategories = SubCategory::where(function ($query) {
            $query->where('code', 'like', '%'.$this->search.'%')
                ->orWhere('name', 'like', '%'.$this->search.'%');
        });

        if ($this->companyCode !== 'all') {
            $subCategories = $subCategories->where(
                'company_id', Company::where('code', $this->companyCode
                )->first()?->id
            );
        }

        return $subCategories->orderBy('id')
            ->paginate(5);
    }

    /**
     * Render the livewire component.
     */
    public function render(): View
    {
        return view('livewire.sub-category-table', [
            'subCategories' => self::getSubCategories(),
        ]);
    }
}
