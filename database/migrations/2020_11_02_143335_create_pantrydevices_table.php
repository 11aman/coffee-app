<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePantrydevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pantrydevices', function (Blueprint $table) {
            $table->id('device_id')->unsigned();
            $table->string('device_name');
            $table->string('device_ip');
            $table->string('device_email');
            $table->bigInteger('pantry_id')->unsigned();
            $table->foreign('pantry_id')->references('pantry_id')->on('pantries');
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('pantrydevices');
    }
}
