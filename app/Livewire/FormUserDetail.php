<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class FormUserDetail extends Component
{
    public $details = [
        'first_name' => '',
        'last_name' => '',
        'email' => '',
    ];

    public function render(): View
    {
        return view('livewire.form-user-detail');
    }
}
