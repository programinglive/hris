<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\Division;
use App\Models\Level;
use DB;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class LevelForm extends Component
{
    #[Validate('required|string|min:1')]
    public $departmentId;

    #[Validate('required|string|min:1')]
    public $divisionCode;

    #[Validate('required|unique:levels|min:3')]
    public $code;

    #[Validate('required|min:3')]
    public $name;

    public $level;

    public $actionForm = 'save';

    /**
     * Updates the specified property with the given value and performs validation if the property is 'code',
     * 'email', or 'phone'.
     *
     * @param  string  $key  The name of the property to be updated.
     * @param  mixed  $value  The new value for the property.
     *
     * @throws ValidationException
     */
    public function updated(string $key, mixed $value): void
    {
        $this->resetErrorBag();

        if ($key == 'code' || $key == 'name') {
            $this->validateOnly($key);
        }
    }

    /**
     * The default data for the form.
     */
    public function levelData(): array
    {
        return [
            'company_id' => 1,
            'branch_id' => 1,
            'department_id' => $this->departmentId,
            'division_id' => $this->divisionCode,
            'code' => $this->code,
            'name' => $this->name,
        ];
    }

    /**
     * Saves the level details to the database and dispatches a 'level-created' event.
     */
    public function save(): void
    {
        $this->validate();

        DB::transaction(function () {
            $this->level = Level::create($this->levelData());
        }, 5);

        $this->dispatch('level-created', levelId: $this->level->id);

        $this->reset();
    }

    /**
     * Edit the level details.
     */
    #[On('edit')]
    public function edit($code): void
    {
        $this->level = Level::where('code', $code)->first();
        $this->departmentId = $this->level->department_id;
        $this->divisionCode = $this->level->division_id;
        $this->code = $this->level->code;
        $this->name = $this->level->name;

        $this->actionForm = 'update';

        $this->dispatch('show-form');
    }

    /**
     * Updates the level details in the database.
     */
    public function update(): void
    {
        $organizations = [
            'departmentId',
            'divisionCode',
        ];

        foreach ($organizations as $organization) {

            if ($this->{$organization} == '') {
                $this->addError($organization, 'Please select a ['.ucfirst(rtrim($organization, 'Id')).'].');

                return;
            }
        }

        if ($this->code != $this->level->code) {
            $this->validateOnly('code');
        }

        DB::transaction(function () {
            $this->level->update($this->levelData());
        }, 5);

        $this->dispatch('level-updated', levelId: $this->level->id);

        $this->reset();
    }

    /**
     * Deletes the level from the database.
     */
    #[On('delete')]
    public function destroy($code): void
    {
        $this->level = Level::where('code', $code)->first();
        $this->level->code = $this->level->code.'-deleted';
        $this->level->save();
        $this->level->delete();

        $this->dispatch('level-deleted', refreshCompanies: true);

        $this->reset();
    }

    /**
     * Render the livewire component.
     */
    public function render(): View
    {
        return view('livewire.level-form', [
            'departments' => Department::all(),
            'divisions' => Division::all(),
        ]);
    }
}
