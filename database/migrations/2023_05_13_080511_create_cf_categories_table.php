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
        Schema::create('cf_categories', function (Blueprint $table) {
            $table->id('cf_catId');
            $table->string('cf_catName');
            $table->string('cf_catDetail');
            $table->integer('cf_catParent');
            $table->string('cf_catAbb');
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
        Schema::dropIfExists('cf_categories');
    }
};
