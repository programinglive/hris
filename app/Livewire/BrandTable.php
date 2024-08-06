<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Company;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class BrandTable extends Component
{
    use withPagination;
    public $showForm = false;

    #[Url]
    public $search;

    #[Url(keep: true)]
    public ?String $companyCode = "";

    /**
     * Sets the company code.
     *
     * @param string $code The code to set as the company code.
     * @return void
     */
    #[On('setCompany')]
    public function setCompany(String $code): void
    {
        $this->companyCode = $code;
    }

    /**
     * Handles the event when a brand is created.
     *
     * @param int $brandId The ID of the created brand.
     * @return void
     */
    #[On('brand-created')]
    public function brandAdded(int $brandId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a brand is updated.
     *
     * @param int $brandId The ID of the updated brand.
     * @return void
     */
    #[On('brand-updated')]
    public function brandUpdated(int $brandId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a brand is deleted.
     * @return void
     */
    #[On('brand-deleted')]
    public function brandDeleted(): void
    {
        $this->showForm = false;
        $this->resetPage();
        $this->getBrands();
    }

    /**
     * Shows the form brand.
     *
     * @return void
     */
    #[On('show-form')]
    public function showForm(): void
    {
        $this->showForm = true;
    }

    /**
     * Retrieves a paginated list of brands based on a search query.
     *
     * @return LengthAwarePaginator The paginated list of brands.
     */
    public function getBrands(): LengthAwarePaginator
    {
        $brands = Brand::where(function ($query){
            $query->where('code', 'like', '%' . $this->search . '%')
                ->orWhere('name', 'like', '%' . $this->search . '%');
        });

        if ($this->companyCode !== "all") {
            $brands = $brands->where('company_id', Company::where('code', $this->companyCode)->first()?->id);
        }

        return $brands->orderBy('id')
                ->paginate(5);
    }

    /**
     * Render the livewire component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.brand-table',[
            'brands' => self::getBrands()
        ]);
    }
}