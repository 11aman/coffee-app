<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->string('name');
            $table->string('mobile');
            $table->bigInteger('org_id')->unsigned();
            $table->foreign('org_id')->references('org_id')->on('organisations');
            $table->bigInteger('room_id')->unsigned();
            $table->foreign('room_id')->references('room_id')->on('rooms');
            $table->bigInteger('pantry_id')->unsigned();
            $table->foreign('pantry_id')->references('pantry_id')->on('pantries');
            $table->string('comment');
            $table->boolean('order_status')->default(0);
            $table->string('order_number');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->dateTime('deleted_at');

           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
