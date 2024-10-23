<?php

namespace App\Livewire;

use App\Http\Controllers\ToolController;
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
    public $company;

    public $companyId;

    #[Url(keep: true)]
    public $companyCode;

    public $companyName;

    #[Validate('required|unique:branches|min:3')]
    public $code;

    #[Validate('required|min:3')]
    public $name;

    public $type = 'branch';

    public $branch;

    public $actionForm = 'save';

    /**
     * Initializes the component by setting the companyCode property based on the user's role and company code.
     */
    public function mount(): void
    {
        $this->companyCode = session('companyCode') ?? 'all';
    }

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
        if ($key == 'code') {
            $this->validateOnly($key);
        }
    }

    /**
     * Sets the value of the companyCode property to the given code.
     *
     * @param  string  $code  The code to set the companyCode property to.
     */
    #[On('set-company')]
    public function setCompany(string $code): void
    {
        if ($code == '') {
            $this->reset('companyId');

            return;
        }

        if ($code != 'all') {
            $this->companyCode = $code;
            $this->company = Company::where('code', $code)->first();
            $this->companyId = $this->company->id;
            $this->companyCode = $this->company->code;
            $this->companyName = $this->company->name;
        }

    }

    /** Clears the company data. */
    #[On('clear-company')]
    public function clearCompany(): void
    {
        $this->reset([
            'company',
            'companyId',
            'companyCode',
            'companyName',
        ]);
    }

    /**
     * The default data for the form.
     */
    public function branchData(): array
    {
        return [
            'company_id' => $this->companyId,
            'code' => ToolController::sanitizeString($this->code),
            'name' => $this->name,
            'type' => $this->type,
            'company_code' => $this->companyCode,
            'company_name' => $this->companyName,
            'created_by' => auth()->user()->id,
        ];
    }

    /**
     * Saves the branch details to the database and dispatches a 'branch-created' event.
     */
    public function save(): void
    {
        if (! $this->companyId) {
            $this->dispatch('companyRequired');

            return;
        }

        $this->validate();

        DB::transaction(function () {
            $this->branch = Branch::create($this->branchData());
        }, 5);

        $this->dispatch('hide-form');
        $this->dispatch('refresh');

        $this->dispatch('clear-form');

        $this->dispatch('refreshAnnouncement');

        $this->reset();
    }

    /**
     * Edit the branch details.
     */
    #[On('edit')]
    public function edit($code): void
    {
        $this->code = $code;
        $this->branch = Branch::where('code', $code)->first();

        $this->dispatch('set-company', $this->branch->company_code);

        $this->name = $this->branch->name;
        $this->type = $this->branch->type;
        $this->companyCode = $this->branch->company_code;
        $this->companyName = $this->branch->company_name;

        $this->actionForm = 'update';

        $this->dispatch('disable-filter');
        $this->dispatch('show-form');
    }

    /**
     * Updates the branch details in the database.
     */
    public function update(): void
    {
        if (! $this->companyId) {
            $this->dispatch('companyRequired');

            return;
        }

        DB::transaction(function () {
            $data = $this->branchData();
            $data['updated_by'] = auth()->user()->id;

            $this->branch->update($data);
        }, 5);

        $this->dispatch('clear-form');

        $this->dispatch('hide-form');

        $this->dispatch('refresh');

        $this->reset();
    }

    /**
     * Deletes the branch from the database.
     */
    #[On('delete')]
    public function destroy($code): void
    {
        $this->branch = Branch::where('code', $code)->first();
        $this->branch->code = $this->branch->code.time().'-deleted';
        $this->branch->save();

        $this->branch->delete();

        $this->dispatch('refreshAnnouncement');

        $this->dispatch('refresh');
        $this->dispatch('clear-form');
    }

    /**
     * Render the livewire component.
     */
    public function render(): View
    {
        return view('livewire.branch-form');
    }
}
