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
        Schema::create('cashflow', function (Blueprint $table) {
            $table->id('cashflowId');
            $table->unsignedBigInteger('cf_catId');
            $table->foreign('cf_catId')->references('cf_catId')->on('cf_categories') ->onDelete('cascade');
            $table->string('cfdetails');
            $table->decimal('cfexpense', 8, 2);
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
        Schema::dropIfExists('cashflow');
    }
};
