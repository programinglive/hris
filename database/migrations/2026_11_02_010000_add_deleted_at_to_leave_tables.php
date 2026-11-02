<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * The alignment migration added deleted_at to the leave tables, but it had
 * already been applied on the live database before that change, so those columns
 * were never created there. A separate migration fixes installations that ran
 * the earlier version.
 */
return new class extends Migration
{
    public function up(): void
    {
        foreach (['leave_types', 'leave_requests', 'leave_balances'] as $table) {
            if (Schema::hasTable($table) && ! Schema::hasColumn($table, 'deleted_at')) {
                Schema::table($table, function (Blueprint $t) {
                    $t->softDeletes();
                });
            }
        }
    }

    public function down(): void
    {
        foreach (['leave_types', 'leave_requests', 'leave_balances'] as $table) {
            if (Schema::hasTable($table) && Schema::hasColumn($table, 'deleted_at')) {
                Schema::table($table, function (Blueprint $t) {
                    $t->dropSoftDeletes();
                });
            }
        }
    }
};
