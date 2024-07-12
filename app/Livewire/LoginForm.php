<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\View\View;
use Livewire\Component;

class LoginForm extends Component
{
    public function goToDashboard()
    {
        auth()->login(User::first());
        $this->redirect(route('admin.dashboard'));
    }

    public function render(): Application|Factory|View
    {
        return view('livewire.login-form');
    }
}
