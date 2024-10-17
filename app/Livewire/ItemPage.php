<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Url;
use Livewire\Component;

class ItemPage extends Component
{
    #[Url(keep: true)]
    public $companyCode;

    public $moduleLabel = 'Item';

    public function render(): View
    {
        return view('livewire.item-page')
            ->layout('components.layouts.dashboard');
    }
}