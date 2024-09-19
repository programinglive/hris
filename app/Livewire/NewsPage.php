<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class NewsPage extends Component
{
    public $moduleLabel = 'News';

    public function render(): View
    {
        return view('livewire.news-page')
            ->layout('components.layouts.dashboard');
    }
}
