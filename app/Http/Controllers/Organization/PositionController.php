<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Models\Position;
use App\Models\Level;
use App\Models\SubDivision;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        // Query all positions without company filtering
        $query = Position::query();
        
        // Apply filters if provided
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        
        if ($request->filled('level_id')) {
            $query->where('level_id', $request->input('level_id'));
        }
        
        if ($request->filled('sub_division_id')) {
            $query->where('sub_division_id', $request->input('sub_division_id'));
        }
        
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }
        
        // Get positions with their relationships and paginate
        $positions = $query->with(['level', 'subDivision.division.department', 'company'])
                      ->orderBy('name')
                      ->paginate(10)
                      ->withQueryString();
        
        // Get levels and subdivisions for filters
        $levels = Level::orderBy('level_order')->get();
        $subDivisions = SubDivision::with('division.department')->orderBy('name')->get();
        
        return Inertia::render('organization/position/index', [
            'positions' => $positions,
            'levels' => $levels,
            'subDivisions' => $subDivisions,
            'filters' => $request->only(['search', 'level_id', 'sub_division_id', 'status']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        // Get levels, sub-divisions, and companies for dropdowns
        $levels = Level::orderBy('level_order')->get();
        $subDivisions = SubDivision::with('division')->orderBy('name')->get();
        $companies = Company::orderBy('name')->get();
        
        return Inertia::render('organization/position/create', [
            'levels' => $levels,
            'subDivisions' => $subDivisions,
            'companies' => $companies,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'level_id' => 'nullable|exists:levels,id',
            'sub_division_id' => 'nullable|exists:sub_divisions,id',
            'company_id' => 'required|exists:companies,id',
            'min_salary' => 'nullable|numeric|min:0',
            'max_salary' => 'nullable|numeric|min:0|gte:min_salary',
            'status' => 'required|in:active,inactive',
        ]);
        
        Position::create($validated);
        
        return redirect()->route('organization.position.index')
            ->with('success', 'Position created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Position $position): Response
    {
        $position->load(['level', 'subDivision.division.department', 'company']);
        
        return Inertia::render('organization/position/show', [
            'position' => $position,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Position $position): Response
    {
        $position->load(['level', 'subDivision', 'company']);
        
        // Get levels, sub-divisions, and companies for dropdowns
        $levels = Level::orderBy('level_order')->get();
        $subDivisions = SubDivision::with('division')->orderBy('name')->get();
        $companies = Company::orderBy('name')->get();
        
        return Inertia::render('organization/position/edit', [
            'position' => $position,
            'levels' => $levels,
            'subDivisions' => $subDivisions,
            'companies' => $companies,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Position $position): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'level_id' => 'nullable|exists:levels,id',
            'sub_division_id' => 'nullable|exists:sub_divisions,id',
            'company_id' => 'required|exists:companies,id',
            'min_salary' => 'nullable|numeric|min:0',
            'max_salary' => 'nullable|numeric|min:0|gte:min_salary',
            'status' => 'required|in:active,inactive',
        ]);
        
        $position->update($validated);
        
        return redirect()->route('organization.position.index')
            ->with('success', 'Position updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Position $position): RedirectResponse
    {
        // Check if position has employees
        if ($position->employees()->count() > 0) {
            return redirect()->route('organization.position.index')
                ->with('error', 'Cannot delete position with employees. Please reassign employees first.');
        }
        
        $position->delete();
        
        return redirect()->route('organization.position.index')
            ->with('success', 'Position deleted successfully.');
    }
}
