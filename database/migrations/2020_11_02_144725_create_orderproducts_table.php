<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CreateOrderproductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderproducts', function (Blueprint $table) {
            $table->id('order_product_id');
            $table->bigInteger('order_id')->unsigned();
            $table->foreign('order_id')->references('order_id')->on('orders');
            $table->bigInteger('product_id')->unsigned();
            $table->foreign('product_id')->references('product_id')->on('products');
            $table->string('product_name');
            $table->integer('product_qty');
            $table->string('product_comment');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
<<<<<<< HEAD
            $table->dateTime('deleted_at')->nullable();
=======
          $table->dateTime('deleted_at')->nullable();
>>>>>>> ce782fe335ac299d7c6f2da54f44790543496fbd

           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orderproducts');
    }
}
