<?php

namespace App\Livewire;

use App\Models\Level;
use App\Models\Position;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class FormPositionOption extends Component
{
    public $positionCode;

    public $positions;

    public $option = 'disabled';

    /**
     * Update the position ID and dispatch the 'setPosition' event with the new ID.
     *
     * @param  string  $positionCode  The new position ID.
     */
    public function updatedPositionId(string $positionCode): void
    {
        $this->dispatch('setPosition', positionCode: $positionCode);
    }

    /**
     * Retrieves the position based on the given level code.
     *
     * @param  string  $levelCode  The code of the level.
     */
    #[On('getPosition')]
    public function getPosition(string $levelCode): void
    {
        $this->reset([
            'positions',
            'option',
        ]);

        $level = Level::where('code', $levelCode)->first();

        if ($level == null) {
            return;
        }

        $positions = Position::where('level_id', $level->id);

        if ($positions->count() > 0) {
            $this->option = '';
            $this->positions = $positions->get();
        }
    }

    /**
     * Render the view for the form position option.
     *
     * @return View The rendered view.
     */
    public function render(): View
    {
        return view('livewire.form-position-option');
    }
}
