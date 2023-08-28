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
        Schema::create('emp_salaries', function (Blueprint $table) {
            $table->id('salaryId');
            $table->unsignedBigInteger('emp_Id');
            $table->foreign('emp_Id')->references('emp_Id')->on('employees') ->onDelete('cascade');
            $table->decimal('monthly_salary', 8, 2);
            $table->boolean('salary_status')->default(true);
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
        Schema::dropIfExists('emp_salaries');
    }
};
