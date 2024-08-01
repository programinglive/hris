<?php

namespace App\Livewire;

use App\Models\Branch;
use App\Models\Company;
use DB;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;

class BranchForm extends Component
{
    public $companyId;
    #[Url(keep:true)]
    public $companyCode;

    #[Validate('required|unique:branches|min:3')]
    public $code;

    #[Validate('required|min:3')]
    public $name;

    public $type = 'branch';
    
    public $branch;

    public $actionForm = 'save';

    /**
     * Initializes the component by setting the companyCode property based on the user's role and company code.
     *
     * @return void
     */
    public function mount(): void
    {
        $role = auth()->user()->details->role;
        $this->companyCode = $role == 'administrator' ? auth()->user()->details->company->code : "" ;
    }

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
     * Sets the value of the companyCode property to the given code.
     *
     * @param string $code The code to set the companyCode property to.
     * @return void
     */
    #[On('setCompanyCode')]
    public function setCompanyCode(string $code): void
    {
        $this->companyCode = $code;
        
        $this->companyId = Company::where('code', $code)->first()->id;
    }

    #[On('resetCompanyId')]
    public function resetCompanyId(): void
    {
        $this->reset('companyId');
    }

    /**
     * The default data for the form.
     *
     * @return array
     */
    public function branchData(): array
    {
        return [
            'company_id' => $this->companyId,
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
        if(!$this->companyId){
            $this->dispatch('companyRequired');
            return;
        }

        $this->validate();

        DB::transaction(function () {
            $this->branch = Branch::create($this->branchData());
        }, 5);

        $this->dispatch('branch-created', branchId: $this->branch->id, refreshCompanies: true);
        $this->dispatch('clearFormCompanyOption');

        $this->reset();
    }

    /**
     * Edit the branch details.
     */
    #[On('edit')]
    public function edit($code): void
    {
        $this->code = $code;
        $this->branch = Branch::where('code',$code)->first();
        $this->companyId = $this->branch->company_id;
        $this->dispatch('selectCompany', companyId: $this->companyId);
        $this->name = $this->branch->name;
        $this->type = $this->branch->type;

        $this->actionForm = 'update';

        $this->dispatch('show-form');
    }

    /**
     * Updates the branch details in the database.
     */
    public function update(): void
    {
        if(!$this->companyId){
            $this->dispatch('companyRequired');
            return;
        }

        DB::transaction(function () {
            $this->branch->update($this->branchData());
        }, 5);

        $this->dispatch('branch-updated', branchId: $this->branch->id, refreshCompanies: true);
        $this->dispatch('clearFormCompanyOption');

        $this->reset();
    }

    /**
     * Deletes the branch from the database.
     */
    #[On('delete')]
    public function destroy($code): void
    {
        $this->branch = Branch::where('code',$code)->first();
        $this->branch->code = $this->branch->code.'-deleted';
        $this->branch->save();

        $this->branch->delete();

        $this->dispatch('branch-deleted', refreshCompanies: true);
        $this->dispatch('clearFormCompanyOption');
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