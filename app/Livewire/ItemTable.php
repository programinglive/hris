<?php

namespace App\Livewire;

use App\Http\Controllers\BranchController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CompanyController;
use App\Models\Item;
use App\Models\Company;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Spatie\SimpleExcel\SimpleExcelReader;

class ItemTable extends Component
{
    use WithFileUploads, withPagination;

    public $showForm = false;

    #[Url]
    public $search;

    #[Url(keep: true)]
    public $companyCode = 'all';

    public $import;

    public function importItem(): void
    {
        $this->validate([
            'import' => 'required|mimes:csv,xlsx,xls',
        ]);

        $this->import->store(path: 'items');

        $this->import = $this->import->path();

        SimpleExcelReader::create($this->import)->getRows()
            ->each(function (array $rowProperties) {
                $name = trim(
                    strtolower(
                        str_replace(' ', '', $rowProperties['name'])
                    )
                );

                $company = Company::firstOrNew([
                    'name' => $rowProperties['company_name'],
                ]);

                if (! $company->code) {
                    $company->code = CompanyController::generateCode();
                }

                $company->save();

                if ($rowProperties['branch_name']) {
                    $branch = BranchController::createByName($company, $rowProperties['branch_name']);
                }

                $item = Item::firstOrNew([
                    'name' => $name,
                ]);

                if (! $item->code) {
                    $item->company_id = $company->id;
                    $item->branch_id = $branch->id ?? null;
                    $item->code = ItemController::generateCode();
                    $item->company_code = $company->code;
                    $item->company_name = $company->name;
                    $item->branch_code = $branch->code ?? null;
                    $item->branch_name = $branch->name ?? null;
                }

                $item->save();
            });

        redirect()->back();
    }

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
     * Handles the event when a item is created.
     *
     * @param  int  $itemId  The ID of the created item.
     */
    #[On('item-created')]
    public function itemAdded(int $itemId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a item is updated.
     *
     * @param  int  $itemId  The ID of the updated item.
     */
    #[On('item-updated')]
    public function itemUpdated(int $itemId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a item is deleted.
     */
    #[On('item-deleted')]
    public function itemDeleted(): void
    {
        $this->showForm = false;
        $this->resetPage();
        $this->getItems();
    }

    /**
     * Shows the form item.
     */
    #[On('show-form')]
    public function showForm(): void
    {
        $this->showForm = true;
    }

    /**
     * Retrieves a paginated list of items based on a search query.
     *
     * @return LengthAwarePaginator The paginated list of items.
     */
    public function getItems(): LengthAwarePaginator
    {
        $items = Item::where(function ($query) {
            $query->where('code', 'like', '%'.$this->search.'%')
                ->orWhere('name', 'like', '%'.$this->search.'%');
        });

        if ($this->companyCode !== 'all') {
            $items = $items->where('company_id', Company::where('code', $this->companyCode)->first()?->id);
        }

        return $items->orderBy('id')
            ->paginate(5);
    }

    /**
     * Render the livewire component.
     */
    public function render(): View
    {
        return view('livewire.item-table', [
            'items' => self::getItems(),
        ]);
    }
}