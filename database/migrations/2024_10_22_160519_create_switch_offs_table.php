<?php

use App\Http\Controllers\ToolController;
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
        Schema::create('switch_offs', function (Blueprint $table) {
            $table->id();
            $table = ToolController::defaultTableSchema($table);
            $table->string('employee_id');
            $table->string('employee_nik');
            $table->string('employee_code')->nullable();
            $table->string('employee_name')->nullable();
            $table->timestamp('from_date')->nullable();
            $table->timestamp('to_date')->nullable();
            $table->decimal('amount')->nullable();
            $table->string('reason')->nullable();
            $table->string('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('switch_offs');
    }
};
