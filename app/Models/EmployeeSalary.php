<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeSalary extends Model
{
    use HasFactory;
    public $table='emp_salaries';
    protected $primaryKey='salaryId';
    public $timestamps = false;
    protected $fillable = [
        'emp_Id',
        'monthly_salary',
        'salary_status'
    ];
}
