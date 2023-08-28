<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeePayRoll extends Model
{
    use HasFactory;
    public $table='employee_payroll';
    protected $primaryKey='payroll_Id';
    protected $fillable = [
        'emp_Id',
        'loanId',
        'days_worked',
        'overtime_hrs_worked',
        'overtime_hrs_fare',
        'hours_late',
        'hours_late_deduction',
        'days_absent',
        'days_absent_deduction',
        'bonus_description',
        'bonus_amount',
        'loan_deduction',
        'estimated_month_salary',
        'salary_month',
        'salary_year'
    ];
}
