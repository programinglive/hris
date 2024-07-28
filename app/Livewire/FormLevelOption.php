<?php

namespace App\Livewire;

use App\Models\Level;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class FormLevelOption extends Component
{
    public $levelId;

    /**
     * Update the level ID and dispatch the 'setLevel' event with the new ID.
     *
     * @param int $levelId The new level ID.
     * @return void
     */
    public function updatedLevelId(int $levelId): void
    {
        $this->dispatch('setLevel',  levelId: $levelId );
    }
    /**
     * Render the view for the form level option.
     *
     * @return View The rendered view.
     */
    public function render(): View
    {
        return view('livewire.form-level-option',[
            'levels' => Level::all(),
        ]);
    }
}