<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Company;
use App\Models\Branch;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    /**
     * Display a listing of the brands.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        $query = Brand::with(['company', 'branch']);
        
        // Apply filters
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%");
            });
        }
        
        if ($request->has('company_id') && !empty($request->company_id)) {
            $query->where('company_id', $request->company_id);
        }
        
        if ($request->has('branch_id') && !empty($request->branch_id)) {
            $query->where('branch_id', $request->branch_id);
        }
        
        // Paginate results
        $brands = $query->paginate(10)->withQueryString();
        
        // Transform data
        $brands->getCollection()->transform(function ($brand) {
            return [
                'id' => $brand->id,
                'name' => $brand->name,
                'code' => $brand->code,
                'logo' => $brand->logo ? asset('storage/' . $brand->logo) : null,
                'company' => $brand->company ? [
                    'id' => $brand->company->id,
                    'name' => $brand->company->name,
                ] : null,
                'branch' => $brand->branch ? [
                    'id' => $brand->branch->id,
                    'name' => $brand->branch->name,
                ] : null,
                'is_active' => $brand->is_active,
                'created_at' => $brand->created_at->format('Y-m-d'),
            ];
        });
        
        // Get companies for filtering
        $companies = Company::where('is_active', true)
            ->get(['id', 'name']);
            
        // Get branches for filtering
        $branches = Branch::where('is_active', true)
            ->get(['id', 'name']);
        
        return Inertia::render('organization/brand/index', [
            'brands' => $brands,
            'companies' => $companies,
            'branches' => $branches,
            'filters' => [
                'search' => $request->search ?? '',
                'company_id' => $request->company_id ?? '',
                'branch_id' => $request->branch_id ?? '',
            ],
        ]);
    }

    /**
     * Show the form for creating a new brand.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        $companies = Company::where('is_active', true)
            ->get(['id', 'name']);
            
        $branches = Branch::where('is_active', true)
            ->get(['id', 'name']);
        
        return Inertia::render('organization/brand/create', [
            'companies' => $companies,
            'branches' => $branches,
        ]);
    }

    /**
     * Store a newly created brand in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:brands',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string|max:1000',
            'company_id' => 'required|exists:companies,id',
            'branch_id' => 'nullable|exists:branches,id',
            'is_active' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('brands', 'public');
        }

        Brand::create([
            'name' => $request->name,
            'code' => $request->code,
            'logo' => $logoPath,
            'description' => $request->description,
            'company_id' => $request->company_id,
            'branch_id' => $request->branch_id,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('organization.brand.index')
            ->with('success', 'Brand created successfully.');
    }

    /**
     * Display the specified brand.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function show($id)
    {
        $brand = Brand::with(['company', 'branch'])->findOrFail($id);
        
        return Inertia::render('organization/brand/details', [
            'brand' => [
                'id' => $brand->id,
                'name' => $brand->name,
                'code' => $brand->code,
                'logo' => $brand->logo ? asset('storage/' . $brand->logo) : null,
                'description' => $brand->description,
                'company' => $brand->company ? [
                    'id' => $brand->company->id,
                    'name' => $brand->company->name,
                ] : null,
                'branch' => $brand->branch ? [
                    'id' => $brand->branch->id,
                    'name' => $brand->branch->name,
                ] : null,
                'is_active' => $brand->is_active,
                'created_at' => $brand->created_at->format('Y-m-d'),
            ],
        ]);
    }

    /**
     * Show the form for editing the specified brand.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        $companies = Company::where('is_active', true)
            ->get(['id', 'name']);
            
        $branches = Branch::where('is_active', true)
            ->get(['id', 'name']);

        return Inertia::render('organization/brand/edit', [
            'brand' => [
                'id' => $brand->id,
                'name' => $brand->name,
                'code' => $brand->code,
                'logo' => $brand->logo ? asset('storage/' . $brand->logo) : null,
                'description' => $brand->description,
                'company_id' => $brand->company_id,
                'branch_id' => $brand->branch_id,
                'is_active' => $brand->is_active,
            ],
            'companies' => $companies,
            'branches' => $branches,
        ]);
    }

    /**
     * Update the specified brand in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:brands,code,' . $id,
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string|max:1000',
            'company_id' => 'required|exists:companies,id',
            'branch_id' => 'nullable|exists:branches,id',
            'is_active' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $logoPath = $brand->logo;
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($brand->logo) {
                Storage::disk('public')->delete($brand->logo);
            }
            $logoPath = $request->file('logo')->store('brands', 'public');
        }

        $brand->update([
            'name' => $request->name,
            'code' => $request->code,
            'logo' => $logoPath,
            'description' => $request->description,
            'company_id' => $request->company_id,
            'branch_id' => $request->branch_id,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('organization.brand.index')
            ->with('success', 'Brand updated successfully.');
    }

    /**
     * Remove the specified brand from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        
        // Check if the brand has any associated products or other dependencies
        // Add checks here if needed
        
        // Delete logo if exists
        if ($brand->logo) {
            Storage::disk('public')->delete($brand->logo);
        }
        
        $brand->delete();
        
        return redirect()->route('organization.brand.index')
            ->with('success', 'Brand deleted successfully.');
    }

    /**
     * Show the import page for brands
     *
     * @return \Inertia\Response
     */
    public function showImport()
    {
        $companies = Company::where('is_active', true)->get();
        $branches = Branch::where('is_active', true)->get();
        
        return Inertia::render('organization/brand/import', [
            'companies' => $companies,
            'branches' => $branches,
            'templateUrl' => route('organization.brand.import.template')
        ]);
    }
    
    /**
     * Generate and download a template for brand import
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadTemplate()
    {
        $filename = 'brand_import_template.xlsx';
        $tempPath = storage_path('app/temp/' . $filename);
        
        // Ensure the directory exists
        if (!file_exists(storage_path('app/temp'))) {
            mkdir(storage_path('app/temp'), 0755, true);
        }
        
        // Create a writer and add the headers
        $writer = \Spatie\SimpleExcel\SimpleExcelWriter::create($tempPath);
        
        // Add headers by adding a row with the header values
        $writer->addRow([
            'name' => 'name',
            'code' => 'code',
            'description' => 'description',
            'is_active' => 'is_active'
        ]);
        
        // Add example data
        $writer->addRow([
            'name' => 'Example Brand',
            'code' => 'BRD001',
            'description' => 'Example brand description',
            'is_active' => 'Yes'
        ]);
        
        // Close the writer to save the file
        $writer->close();
        
        return response()->download($tempPath, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ])->deleteFileAfterSend(true);
    }
    
    /**
     * Process the imported brand file
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Inertia\Response
     */
    public function processImport(Request $request)
    {
        // Validate the uploaded file
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:xlsx,xls,csv|max:10240',
            'company_id' => 'required|exists:companies,id',
            'branch_id' => 'required|exists:branches,id',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        
        if (!$request->hasFile('file')) {
            return back()->withErrors(['file' => 'No file was uploaded.']);
        }
        
        $file = $request->file('file');
        $company_id = $request->input('company_id');
        $branch_id = $request->input('branch_id');
        
        // Process the file directly from the uploaded file path
        try {
            $reader = \Spatie\SimpleExcel\SimpleExcelReader::create($file->getPathname());
            
            $importResults = [
                'total' => 0,
                'success' => 0,
                'failed' => 0,
                'errors' => [],
            ];
            
            \Illuminate\Support\Facades\DB::beginTransaction();
            
            try {
                $reader->getRows()->each(function(array $row) use (&$importResults, $company_id, $branch_id) {
                    $importResults['total']++;
                    
                    // Skip header row if it exists
                    if (isset($row['name']) && strtolower($row['name']) === 'name') {
                        return;
                    }
                    
                    // Validate row data
                    $validator = Validator::make($row, [
                        'name' => 'required|string|max:255',
                        'code' => 'required|string|max:50|unique:brands,code',
                        'description' => 'nullable|string|max:1000',
                        'is_active' => 'nullable|string',
                    ]);
                    
                    if ($validator->fails()) {
                        $importResults['failed']++;
                        $importResults['errors'][] = [
                            'row' => $importResults['total'],
                            'name' => $row['name'] ?? 'Unknown',
                            'code' => $row['code'] ?? 'Unknown',
                            'errors' => $validator->errors()->all(),
                        ];
                        return;
                    }
                    
                    try {
                        // Determine is_active value
                        $isActive = false;
                        if (isset($row['is_active'])) {
                            $isActiveValue = strtolower(trim($row['is_active']));
                            $isActive = in_array($isActiveValue, ['yes', 'true', '1', 'y']);
                        }
                        
                        // Create brand
                        Brand::create([
                            'name' => $row['name'],
                            'code' => $row['code'],
                            'description' => $row['description'] ?? null,
                            'company_id' => $company_id,
                            'branch_id' => $branch_id,
                            'is_active' => $isActive,
                        ]);
                        
                        $importResults['success']++;
                    } catch (\Exception $e) {
                        $importResults['failed']++;
                        $importResults['errors'][] = [
                            'row' => $importResults['total'],
                            'name' => $row['name'] ?? 'Unknown',
                            'code' => $row['code'] ?? 'Unknown',
                            'errors' => [$e->getMessage()],
                        ];
                    }
                });
                
                \Illuminate\Support\Facades\DB::commit();
                
                return back()->with([
                    'success' => true,
                    'message' => 'Import completed successfully.',
                    'results' => $importResults,
                ]);
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\DB::rollBack();
                
                return back()->with([
                    'success' => false,
                    'message' => 'An error occurred during import: ' . $e->getMessage(),
                ]);
            }
        } catch (\Exception $e) {
            // Handle file reading errors
            return back()->with([
                'success' => false,
                'message' => 'Error reading the import file: ' . $e->getMessage(),
            ]);
        }
    }
}
