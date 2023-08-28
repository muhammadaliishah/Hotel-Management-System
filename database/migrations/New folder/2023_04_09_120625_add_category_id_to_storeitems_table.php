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
        Schema::table('storeitems', function (Blueprint $table) {
            $table->unsignedBigInteger('categoryId');
            $table->foreign('categoryId')->references('categoryId')->on('itemcategories') ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('storeitems', function (Blueprint $table) {
            $table->dropColumn('categoryId');
        });
    }
};
