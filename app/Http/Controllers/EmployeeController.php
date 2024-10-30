<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\SimpleExcel\SimpleExcelWriter;

class EmployeeController extends Controller
{
    public function download(): void
    {
        $employees = User::select([
            'user_details.company_code',
            'user_details.branch_code',
            'user_details.nik',
            'users.name',
            'user_details.first_name',
            'user_details.last_name',
            'users.email',
            'user_details.date_in',
            'user_details.date_out',
            'user_details.department_code',
            'user_details.division_code',
            'user_details.sub_division_code',
            'user_details.level_code',
            'user_details.position_code',
        ])
            ->join('user_details', 'users.id', '=', 'user_details.user_id')
            ->where('users.name', '!=', 'admin')
            ->get();

        $writer = SimpleExcelWriter::streamDownload('all_employee_data.xlsx');

        foreach ($employees as $employee) {
            $employee['date_in'] = $employee['date_in'] != '' ? date('Y-m-d', strtotime($employee['date_in'])) : '';
            $employee['date_out'] = $employee['date_out'] != '' ? date('Y-m-d', strtotime($employee['date_out'])) : '';
            $writer
                ->addRow($employee->toArray());
        }

        $writer
            ->toBrowser();
    }
}