<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductToProductStocks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_stocks', function (Blueprint $table) {
            $table->unsignedInteger('product_id');

            //Configure foreign key
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_stocks', function (Blueprint $table) {
            $table->dropForeign('product_stocks_product_id_foreign');
            $table->dropColumn('product_id');
        });
    }
}
