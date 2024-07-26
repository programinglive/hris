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
    public $showForm = false;

    /**
     * Handles the event when a company is created.
     *
     * @param int $companyId The ID of the created company.
     * @return void
     */
    #[On('company-created')]
    public function companyAdded(int $companyId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a company is updated.
     *
     * @param int $companyId The ID of the updated company.
     * @return void
     */
    #[On('company-updated')]
    public function companyUpdated(int $companyId): void
    {
        $this->showForm = false;
    }

    /**
     * Shows the form company.
     *
     * @return void
     */
    #[on('show-form')]
    public function showForm(): void
    {
        $this->showForm = true;
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