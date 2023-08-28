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
        Schema::create('sub_ritems', function (Blueprint $table) {
            $table->id('subRItemId');
            $table->integer('mRItemId');
            $table->integer('sRItemId');
            $table->string('sRQuantity');
            $table->string('sRPrice');
            $table->date('expiryDate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_ritems');
    }
};
