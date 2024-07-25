<?php

namespace App\Livewire;

use App\Models\Company;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class CompanyTable extends Component
{
    use withPagination;
    public $showDropdown = false;

    /**
     * Handles the event when a company is created.
     *
     * @param int $companyId The ID of the created company.
     * @return void
     */
    #[On('company-created')]
    public function companyAdded(int $companyId): void
    {
        $this->showDropdown = false;
    }

    /**
     * Render the livewire component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.company-table',[
            'companies' => Company::paginate(5)
        ]);
    }
}