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
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table = ToolController::defaultTableSchema($table);
            $table->string('employee_id');
            $table->string('employee_nik');
            $table->string('employee_code')->nullable();
            $table->string('employee_name')->nullable();
            $table->timestamp('date')->nullable();
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->integer('duration')->nullable();
            $table->string('phone')->nullable();
            $table->string('reason')->nullable();
            $table->string('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
};