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
        Schema::create('po_bills', function (Blueprint $table) {
            $table->id('bill_Id');
            $table->unsignedBigInteger('invoice_Id');
            // $table->foreign('invoice_Id')->references('mainRItemId')->on('main_ritems') ->onDelete('cascade');
            $table->decimal('bill_paid', 8, 2);
            $table->string('bill_details');
            $table->date('payment_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('po_bills');
    }
};
