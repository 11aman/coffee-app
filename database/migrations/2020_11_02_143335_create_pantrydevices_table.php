<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

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
            $table->id('device_id');
            $table->string('device_name');
            $table->string('device_ip');
            $table->string('device_email');
            $table->bigInteger('pantry_id')->unsigned();
            $table->foreign('pantry_id')->references('pantry_id')->on('pantries');
            $table->boolean('status')->default(1);
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->dateTime('deleted_at')->default(Carbon::now());
            
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
