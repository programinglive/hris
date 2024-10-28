<?php

use App\Http\Controllers\ToolController;
use App\Models\Department;
use App\Models\Division;
use App\Models\SubDivision;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('levels', function (Blueprint $table) {
            $table->id();
            $table = ToolController::defaultTableSchema($table);
            $table->foreignIdFor(Department::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignIdFor(Division::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignIdFor(SubDivision::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('department_code')->nullable();
            $table->string('department_name')->nullable();
            $table->string('division_code')->nullable();
            $table->string('division_name')->nullable();
            $table->string('sub_division_code')->nullable();
            $table->string('sub_division_name')->nullable();
            $table->string('code')->unique();
            $table->string('name');
            $table->text('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('levels');
    }
};
