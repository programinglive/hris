<?php

namespace App\Livewire;

use App\Models\Position;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class FormPositionOption extends Component
{
    #[Url(keep: true)]
    public $positionCode;

    /**
     * Update the position ID and dispatch the 'set-position' event with the new ID.
     *
     * @param  string  $positionCode  The new position ID.
     */
    public function updatedPositionCode(string $positionCode): void
    {
        $this->dispatch('set-position', $positionCode);
    }

    #[On('set-position')]
    public function setPosition(string $positionCode): void
    {
        $this->positionCode = $positionCode;
    }

    public function getPosition(): Collection
    {
        return Position::all();
    }

    #[On('clear-form')]
    public function clearForm(): void
    {
        $this->resetErrorBag();
        $this->reset();
    }

    /**
     * Render the view for the form position option.
     *
     * @return View The rendered view.
     */
    public function render(): View
    {
        return view('livewire.form-position-option',[
            'positions' => self::getPosition(),
        ]);
    }
}