<?php

namespace App\Livewire;

use Livewire\Component;

class BranchPage extends Component
{
    public $moduleLabel = 'Branch';

    public function render()
    {
        return view('livewire.branch-page')
            ->layout('components.layouts.dashboard');
    }
}