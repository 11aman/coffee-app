<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');
            $table->string('product_name');
            $table->string('product_img')->default(1);
            $table->text('product_description');
            $table->integer('product_qty');
            $table->boolean('product_status')->default(1);
            $table->bigInteger('org_id')->unsigned();
            $table->foreign('org_id')->references('org_id')->on('organisations');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->dateTime('deleted_at')->nullable();
<<<<<<< HEAD

=======
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
        Schema::dropIfExists('products');
    }
}
