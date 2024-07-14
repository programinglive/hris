<?php

namespace App\Livewire;

use App\Models\User;
use Auth;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;

class LoginPage extends Component
{
    public $email;
    public $password;

    /**
     * Logs in the user.
     *
     */
    public function login(): RedirectResponse|Redirector
    {
        $this->validate(['email' => 'required|email', 'password' => 'required',]);

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            return back()->withErrors(['email' => 'The provided credentials do not match our records.',]);
        }

        return redirect()->intended('dashboard');
    }
    /**
     * Renders the login page view.
     *
     * @return Application|Factory|View
     */
    #[Title('Login Page')]
    public function render(): Application|Factory|View
    {
        return view('livewire.login-page');
    }
}