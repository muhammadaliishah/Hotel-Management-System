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
        Schema::create('emp_loans', function (Blueprint $table) {
            $table->id('loanId');
            $table->unsignedBigInteger('emp_Id');
            $table->foreign('emp_Id')->references('emp_Id')->on('employees') ->onDelete('cascade');
            $table->decimal('transaction_amount', 8, 2);
            $table->string('payment_nature');
            $table->date('transaction_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emp_loans');
    }
};
