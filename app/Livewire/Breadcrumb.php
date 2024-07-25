<?php

namespace App\Livewire;

use Livewire\Component;

class Breadcrumb extends Component
{
    public $moduleLabel;

    public function render()
    {
        return view('livewire.breadcrumb');
    }
}