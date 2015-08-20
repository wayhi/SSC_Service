<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSscBallLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ssc_ball_log', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type',20);
            $table->datetime('log_time')->nullable();
            $table->integer('src_record_id')->unsigned()->unsigned()->nullable();
            $table->tinyInteger('odd_repeat_times_1')->unsigned()->nullable();
            $table->tinyInteger('even_repeat_times_1')->unsigned()->nullable();
            $table->tinyInteger('big_repeat_times_1')->unsigned()->nullable();
            $table->tinyInteger('small_repeat_times_1')->unsigned()->nullable();
            $table->tinyInteger('odd_repeat_times_2')->unsigned()->nullable();
            $table->tinyInteger('even_repeat_times_2')->unsigned()->nullable();
            $table->tinyInteger('big_repeat_times_2')->unsigned()->nullable();
            $table->tinyInteger('small_repeat_times_2')->unsigned()->nullable();
            $table->tinyInteger('odd_repeat_times_3')->unsigned()->nullable();
            $table->tinyInteger('even_repeat_times_3')->unsigned()->nullable();
            $table->tinyInteger('big_repeat_times_3')->unsigned()->nullable();
            $table->tinyInteger('small_repeat_times_3')->unsigned()->nullable();
            $table->tinyInteger('odd_repeat_times_4')->unsigned()->nullable();
            $table->tinyInteger('even_repeat_times_4')->unsigned()->nullable();
            $table->tinyInteger('big_repeat_times_4')->unsigned()->nullable();
            $table->tinyInteger('small_repeat_times_4')->unsigned()->nullable();
            $table->tinyInteger('odd_repeat_times_5')->unsigned()->nullable();
            $table->tinyInteger('even_repeat_times_5')->unsigned()->nullable();
            $table->tinyInteger('big_repeat_times_5')->unsigned()->nullable();
            $table->tinyInteger('small_repeat_times_5')->unsigned()->nullable();
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
        Schema::drop('ssc_ball_log');
    }
}
