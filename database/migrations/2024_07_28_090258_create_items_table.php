<?php

use App\Http\Controllers\ToolController;
use App\Models\Department;
use App\Models\Division;
use App\Models\Level;
use App\Models\Position;
use App\Models\SubDivision;
use App\Models\User;
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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table = ToolController::defaultTableSchema($table);
            $table->foreignIdFor(User::class)
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignIdFor(Department::class)
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignIdFor(Division::class)
                ->nullable()
                ->constrained('departments')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignIdFor(SubDivision::class)
                ->nullable()
                ->constrained('departments')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignIdFor(Position::class)
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignIdFor(Level::class)
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('code');
            $table->string('name');
            $table->string('description')->nullable();
            $table->decimal('price', 10);
            $table->timestamp('date_request')->nullable();
            $table->timestamp('date_receive')->nullable();
            $table->timestamp('date_approve')->nullable();
            $table->string('employee_nik')->nullable();
            $table->string('employee_name')->nullable();
            $table->string('approved_nik')->nullable();
            $table->string('approved_name')->nullable();
            $table->string('received_nik')->nullable();
            $table->string('received_name')->nullable();
            $table->string('department_code')->nullable();
            $table->string('department_name')->nullable();
            $table->string('division_code')->nullable();
            $table->string('division_name')->nullable();
            $table->string('sub_division_code')->nullable();
            $table->string('sub_division_name')->nullable();
            $table->string('position_code')->nullable();
            $table->string('position_name')->nullable();
            $table->string('level_code')->nullable();
            $table->string('level_name')->nullable();
            $table->string('approver_id')->nullable();
            $table->string('approver_nik')->nullable();
            $table->string('approver_name')->nullable();
            $table->string('receiver_id')->nullable();
            $table->string('receiver_nik')->nullable();
            $table->string('receiver_name')->nullable();
            $table->enum('module', ['inventory'])->default('inventory');
            $table->unsignedInteger('module_id')->nullable();
            $table->string('module_code')->nullable();
            $table->string('module_name')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
