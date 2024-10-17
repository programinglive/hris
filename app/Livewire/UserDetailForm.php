<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class UserDetailForm extends Component
{
    public $details = [
        'nik' => null,
        'first_name' => null,
        'last_name' => null,
        'phone' => null,
        'address' => null,
        'gender' => null,
        'religion' => null,
        'last_education' => null,
        'marriage_status' => null,
        'place_of_birth' => null,
        'date_of_birth' => null,
        'ktp' => null,
        'npwp' => null,
        'bank_account' => null,
        'date_in' => null,
        'date_out' => null,
        'note' => null
    ];

    /**
     * Listen to the Livewire property change event and update the $details array.
     *
     * @param string $key
     * @param  mixed  $value
     * @return void
     */
    public function updated(string $key, mixed $value): void
    {
        $keyArray = explode('.', $key);
        $this->details[$keyArray[1]] = $value;

        $this->dispatch('setDetail', $this->details);
    }

    public function render(): View
    {
        return view('livewire.user-detail-form');
    }
}