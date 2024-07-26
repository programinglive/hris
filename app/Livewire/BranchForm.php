<?php

namespace App\Livewire;

use App\Models\Branch;
use DB;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;

class BranchForm extends Component
{
    #[url]
    #[validate('required|unique:companies,code,deleted_at|min:3')]
    public $code;

    #[validate('required|min:3')]
    public $name;

    public $type;
    
    public $branch;

    public $actionForm = 'save';

    /**
     * Updates the specified property with the given value and performs validation if the property is 'code',
     * 'email', or 'phone'.
     *
     * @param string $key The name of the property to be updated.
     * @param mixed $value The new value for the property.
     * @return void
     * @throws ValidationException
     */
    public function updated(string $key, mixed $value): void
    {
        if($key == 'code'){
            $this->validateOnly($key);
        }
    }

    /**
     * The default data for the form.
     *
     * @return array
     */
    public function branchData(): array
    {
        return [
            'company_id' => auth()->user()->details->company_id,
            'code' => $this->code,
            'name' => $this->name,
            'type' => $this->type
        ];
    }

    /**
     * Saves the branch details to the database and dispatches a 'branch-created' event.
     *
     * @return void
     */
    public function save(): void
    {
        $this->validate();

        DB::transaction(function () {
            $this->branch = Branch::create($this->branchData());
        }, 5);

        $this->dispatch('branch-created', branchId: $this->branch->id);

        $this->reset();
    }

    /**
     * Edit the branch details.
     */
    #[on('edit')]
    public function edit($code): void
    {
        $this->code = $code;
        $this->branch = Branch::where('code',$code)->first();
        $this->name = $this->branch->name;

        $this->actionForm = 'update';

        $this->dispatch('show-form');
    }

    /**
     * Updates the branch details in the database.
     */
    public function update(): void
    {
        DB::transaction(function () {
            $this->branch->update($this->branchData());
        }, 5);

        $this->dispatch('branch-updated', branchId: $this->branch->id);

        $this->reset();
    }

    /**
     * Deletes the branch from the database.
     */
    #[on('delete')]
    public function destroy($code): void
    {
        $this->branch = Branch::where('code',$code)->first();
        $this->branch->delete();

        $this->dispatch('branch-deleted', refreshCompanies: true);
    }


    /**
     * Render the livewire component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.branch-form');
    }
}