<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Align the database schema with what the models and seeders actually use.
 *
 * Background: commit babff7f (5 April 2025) removed the users.primary_company_id
 * migration and moved company membership into user_details, but left the column
 * named `primary_company_id` there while the rest of the codebase (models,
 * seeders, controllers) consistently uses `company_id`. Separately four HR
 * modules were scaffolded as empty tables (id + timestamps only) while their
 * models declared full fillable sets.
 *
 * The result was that no test touching these tables could pass: 251 of 252
 * tests failed on "no column named ...". This migration makes the schema match
 * the code instead of the other way around.
 */
return new class extends Migration
{
    public function up(): void
    {
        // The codebase references user_details.company_id in 197 places versus
        // 7 for primary_company_id, and User::company() resolves through
        // `company_id`. Rename rather than duplicate the column.
        if (Schema::hasColumn('user_details', 'primary_company_id')
            && ! Schema::hasColumn('user_details', 'company_id')) {
            Schema::table('user_details', function (Blueprint $table) {
                $table->renameColumn('primary_company_id', 'company_id');
            });
        } elseif (Schema::hasColumn('user_details', 'primary_company_id')
            && Schema::hasColumn('user_details', 'company_id')) {
            // Both exist somewhere: keep company_id, drop the stale duplicate.
            Schema::table('user_details', function (Blueprint $table) {
                $table->dropForeign(['primary_company_id']);
                $table->dropColumn('primary_company_id');
            });
        }

        Schema::table('brands', function (Blueprint $table) {
            if (! Schema::hasColumn('brands', 'branch_id')) {
                $table->foreignId('branch_id')->nullable()->after('company_id')
                    ->constrained()->nullOnDelete();
            }
        });

        foreach (['departments', 'divisions', 'sub_divisions'] as $table) {
            if (! Schema::hasColumn($table, 'manager_id')) {
                Schema::table($table, function (Blueprint $t) {
                    $t->foreignId('manager_id')->nullable()->after('description')
                        ->constrained('users')->nullOnDelete();
                });
            }
        }

        if (! Schema::hasColumn('roles', 'display_name')) {
            Schema::table('roles', function (Blueprint $table) {
                $table->string('display_name')->nullable()->after('name');
            });
        }

        if (! Schema::hasColumn('roles', 'is_system')) {
            Schema::table('roles', function (Blueprint $table) {
                $table->boolean('is_system')->default(false)->after('description');
            });
        }

        // WorkSchedule uses the SoftDeletes trait but the original migration
        // never added the column, so every query failed with
        // "no such column: work_schedules.deleted_at".
        if (! Schema::hasColumn('work_schedules', 'deleted_at')) {
            Schema::table('work_schedules', function (Blueprint $table) {
                $table->softDeletes();
            });
        }

        Schema::table('work_schedules', function (Blueprint $table) {
            if (! Schema::hasColumn('work_schedules', 'company_id')) {
                $table->foreignId('company_id')->nullable()->after('id')
                    ->constrained()->cascadeOnDelete();
            }
            if (! Schema::hasColumn('work_schedules', 'name')) {
                $table->string('name')->after('company_id');
            }
            if (! Schema::hasColumn('work_schedules', 'start_time')) {
                $table->time('start_time')->nullable();
            }
            if (! Schema::hasColumn('work_schedules', 'end_time')) {
                $table->time('end_time')->nullable();
            }
            if (! Schema::hasColumn('work_schedules', 'grace_period_minutes')) {
                $table->unsignedInteger('grace_period_minutes')->default(0);
            }
            if (! Schema::hasColumn('work_schedules', 'working_days')) {
                $table->json('working_days')->nullable();
            }
            if (! Schema::hasColumn('work_schedules', 'is_default')) {
                $table->boolean('is_default')->default(false);
            }
            if (! Schema::hasColumn('work_schedules', 'is_active')) {
                $table->boolean('is_active')->default(true);
            }
        });

        Schema::table('user_work_schedules', function (Blueprint $table) {
            if (! Schema::hasColumn('user_work_schedules', 'user_id')) {
                $table->foreignId('user_id')->after('id')
                    ->constrained()->cascadeOnDelete();
            }
            if (! Schema::hasColumn('user_work_schedules', 'work_schedule_id')) {
                $table->foreignId('work_schedule_id')->after('user_id')
                    ->constrained()->cascadeOnDelete();
            }
            if (! Schema::hasColumn('user_work_schedules', 'effective_date')) {
                $table->date('effective_date')->nullable();
            }
            if (! Schema::hasColumn('user_work_schedules', 'end_date')) {
                $table->date('end_date')->nullable();
            }
            if (! Schema::hasColumn('user_work_schedules', 'is_active')) {
                $table->boolean('is_active')->default(true);
            }
        });

        Schema::table('leave_types', function (Blueprint $table) {
            if (! Schema::hasColumn('leave_types', 'company_id')) {
                $table->foreignId('company_id')->nullable()->after('id')
                    ->constrained()->cascadeOnDelete();
            }
            if (! Schema::hasColumn('leave_types', 'name')) {
                $table->string('name')->after('company_id');
            }
            if (! Schema::hasColumn('leave_types', 'code')) {
                $table->string('code')->nullable();
            }
            if (! Schema::hasColumn('leave_types', 'description')) {
                $table->text('description')->nullable();
            }
            if (! Schema::hasColumn('leave_types', 'requires_approval')) {
                $table->boolean('requires_approval')->default(true);
            }
            if (! Schema::hasColumn('leave_types', 'is_paid')) {
                $table->boolean('is_paid')->default(true);
            }
            if (! Schema::hasColumn('leave_types', 'default_days_per_year')) {
                $table->unsignedInteger('default_days_per_year')->default(12);
            }
            if (! Schema::hasColumn('leave_types', 'is_active')) {
                $table->boolean('is_active')->default(true);
            }
        });

        Schema::table('leave_requests', function (Blueprint $table) {
            if (! Schema::hasColumn('leave_requests', 'user_id')) {
                $table->foreignId('user_id')->after('id')
                    ->constrained()->cascadeOnDelete();
            }
            if (! Schema::hasColumn('leave_requests', 'leave_type_id')) {
                $table->foreignId('leave_type_id')->after('user_id')
                    ->constrained()->cascadeOnDelete();
            }
            if (! Schema::hasColumn('leave_requests', 'start_date')) {
                $table->date('start_date');
            }
            if (! Schema::hasColumn('leave_requests', 'end_date')) {
                $table->date('end_date');
            }
            if (! Schema::hasColumn('leave_requests', 'total_days')) {
                $table->decimal('total_days', 5, 2)->default(0);
            }
            if (! Schema::hasColumn('leave_requests', 'reason')) {
                $table->text('reason')->nullable();
            }
            if (! Schema::hasColumn('leave_requests', 'status')) {
                $table->string('status')->default('pending');
            }
            if (! Schema::hasColumn('leave_requests', 'approved_by')) {
                $table->foreignId('approved_by')->nullable()
                    ->constrained('users')->nullOnDelete();
            }
            if (! Schema::hasColumn('leave_requests', 'approved_at')) {
                $table->timestamp('approved_at')->nullable();
            }
            if (! Schema::hasColumn('leave_requests', 'rejection_reason')) {
                $table->text('rejection_reason')->nullable();
            }
            if (! Schema::hasColumn('leave_requests', 'attachment')) {
                $table->string('attachment')->nullable();
            }
        });

        Schema::table('leave_balances', function (Blueprint $table) {
            if (! Schema::hasColumn('leave_balances', 'user_id')) {
                $table->foreignId('user_id')->after('id')
                    ->constrained()->cascadeOnDelete();
            }
            if (! Schema::hasColumn('leave_balances', 'leave_type_id')) {
                $table->foreignId('leave_type_id')->after('user_id')
                    ->constrained()->cascadeOnDelete();
            }
            if (! Schema::hasColumn('leave_balances', 'total_days')) {
                $table->decimal('total_days', 5, 2)->default(0);
            }
            if (! Schema::hasColumn('leave_balances', 'used_days')) {
                $table->decimal('used_days', 5, 2)->default(0);
            }
            if (! Schema::hasColumn('leave_balances', 'remaining_days')) {
                $table->decimal('remaining_days', 5, 2)->default(0);
            }
            if (! Schema::hasColumn('leave_balances', 'year')) {
                $table->unsignedSmallInteger('year');
            }
        });
    }

    public function down(): void
    {
        Schema::table('leave_balances', function (Blueprint $table) {
            $table->dropConstrainedForeignId('user_id');
            $table->dropConstrainedForeignId('leave_type_id');
            $table->dropColumn(['total_days', 'used_days', 'remaining_days', 'year']);
        });

        Schema::table('leave_requests', function (Blueprint $table) {
            $table->dropConstrainedForeignId('user_id');
            $table->dropConstrainedForeignId('leave_type_id');
            $table->dropConstrainedForeignId('approved_by');
            $table->dropColumn(['start_date', 'end_date', 'total_days', 'reason',
                'status', 'approved_at', 'rejection_reason', 'attachment']);
        });

        Schema::table('leave_types', function (Blueprint $table) {
            $table->dropConstrainedForeignId('company_id');
            $table->dropColumn(['name', 'code', 'description', 'requires_approval',
                'is_paid', 'default_days_per_year', 'is_active']);
        });

        Schema::table('user_work_schedules', function (Blueprint $table) {
            $table->dropConstrainedForeignId('user_id');
            $table->dropConstrainedForeignId('work_schedule_id');
            $table->dropColumn(['effective_date', 'end_date', 'is_active']);
        });

        Schema::table('work_schedules', function (Blueprint $table) {
            $table->dropConstrainedForeignId('company_id');
            $table->dropColumn(['name', 'start_time', 'end_time', 'grace_period_minutes',
                'working_days', 'is_default', 'is_active']);
        });
    }
};
