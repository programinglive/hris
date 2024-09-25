<?php

namespace App\Livewire;

use App\Models\Branch;
use App\Models\Company;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class AnnouncementWidget extends Component
{
    public function mount(): void
    {
        $this->checkIfCompanyOrBranchExists();
    }

    #[On('refreshAnnouncement')]
    public function refreshAnnouncement(): void
    {
        $this->checkIfCompanyOrBranchExists();
        $this->dispatch('$refresh');
    }

    public function render(): View
    {
        return view('livewire.announcement-widget');
    }

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
}
