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

    #[Url(keep: true)]
    public $branchCode;

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
            $this->addError('messages', 'Company not found');

            return;
        }

        // check if a branch exists
        $branch = Branch::first();

        if (! $branch) {
            $this->addError('messages', 'Branch not found');

            return;
        }

        $this->validate([
            'import' => 'required|mimes:csv,xlsx,xls',
        ]);

        $this->import->store(path: 'users');

        $this->import = $this->import->path();

        SimpleExcelReader::create($this->import)->getRows()
            ->each(function (array $rowProperties) {
                $name = trim(
                    strtolower(
                        str_replace(' ', '', $rowProperties['name'])
                    )
                );

                if (User::where('name', $name)->exists()) {
                    return;
                }

                $user = User::firstOrNew([
                    'name' => $name,
                    'email' => $name.'@beautyworld.co.id',
                ]);

                $user->password = bcrypt('hrisproject');

                $user->save();

                $userDetail = UserDetail::create([
                    'company_id' => Company::first()->id,
                    'branch_id' => Branch::first()->id,
                    'code' => $this->generateEmployeeCode(),
                    'user_id' => $user->id,
                    'first_name' => $name,
                ]);

                $userDetail->phone = $rowProperties['phone'];
                $userDetail->save();
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
                $query->where('user_details.code', 'like', '%'.$this->search.'%')
                    ->orWhere('users.name', 'like', '%'.$this->search.'%');
            });

        if ($this->companyCode != 'all') {
            $users = $users->where('user_details.company_id', Company::where('code', $this->companyCode)->first()->id);
        }

        if ($this->branchCode != 'all') {
            $users = $users->where('user_details.branch_id', $this->branchCode);
        }

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

    /**
     * Generate a new employee code.
     *
     * This function generates a new employee code in the format "YY-MM-XXXX".
     * The "YY" represents the current year, the "MM" represents the current month,
     * and the "XXXX" represents the incrementing number.
     *
     * @return string The new employee code.
     */
    public function generateEmployeeCode(): string
    {
        $now = now();
        $year = $now->format('y');
        $month = $now->format('m');
        $lastUser = User::where('name', '!=', 'admin')->latest()->first();
        $lastCode = $lastUser?->employee_code;
        $lastIncrement = $lastCode ? (int) substr($lastCode, -4) : 0;
        $increment = str_pad($lastIncrement + 1, 4, '0', STR_PAD_LEFT);

        return "$year-$month-$increment";
    }
}
