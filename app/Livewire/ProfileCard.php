<?php

namespace App\Livewire;

use App\Models\UserDetail;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class ProfileCard extends Component
{
    #[Url(keep: true)]
    public $companyCode;

    #[Url(keep: true)]
    public $branchCode;

    #[Url(keep: true)]
    public $departmentCode;

    #[Url(keep: true)]
    public $divisionCode;

    #[Url(keep: true)]
    public $subDivisionCode;

    #[Url(keep: true)]
    public $levelCode;

    #[Url(keep: true)]
    public $positionCode;

    #[Url(keep: true)]
    public $nik;

    public $user;

    public $userDetail;

    public $actionForm = 'update';

    /**
     * Set the user based on the given user id
     */
    public function mount(): void
    {
        if ($this->nik != '') {
            $this->userDetail = UserDetail::where('nik', $this->nik)->first();
            $this->user = $this->userDetail->user;
        }

        if (! $this->user) {
            $this->user = auth()->user();
        }
    }

    /**
     * Set the company code
     */
    #[On('set-company')]
    public function setCompany(string $companyCode): void
    {
        $this->companyCode = $companyCode;
    }

    /**
     * Set the branch code
     */
    #[On('set-branch')]
    public function setBranch(string $branchCode): void
    {
        $this->branchCode = $branchCode;
    }

    /**
     * Set the department code
     */
    #[On('set-department')]
    public function setDepartment(string $departmentCode): void
    {
        $this->departmentCode = $departmentCode;
    }

    /**
     * Set the division code
     */
    #[On('set-division')]
    public function setDivision(string $divisionCode): void
    {
        $this->divisionCode = $divisionCode;
    }

    /**
     * Set the subdivision code
     */
    #[On('set-sub-division')]
    public function setSubDivision(string $subDivisionCode): void
    {
        $this->subDivisionCode = $subDivisionCode;
    }

    /**
     * Set the level code
     */
    #[On('set-level')]
    public function setLevel(string $levelCode): void
    {
        $this->levelCode = $levelCode;
    }

    /**
     * Set the position code
     */
    #[On('set-position')]
    public function setPosition(string $positionCode): void
    {
        $this->positionCode = $positionCode;
    }

    /**
     * Render the profile card view
     */
    public function render(): View
    {
        return view('livewire.profile-card', [
            'user' => $this->user,
        ]);
    }
}
