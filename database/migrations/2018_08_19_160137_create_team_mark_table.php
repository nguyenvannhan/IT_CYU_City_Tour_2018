<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamMarkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_marks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('team_id');
            $table->unsignedInteger('station_id');
            $table->unsignedInteger('criteria_id');
            $table->integer('mark')->default(0);
            $table->string('note')->nullable();
            $table->timestamps();

            $table->foreign('team_id')->references('id')->on('users');
            $table->foreign('station_id')->references('id')->on('users');
            $table->foreign('criteria_id')->references('id')->on('mark_criterias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('team_marks');
    }
}
