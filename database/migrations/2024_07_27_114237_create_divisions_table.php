<?php

use App\Models\Branch;
use App\Models\Company;
use App\Models\Department;
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
        Schema::create('divisions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Company::class)
                ->constrained('companies')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignIdFor(Branch::class)
                ->constrained('branches')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignIdFor(Department::class)
                ->constrained('departments')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('code');
            $table->string('name');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('divisions');
    }
};