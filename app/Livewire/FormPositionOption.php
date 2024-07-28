<?php

namespace App\Livewire;

use App\Models\Position;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class FormPositionOption extends Component
{
    public $positionId;

    /**
     * Update the position ID and dispatch the 'setPosition' event with the new ID.
     *
     * @param int $positionId The new position ID.
     * @return void
     */
    public function updatedPositionId(int $positionId): void
    {
        $this->dispatch('setPosition',  positionId: $positionId );
    }
    /**
     * Render the view for the form position option.
     *
     * @return View The rendered view.
     */
    public function render(): View
    {
        return view('livewire.form-position-option',[
            'positions' => Position::all(),
        ]);
    }
}