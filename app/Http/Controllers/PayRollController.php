<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use App\Models\EmployeePay;
use App\Models\EmployeePosition;
use App\Models\EmployeePayRoll;
use App\Models\EmployeeTransaction;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PayRollController extends Controller
{
    public function index(Request $request)
    {
    $data = Employee::select(
    'employees.emp_fname',
    'employees.emp_lname',
    'employees.emp_gen',
    'employees.emp_contact',
    'employees.emp_address',
    'employees.emp_status',
    'employees.joining_date',
    'employees.leaving_date',
    'employee_positions.pos_status',
    DB::raw("CASE WHEN employee_positions.pos_status = 1 THEN CONCAT(employee_positions.pos_type, ' ', employee_positions.pos_name) END AS positionName"),
    DB::raw("CASE WHEN emp_salaries.salary_status = 1 THEN emp_salaries.monthly_salary END AS monthlySalary"),
    DB::raw("COALESCE(SUM(CASE WHEN emp_loans.payment_nature = 'Addition' THEN emp_loans.transaction_amount END), 0) AS loan_taken"),
    DB::raw("COALESCE(SUM(CASE WHEN emp_loans.payment_nature != 'Addition' THEN emp_loans.transaction_amount END), 0) AS loan_returned")
)->where('emp_salaries.salary_status','=',1)
    ->leftJoin('employee_positions', 'employees.pos_id', '=', 'employee_positions.pos_id')
    ->leftJoin('emp_salaries', 'employees.emp_Id', '=', 'emp_salaries.emp_Id')
    ->leftJoin('emp_loans', 'employees.emp_Id', '=', 'emp_loans.emp_Id')
    ->groupBy(
        'employees.emp_fname',
        'employees.emp_lname',
        'employees.emp_gen',
        'employees.emp_contact',
        'employees.emp_address',
        'employees.emp_status',
        'employees.joining_date',
        'employees.leaving_date',
        'employee_positions.pos_status',
        'employee_positions.pos_type',
        'employee_positions.pos_name',
        'emp_salaries.monthly_salary',
        'emp_salaries.salary_status'
    );
    if ($request->search) {
            $data = $data->where('emp_fname', 'LIKE', "%{$request->search}%");
        }
        $data = $data->paginate(10);
        return view('payroll.index',['data'=>$data]);
    }
}
