<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class TransactionAnnouncementMenu extends Component
{
    public function render(): View
    {
        return view('livewire.transaction-announcement-menu');
    }
}