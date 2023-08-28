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
        Schema::create('employees', function (Blueprint $table) {
            $table->id('emp_Id');
            $table->string('emp_fname');
            $table->string('emp_lname');
            $table->string('emp_gen');
            $table->string('emp_contact');
            $table->unsignedBigInteger('pos_id');
            $table->foreign('pos_id')->references('pos_id')->on('employee_positions') ->onDelete('cascade');
            $table->text('emp_address');
            $table->boolean('emp_status')->default(true);
            $table->date('joining_date');
            $table->date('leaving_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
