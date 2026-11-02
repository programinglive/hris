<?php

namespace Database\Seeders\Concerns;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Makes seeders safe to run on any supported driver.
 *
 * The seeders were written for SQLite: they ran `PRAGMA foreign_keys = OFF`
 * (a SQLite-only statement, a syntax error on PostgreSQL/MySQL) and used
 * `truncate()`, which a plain application role cannot run on PostgreSQL
 * because it requires TRUNCATE privilege and ignores row-level cascades.
 *
 * This trait disables foreign key checks with the driver's own mechanism and
 * empties tables with a plain DELETE inside a transaction, which works
 * everywhere.
 */
trait TruncatesTablesPortably
{
    protected function withoutForeignKeys(callable $callback): void
    {
        $driver = DB::connection()->getDriverName();

        switch ($driver) {
            case 'sqlite':
                DB::statement('PRAGMA foreign_keys = OFF');
                break;
            case 'pgsql':
                DB::statement('SET session_replication_role = replica');
                break;
            case 'mysql':
            case 'mariadb':
                DB::statement('SET FOREIGN_KEY_CHECKS=0');
                break;
        }

        try {
            $callback();
        } finally {
            switch ($driver) {
                case 'sqlite':
                    DB::statement('PRAGMA foreign_keys = ON');
                    break;
                case 'pgsql':
                    DB::statement('SET session_replication_role = origin');
                    break;
                case 'mysql':
                case 'mariadb':
                    DB::statement('SET FOREIGN_KEY_CHECKS=1');
                    break;
            }
        }
    }

    /**
     * Empty the given tables without truncate(), which needs elevated rights on
     * PostgreSQL.
     *
     * @param  array<int, string>  $tables
     */
    protected function clearTables(array $tables): void
    {
        foreach ($tables as $table) {
            if (Schema::hasTable($table)) {
                DB::table($table)->delete();
            }
        }
    }
}
