<?php

namespace App\Livewire;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\View\View;
use Livewire\Component;

class LoginForm extends Component
{
    public function render(): Application|Factory|View
    {
        return view('livewire.login-form');
    }
}
