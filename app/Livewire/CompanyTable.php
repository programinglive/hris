<?php

namespace App\Livewire;

use App\Models\Company;
use Livewire\Component;

class CompanyTable extends Component
{
    public function render()
    {
        return view('livewire.company-table',[
            'companies' => Company::all()
        ]);
    }
}