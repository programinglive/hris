<?php

namespace App\Livewire;

use App\Http\Controllers\UserDetailController;
use App\Models\User;
use App\Models\UserDetail;
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
    public $loginAccount;

    public $password;

    /**
     * Mounts the login page.
     */
    public function mount()
    {
        $user = User::firstOrNew([
            'name' => 'admin',
            'email' => 'admin@test.com',
        ]);

        $user->password = bcrypt('hrisproject');
        $user->save();

        $userDetail = UserDetail::firstOrNew([
            'user_id' => $user->id,
        ]);

        $userDetail->nik = UserDetailController::generateNik();
        $userDetail->first_name = $user->name;
        $userDetail->save();

        if (Auth::user()) {
            return redirect()->intended('dashboard');
        }
    }

    /**
     * Logs in the user.
     */
    public function login(): RedirectResponse|Redirector
    {
        $this->validate(['loginAccount' => 'required', 'password' => 'required']);

        $login_type = filter_var($this->loginAccount, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'name';

        if (! Auth::attempt([
            $login_type => $this->loginAccount,
            'password' => $this->password])
        ) {
            return back()->withErrors([
                'loginAccount' => 'The provided credentials do not match our records.',
            ]);
        }

        return redirect()->intended('dashboard');
    }

    /**
     * Renders the login page view.
     */
    #[Title('Login Page')]
    public function render(): Application|Factory|View
    {
        return view('livewire.login-page');
    }
}
