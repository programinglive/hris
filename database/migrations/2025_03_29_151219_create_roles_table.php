<?php

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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('display_name');
            $table->text('description')->nullable();
            $table->boolean('is_system')->default(false);
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            // Ensure a role name is unique per company
            $table->unique(['name', 'company_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
