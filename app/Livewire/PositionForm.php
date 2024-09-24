<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\Division;
use App\Models\Level;
use App\Models\Position;
use DB;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class PositionForm extends Component
{
    public $departmentId;

    public $divisionId;

    public $levelId;

    #[Validate('required|unique:positions|min:3')]
    public $code;

    #[Validate('required|min:3')]
    public $name;

    public $position;

    public $actionForm = 'save';

    /**
     * Updates the specified property with the given value and performs validation if the property is 'code' or 'name'.
     *
     * @param  string  $key  The name of the property to be updated.
     * @param  mixed  $value  The new value for the property.
     *
     * @throws ValidationException
     */
    public function updated(string $key, mixed $value): void
    {
        $this->resetErrorBag();

        if ($key == 'code' && $this->position) {
            if ($value !== $this->position->code) {
                $this->validateOnly($key);
            }
        }
    }

    /**
     * The default data for the form.
     */
    public function positionData(): array
    {
        return [
            'company_id' => 1,
            'branch_id' => auth()->user()->details->branch_id,
            'department_id' => $this->departmentId,
            'division_id' => $this->divisionId,
            'level_id' => $this->levelId,
            'code' => $this->code,
            'name' => $this->name,
        ];
    }

    /**
     * Saves the position details to the database and dispatches a 'position-created' event.
     */
    public function save(): void
    {
        $this->validate();

        DB::transaction(function () {
            $this->position = Position::create($this->positionData());
        }, 5);

        $this->dispatch('position-created', positionId: $this->position->id);

        $this->reset();
    }

    /**
     * Edit the position details.
     */
    #[On('edit')]
    public function edit($code): void
    {
        $this->position = Position::where('code', $code)->first();
        $this->departmentId = (string) $this->position->department_id;
        $this->divisionId = (string) $this->position->division_id;
        $this->levelId = (string) $this->position->level_id;
        $this->code = $this->position->code;
        $this->name = $this->position->name;

        $this->actionForm = 'update';

        $this->dispatch('show-form');
    }

    /**
     * Updates the position details in the database.
     */
    public function update(): void
    {
        $organizations = [
            'departmentId',
            'divisionId',
            'levelId',
        ];

        foreach ($organizations as $organization) {

            if ($this->{$organization} == '') {
                $this->addError($organization, 'Please select a ['.ucfirst(rtrim($organization, 'Id')).'].');

                return;
            }
        }

        if ($this->code != $this->position->code) {
            $this->validateOnly('code');
        }

        DB::transaction(function () {
            $this->position->update($this->positionData());
        }, 5);

        $this->dispatch('position-updated', positionId: $this->position->id);

        $this->reset();
    }

    /**
     * Deletes the position from the database.
     */
    #[On('delete')]
    public function destroy($code): void
    {
        $this->position = Position::where('code', $code)->first();
        $this->position->code = $code.'-deleted';
        $this->position->save();

        $this->position->delete();

        $this->dispatch('position-deleted', refreshCompanies: true);
    }

    /**
     * Render the livewire component.
     */
    public function render(): View
    {
        return view('livewire.position-form', [
            'departments' => Department::all(),
            'divisions' => Division::all(),
            'levels' => Level::all(),
        ]);
    }
}