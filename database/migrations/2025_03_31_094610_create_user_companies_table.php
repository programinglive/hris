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
        Schema::create('user_companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->boolean('is_primary')->default(false);
            $table->unique(['user_id', 'company_id']);
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('company_id', 'primary_company_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('primary_company_id', 'company_id');
        });

        Schema::dropIfExists('user_companies');
    }
};
