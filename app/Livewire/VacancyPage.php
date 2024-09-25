<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class VacancyPage extends Component
{
    public $moduleLabel = 'Vacancy';

    /**
     * Renders the view for the brand page.
     *
     * @return View The rendered view.
     */
    public function render(): View
    {
        return view('livewire.vacancy-page')
            ->layout('components.layouts.dashboard');
    }
}
