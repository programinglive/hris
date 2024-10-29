<?php

namespace App\Livewire;

use App\Models\Level;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class FormLevelOption extends Component
{
    #[Url(keep: true)]
    public $levelCode;

    /**
     * Update the level ID and dispatch the 'set-level' event with the new ID.
     *
     * @param  string  $levelCode  The new level ID.
     */
    public function updatedLevelCode(string $levelCode): void
    {
        $this->dispatch('set-level', $levelCode);
    }

    #[On('set-level')]
    public function setLevel($levelCode): void
    {
        $this->levelCode = $levelCode;
    }

    /**
     * Get the level collection.
     *
     * @return Collection The level collection.
     */
    public static function getLevel(): Collection
    {
        return Level::all();
    }

    /**
     * Render the view for the form level option.
     *
     * @return View The rendered view.
     */
    public function render(): View
    {
        return view('livewire.form-level-option', [
            'levels' => self::getLevel(),
        ]);
    }
}