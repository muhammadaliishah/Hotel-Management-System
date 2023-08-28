<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_payroll', function (Blueprint $table) {
            $table->id('payroll_Id');
            $table->unsignedBigInteger('emp_Id');
            $table->foreign('emp_Id')->references('emp_Id')->on('employees') ->onDelete('cascade');
            $table->unsignedBigInteger('loanId');
            $table->decimal('days_worked', 8, 2);
            $table->decimal('overtime_hrs_worked', 8, 2);
            $table->decimal('overtime_hrs_fare', 8, 2);
            $table->decimal('hours_late', 8, 2);
            $table->decimal('hours_late_deduction', 8, 2);
            $table->decimal('days_absent', 8, 2);
            $table->decimal('days_absent_deduction', 8, 2);
            $table->string('bonus_description');
            $table->decimal('bonus_amount', 8, 2);
            $table->decimal('loan_deduction', 8, 2);
            $table->decimal('estimated_month_salary', 8, 2);
            $table->integer('salary_month');
            $table->integer('salary_year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_payroll');
    }
};
