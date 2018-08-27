<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuggestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suggestions', function (Blueprint $table) {
            $table->increments('id');
            $table->text('content');
            $table->string('answer');
            $table->string('map');
            $table->unsignedInteger('station_id');
            $table->unsignedInteger('team_id')->nullable();
            $table->timestamps();

            $table->foreign('station_id')->references('id')->on('users');
            $table->foreign('team_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suggestions');
    }
}
