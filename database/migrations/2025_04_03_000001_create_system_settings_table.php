<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('system_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->string('key')->index();
            $table->text('value');
            $table->string('type')->default('text');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['company_id', 'key']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('system_settings');
    }
};
