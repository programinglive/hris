<?php

namespace App\Livewire;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\View\View;
use Livewire\Component;

class PageHeader extends Component
{
    public $navbarBrand = 'HRIS';

    public $navItems = [
        ['name' => 'About', 'url' => '/about'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Register', 'url' => '/companyRegister'],
    ];

    /**
     * Render the view for the component.
     */
    public function render(): Factory|Application|View
    {
        return view('livewire.page-header');
    }
}
