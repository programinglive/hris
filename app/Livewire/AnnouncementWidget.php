<?php

namespace App\Livewire;

use App\Models\Branch;
use App\Models\Company;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class AnnouncementWidget extends Component
{
    /**
     * Mount the component
     */
    public function mount(): void
    {
        $this->checkIfCompanyOrBranchExists();
    }

    /**
     * Refresh the announcement widget by checking if the company or branch exists.
     */
    #[On('refresh-announcement')]
    public function refreshAnnouncement(): void
    {
        $this->checkIfCompanyOrBranchExists();
        $this->dispatch('$refresh');
    }

    /**
     * Check if the company or branch exists.
     *
     * This method checks if the company or branch exists, and if so, removes the
     * session key for the announcement.
     */
    public function checkIfCompanyOrBranchExists(): void
    {
        session()->forget('announcement');

        $company = Company::first();
        $branch = Branch::first();

        if ($company) {
            session()->forget('announcement.'.$company->title);
        }

        if ($branch) {
            session()->forget('announcement.'.$branch->title);
        }

        if (! $branch) {
            session()->flash('announcement', [
                'title' => 'Branch',
                'message' => 'You have not created a branch, please create a branch first',
                'type' => 'warning',
                'url' => route('master.branches'),
            ]);
        }

        if (! $company) {
            session()->flash('announcement', [
                'title' => 'Company',
                'message' => 'You have not created a company, please create a company first',
                'type' => 'warning',
                'url' => route('master.companies'),
            ]);
        }
    }

    /**
     * Render the component
     */
    public function render(): View
    {
        return view('livewire.announcement-widget');
    }
}
