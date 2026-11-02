# Migration notes — `2026_11_02_000000_align_schema_with_models`

## What it does

Brings the database in line with what the code already assumes. Background:
commit `babff7f` (5 April 2025) removed the `add_primary_company_id_to_users_table`
migration and moved company membership into `user_details`, but the column there
was left named `primary_company_id` while 197 call sites use `company_id`. Five
HR modules were scaffolded as empty tables (`id` + timestamps) while their models
declared full `$fillable` sets.

## Changes

| Table | Change | Reversible |
|---|---|---|
| `user_details` | `primary_company_id` → `company_id` | **No — manual only** |
| `brands` | + `branch_id` | yes |
| `departments`, `divisions`, `sub_divisions` | + `manager_id` | yes |
| `roles` | + `display_name`, `is_system` | yes |
| `work_schedules` | + `company_id`, `name`, `start_time`, `end_time`, `grace_period_minutes`, `working_days`, `is_default`, `is_active`, `deleted_at` | yes |
| `user_work_schedules` | + `user_id`, `work_schedule_id`, `effective_date`, `end_date`, `is_active` | yes |
| `leave_types` | + `company_id`, `name`, `code`, `description`, `requires_approval`, `is_paid`, `default_days_per_year`, `is_active` | yes |
| `leave_requests` | + `user_id`, `leave_type_id`, `start_date`, `end_date`, `total_days`, `reason`, `status`, `approved_by`, `approved_at`, `rejection_reason`, `attachment` | yes |
| `leave_balances` | + `user_id`, `leave_type_id`, `total_days`, `used_days`, `remaining_days`, `year` | yes |

Every step is guarded with `Schema::hasColumn()`, so the migration is safe on a
database that already has some of these columns.

## The rename is the only irreversible step

`down()` deliberately does **not** rename `company_id` back to
`primary_company_id`. Reverting it would make every seeder and controller wrong
again, and the pre-migration column was not equivalent anyway (nullable, and
constrained differently).

If you ever need to revert it by hand:

```sql
ALTER TABLE user_details CHANGE company_id primary_company_id BIGINT UNSIGNED NULL;
```

Do that only together with a code revert. Nothing in this repository reads the
old name any more.

## Before running on production

1. **Back up.** There is a nightly cron (`backup_db.sh`, 02:00), but take a
   manual dump immediately before.
2. **Dry run** to see the generated SQL:
   ```bash
   php artisan migrate --pretend
   ```
3. **Rehearse** on a copy:
   ```bash
   mysql -u user -p db_copy < backup.sql
   DB_DATABASE=db_copy php artisan migrate --force
   ```
4. **Check for external readers of the old column name.** Nothing inside this
   repo uses `primary_company_id` after the migration, but code outside the repo
   (other services, BI jobs, manual SQL) could.

## Verification performed

Run against a throwaway SQLite database:

| Step | Result |
|---|---|
| `migrate` from scratch | 30 migrations, alignment migration DONE |
| Re-running `up()` on an aligned database | OK (idempotent) |
| `migrate:rollback --step=1` | all added columns removed, nothing left behind |
| `migrate` again after rollback | DONE |

The earlier version of `down()` was incomplete — it removed the new columns for
the HR tables but left `branch_id`, `manager_id`, `display_name`, `is_system` and
`deleted_at` behind. That is fixed and covered by the round-trip check above.
