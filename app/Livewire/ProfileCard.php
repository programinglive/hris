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
    }

    /**
     * Set the company code
     *
     * @param string $companyCode
     */
    #[On('set-company')]
    public function setCompany(string $companyCode): void
    {
        $this->companyCode = $companyCode;
    }

    /**
     * Set the branch code
     *
     * @param string $branchCode
     */
    #[On('set-branch')]
    public function setBranch(string $branchCode): void
    {
        $this->branchCode = $branchCode;
    }

    /**
     * Set the department code
     *
     * @param string $departmentCode
     */
    #[On('set-department')]
    public function setDepartment(string $departmentCode): void
    {
        $this->departmentCode = $departmentCode;
    }


    /**
     * Set the division code
     *
     * @param string $divisionCode
     */
    #[On('set-division')]
    public function setDivision(string $divisionCode): void
    {
        $this->divisionCode = $divisionCode;
    }


    /**
     * Set the subdivision code
     *
     * @param string $subDivisionCode
     */
    #[On('set-sub-division')]
    public function setSubDivision(string $subDivisionCode): void
    {
        $this->subDivisionCode = $subDivisionCode;
    }


    /**
     * Set the level code
     *
     * @param string $levelCode
     */
    #[On('set-level')]
    public function setLevel(string $levelCode): void
    {
        $this->levelCode = $levelCode;
    }



    /**
     * Set the position code
     *
     * @param string $positionCode
     */
    #[On('set-position')]
    public function setPosition(string $positionCode): void
    {
        $this->positionCode = $positionCode;
    }

    /**
     * Render the profile card view
     *
     * @return  View
     */
    public function render(): View
    {
        return view('livewire.profile-card', [
            'user' => $this->user
        ]);
    }
}