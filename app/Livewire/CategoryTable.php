<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Company;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryTable extends Component
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
     * Handles the event when a category is created.
     *
     * @param  int  $categoryId  The ID of the created category.
     */
    #[On('category-created')]
    public function categoryAdded(int $categoryId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a category is updated.
     *
     * @param  int  $categoryId  The ID of the updated category.
     */
    #[On('category-updated')]
    public function categoryUpdated(int $categoryId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a category is deleted.
     */
    #[On('category-deleted')]
    public function categoryDeleted(): void
    {
        $this->showForm = false;
        $this->resetPage();
        $this->getCategories();
    }

    /**
     * Shows the form category.
     */
    #[On('show-form')]
    public function showForm(): void
    {
        $this->showForm = true;
    }

    /**
     * Retrieves a paginated list of categories based on a search query.
     *
     * @return LengthAwarePaginator The paginated list of categories.
     */
    public function getCategories(): LengthAwarePaginator
    {
        $categories = Category::where(function ($query) {
            $query->where('code', 'like', '%'.$this->search.'%')
                ->orWhere('name', 'like', '%'.$this->search.'%');
        });

        if ($this->companyCode !== 'all') {
            $categories = $categories->where('company_id', Company::where('code', $this->companyCode)->first()?->id);
        }

        return $categories->orderBy('id')
            ->paginate(5);
    }

    /**
     * Render the livewire component.
     */
    public function render(): View
    {
        return view('livewire.category-table', [
            'categories' => self::getCategories(),
        ]);
    }
}
