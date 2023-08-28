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
        Schema::create('main_ritems', function (Blueprint $table) {
            $table->id('mainRItemId');
            $table->integer('poRMainId');
            $table->string('invoiceNumber');
            $table->string('invoiceImage');
            $table->boolean('deliveryStatus')->default(true);
            $table->date('receivedDate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('main_ritems');
    }
};
