<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public $defaultProductImgUrl = "http://localhost:8000/public/assets/images/product.png";

    public function up()
    {
        Schema::create('product_stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('total_stock');
            $table->double('regular_price');
            $table->double('sale_price')->nullable(true);
            $table->string('image_url')->default($this->defaultProductImgUrl);
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
        Schema::dropIfExists('product_stocks');
    }
}
