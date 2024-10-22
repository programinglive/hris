<?php

namespace App\Livewire;

use App\Models\Company;
use App\Models\WorkingCalendar;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class WorkingCalendarTable extends Component
{
    use WithFileUploads, withPagination;

    public $showForm = false;

    #[Url]
    public $search;

    #[Url(keep: true)]
    public $companyCode;

    /**
     * Sets the company code.
     *
     * @param  string  $code  The code to set as the company code.
     */
    #[On('setCompany')]
    public function setCompany(string $code): void
    {
        $this->companyCode = $code;
    }

    /**
     * Shows the form workingCalendar.
     */
    #[On('show-form')]
    public function showForm(): void
    {
        $this->resetPage();
        $this->showForm = true;
    }

    /**
     * Hides the form workingCalendar.
     */
    #[On('hide-form')]
    public function hideForm(): void
    {
        $this->resetPage();
        $this->showForm = false;
    }

    #[On('refresh')]
    public function refresh(): void {}

    /**
     * Retrieves a paginated list of workingCalendars based on a search query.
     *
     * @return LengthAwarePaginator The paginated list of workingCalendars.
     */
    public function getWorkingCalendar(): LengthAwarePaginator
    {
        $workingCalendars = WorkingCalendar::where(function ($query) {
            $query->where('date', 'like', '%'.$this->search.'%')
                ->orWhere('type', 'like', '%'.$this->search.'%');
        });

        if ($this->companyCode !== 'all') {
            $company = Company::where('code', $this->companyCode)->first();
            $workingCalendars = $workingCalendars->where(
                'company_id', $company?->id);
        }

        return $workingCalendars->orderBy('id')
            ->paginate(10);
    }

    /**
     * Render the livewire component.
     */
    public function render(): View
    {
        return view('livewire.working-calendar-table', [
            'workingCalendars' => self::getWorkingCalendar(),
        ]);
    }
}
