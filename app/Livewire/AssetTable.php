<?php

namespace App\Livewire;

use App\Http\Controllers\AssetController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CompanyController;
use App\Models\Asset;
use App\Models\Company;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Spatie\SimpleExcel\SimpleExcelReader;

class AssetTable extends Component
{
    use WithFileUploads, withPagination;

    public $showForm = false;

    #[Url]
    public $search;

    #[Url(keep: true)]
    public $companyCode;

    public $import;

    public function importAsset(): void
    {
        $this->validate([
            'import' => 'required|mimes:csv,xlsx,xls',
        ]);

        $this->import->store(path: 'assets');

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

                $asset = Asset::firstOrNew([
                    'name' => $name,
                ]);

                if (! $asset->code) {
                    $asset->company_id = $company->id;
                    $asset->branch_id = $branch->id ?? null;
                    $asset->code = AssetController::generateCode();
                    $asset->company_code = $company->code;
                    $asset->company_name = $company->name;
                    $asset->branch_code = $branch->code ?? null;
                    $asset->branch_name = $branch->name ?? null;
                }

                $asset->save();
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
     * Handles the event when a asset is created.
     *
     * @param  int  $assetId  The ID of the created asset.
     */
    #[On('asset-created')]
    public function assetAdded(int $assetId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a asset is updated.
     *
     * @param  int  $assetId  The ID of the updated asset.
     */
    #[On('asset-updated')]
    public function assetUpdated(int $assetId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a asset is deleted.
     */
    #[On('asset-deleted')]
    public function assetDeleted(): void
    {
        $this->showForm = false;
        $this->resetPage();
        $this->getAsset();
    }

    /**
     * Shows the form asset.
     */
    #[On('show-form')]
    public function showForm(): void
    {
        $this->showForm = true;
    }

    /**
     * Retrieves a paginated list of assets based on a search query.
     *
     * @return LengthAwarePaginator The paginated list of assets.
     */
    public function getAsset(): LengthAwarePaginator
    {
        $assets = Asset::where(function ($query) {
            $query->where('code', 'like', '%'.$this->search.'%')
                ->orWhere('name', 'like', '%'.$this->search.'%');
        });

        if ($this->companyCode !== 'all') {
            $assets = $assets->where('company_id', Company::where('code', $this->companyCode)->first()?->id);
        }

        return $assets->orderBy('id')
            ->paginate(5);
    }

    /**
     * Render the livewire component.
     */
    public function render(): View
    {
        return view('livewire.asset-table', [
            'assets' => self::getAsset(),
        ]);
    }
}