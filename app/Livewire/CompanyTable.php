<?php

namespace App\Livewire;

use App\Models\Company;
use Livewire\Attributes\On;
use Livewire\Component;

class CompanyTable extends Component
{
    public $showDropdown = false;

    #[On('company-created')]
    public function companyAdded($companyId): void
    {
        $this->showDropdown = false;
    }

    public function render()
    {
        return view('livewire.company-table',[
            'companies' => Company::all()
        ]);
    }
}