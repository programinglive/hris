<?php

namespace App\Livewire;

use App\Models\Company;
use Livewire\Component;

class PageFilter extends Component
{
    public function render()
    {
        return view('livewire.page-filter', [
            'companies' => Company::all(),
        ]);
    }
}