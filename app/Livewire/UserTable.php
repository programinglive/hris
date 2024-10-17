<?php

namespace App\Livewire;

use App\Models\Branch;
use App\Models\Company;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Spatie\SimpleExcel\SimpleExcelReader;

class UserTable extends Component
{
    use WithFileUploads, withPagination;

    public $showForm = false;

    public $import;

    #[Url]
    public $search;

    public $company;

    public $companyId;

    #[Url(keep: true)]
    public $companyCode;

    public $companyName;

    public $branch;

    public $branchId;

    #[Url(keep: true)]
    public $branchCode;

    public $branchName;

    public $employee;

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        if (empty($this->companyCode)) {
            $this->companyCode = 'all';
        }
    }

    /**
     * Handles the event when the import field is updated.
     *
     * This function will validate the uploaded file and store it in the
     * 'photos' directory.
     * The path of the uploaded file will be stored in
     * the $this→import variable.
     */
    public function importUser(): void
    {
        // check if a company exists
        $company = Company::first();

        if (! $company) {
            $this->addError('errorMessage', 'Company not found');

            return;
        }

        // check if a branch exists
        $branch = Branch::first();

        if (! $branch) {
            $this->addError('errorMessage', 'Branch not found');

            return;
        }

        $this->validate([
            'import' => 'required|mimes:csv,xlsx,xls',
        ]);

        $this->import->store(path: 'users');

        $this->import = $this->import->path();

        SimpleExcelReader::create($this->import)->getRows()
            ->each(function (array $rowProperties) {

                $this->company = Company::where('code', $rowProperties['comp_code'])->first();

                $this->branch = Branch::where('code', $rowProperties['branch_code'])->first();

                $checkUser = User::where('name', $rowProperties['name'])->first();

                if (!$checkUser) {
                    if ($rowProperties['email'] == '') {
                        $rowProperties['email'] = time().'@test.com';
                    }

                    $user = User::create([
                        'name' => $rowProperties['name'],
                        'password' => bcrypt('hris123'),
                        'email' => $rowProperties['email'] == '' ? time() . '@test.com' : $rowProperties['name'] . '@test.com',
                    ]);

                    UserDetail::create([
                        'company_id' => $this->company?->id,
                        'branch_id' => $this->branch?->id,
                        'user_id' => $user->id,
                        'company_code' => $this->company?->code,
                        'company_name' => $this->company?->name,
                        'branch_code' => $this->branch?->code,
                        'branch_name' => $this->branch?->name,
                        'nik' => $rowProperties['nik'],
                        'first_name' => $rowProperties['first_name'],
                        'last_name' => $rowProperties['last_name'],
                        'date_in' => $rowProperties['date_in'],
                        'date_out' => $rowProperties['date_out'],
                    ]);

                } else {
                    $this->addError('errorMessage', 'No data Submited');
                }
            });

        redirect()->back();
    }

    /**
     * Handles the event when a user is created.
     *
     * @param  int  $userId  The ID of the created user.
     */
    #[On('user-created')]
    public function userAdded(int $userId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a user is updated.
     *
     * @param  int  $userId  The ID of the updated user.
     */
    #[On('user-updated')]
    public function userUpdated(int $userId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a user is deleted.
     */
    #[On('user-deleted')]
    public function userDeleted(): void
    {
        $this->showForm = false;
        $this->resetPage();
        $this->getUsers();
    }

    /**
     * Shows the form user.
     */
    #[On('show-form')]
    public function showForm(): void
    {
        $this->showForm = true;
    }

    /**
     * Hide the form user.
     */
    #[On('hide-form')]
    public function hideForm(): void
    {
        $this->showForm = false;
    }

    /**
     * Retrieves a paginated list of users based on the search criteria.
     *
     * @return LengthAwarePaginator The paginated list of users.
     */
    public function getUsers(): LengthAwarePaginator
    {
        $users = User::join('user_details', 'user_details.user_id', '=', 'users.id')
            ->where(function ($query) {
                $query->where('user_details.nik', 'like', '%'.$this->search.'%')
                    ->orWhere('users.name', 'like', '%'.$this->search.'%');
            })
            ->where(function ($query) {
                $query->whereNot('users.name', 'like', 'admin');
            });

        return $users->orderBy('users.id')
            ->paginate(5);
    }

    /**
     * Render the livewire component.
     */
    public function render(): View
    {
        return view('livewire.user-table', [
            'users' => self::getUsers(),
        ]);
    }
}