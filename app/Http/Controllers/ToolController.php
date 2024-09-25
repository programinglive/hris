<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Company;
use Illuminate\Database\Schema\Blueprint;

class ToolController extends Controller
{
    public static function sanitizeString($code): string
    {
        return strtoupper(trim(preg_replace('/\s+/', '', $code)));
    }

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
}