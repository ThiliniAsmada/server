<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('guide_id')->unsigned();
            $table->integer('tourist_id')->unsigned();
            $table->string('tour_type');
            $table->string('place');
            $table->string('date');
            $table->integer('No_of_days');
            $table->string('status')->nullable();
            $table->foreign('tourist_id')->references('id')->on('tourists');
            $table->foreign('guide_id')->references('id')->on('guides');
            $table->string("guide_rating")->nullable();
            $table->string("tourist_rating")->nullable();
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
        Schema::dropIfExists('tours');
    }
}
