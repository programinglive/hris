<?php

namespace App\Livewire;

use App\Models\SubCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class SubCategoryTable extends Component
{
    use WithFileUploads, withPagination;

    public $showForm = false;

    #[Url]
    public $search;

    #[Url(keep: true)]
    public $companyCode;

    /**
     * Shows the form subCategory.
     */
    #[On('show-form')]
    public function showForm(): void
    {
        $this->showForm = true;
    }

    #[On('hide-form')]
    public function hideForm(): void
    {
        $this->dispatch('clear-form');
        $this->showForm = false;
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

        return $subCategories->orderBy('id')
            ->paginate(10);
    }

    #[On('refresh')]
    public function refresh(): void
    {
        $this->resetPage();
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
