<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operator_games', function (Blueprint $table) {
            $table->integer('operator')->unsigned()->index();
            $table->integer('game_id')->unsigned();
            $table->string('game_name');
            $table->string('game_day');
            $table->integer('day_id')->index();
            $table->string('start_time');
            $table->string('end_time');
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
        Schema::dropIfExists('operator_games');
    }
};
