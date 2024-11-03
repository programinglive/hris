<?php

namespace App\Livewire;

use App\Models\Category;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class FormCategoryOption extends Component
{
    #[Url(keep: true)]
    public $categoryCode;

    /**
     * Filter by company code.
     */
    public function updatedCategoryCode($categoryCode): void
    {
        $this->dispatch('set-category', $categoryCode);
    }

    #[On('set-category')]
    public function setCategory($categoryCode): void
    {
        $this->categoryCode = $categoryCode;
    }

    /**
     * Handle updated branch code.
     */
    public function getCategoryData()
    {
        $categories = Category::orderBy('id', 'desc');

        return $categories->paginate(10);

    }

    #[On('clear-form')]
    public function clearForm(): void
    {
        $this->reset();
        $this->resetErrorBag();
    }

    /**
     * Render the livewire component.
     *
     * @return View The blade view.
     */
    public function render(): View
    {
        return view('livewire.form-category-option', [
            'categories' => self::getCategoryData(),
        ]);
    }
}
