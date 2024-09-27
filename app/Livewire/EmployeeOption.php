<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class EmployeeOption extends Component
{
    public $search;
    public $employees;

    public function updated()
    {
        $this->employees = User::where('name', 'like', '%'.$this->search.'%')->get();
    }

    public function render(): View
    {
        return view('livewire.employee-option');
    }
}