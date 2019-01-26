<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeatherStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weather_status', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('city_id');
            $table->double('temp_celsius');
            $table->string('status');
            $table->string('provider');
            $table->timestamp('last_update');
            $table->timestamps();
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weather_status');
    }
}
