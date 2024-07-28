<?php

namespace App\Livewire;

use App\Models\Division;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class FormDivisionOption extends Component
{
    public $divisionId;

    /**
     * Update the division ID and dispatch the 'setDivision' event with the new ID.
     *
     * @param int $divisionId The new division ID.
     * @return void
     */
    public function updatedDivisionId(int $divisionId): void
    {
        $this->dispatch('setDivision',  divisionId: $divisionId );
    }
    /**
     * Render the view for the form division option.
     *
     * @return View The rendered view.
     */
    public function render(): View
    {
        return view('livewire.form-division-option',[
            'divisions' => Division::all(),
        ]);
    }
}