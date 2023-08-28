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
        Schema::create('receiveditems', function (Blueprint $table) {
            $table->id('rItemId');
            $table->integer('itemId');
            $table->decimal('rquantity', 8, 2);
            $table->decimal('rprice', 8, 2);
            $table->date('expiryDate');
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
        Schema::dropIfExists('receiveditems');
    }
};
