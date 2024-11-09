<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Company;
use Illuminate\Database\Schema\Blueprint;

class ToolController extends Controller
{
    /**
     * Static utility methods.
     */
    public static function sanitizeString($code): string
    {
        return strtoupper(trim(preg_replace('/\s+/', '', $code)));
    }

    /**
     * Add default columns to a table blueprint.
     */
    public static function defaultTableSchema(Blueprint $table): Blueprint
    {
        $table->foreignIdFor(Company::class)
            ->nullable()
            ->constrained()
            ->cascadeOnUpdate()
            ->cascadeOnDelete();
        $table->foreignIdFor(Branch::class)
            ->nullable()
            ->constrained()
            ->cascadeOnUpdate()
            ->cascadeOnDelete();
        $table->string('company_code')->nullable();
        $table->string('company_name')->nullable();
        $table->string('branch_code')->nullable();
        $table->string('branch_name')->nullable();
        $table->string('created_by')->nullable();
        $table->string('updated_by')->nullable();
        $table->softDeletes();
        $table->timestamps();

        return $table;
    }

    /**
     * Set session value.
     */
    public static function setSession(string $key, mixed $value): void
    {
        session([$key => $value]);
    }

    /**
     * Generate code for a given model.
     */
    public static function generateCode(string $prefix, string $model): string
    {
        $prefixArray = explode('_', $model);
        $prefixArray = array_map('ucfirst', $prefixArray);
        $model = implode('', $prefixArray);

        $model = 'App\Models\\'.ucfirst($model);
        $modelInstance = app($model);

        return $prefix.str_pad($modelInstance::withTrashed()->count() + 1, 5, '0', STR_PAD_LEFT);
    }
}
