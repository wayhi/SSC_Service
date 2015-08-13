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
            $table->string('type',20)->nullable();
            $table->timestamps('log_time')->nullable();
            $table->integer('src_record_id')->unsigned()->nullable();
            $table->tinyInteger('1_odd_repeat_times',3)->nullable();
            $table->tinyInteger('1_even_repeat_times',3)->nullable();
            $table->tinyInteger('1_big_repeat_times',3)->nullable();
            $table->tinyInteger('2_small_repeat_times',3)->nullable();
            $table->tinyInteger('2_odd_repeat_times',3)->nullable();
            $table->tinyInteger('2_even_repeat_times',3)->nullable();
            $table->tinyInteger('2_big_repeat_times',3)->nullable();
            $table->tinyInteger('2_small_repeat_times',3)->nullable();
            $table->tinyInteger('3_odd_repeat_times',3)->nullable();
            $table->tinyInteger('3_even_repeat_times',3)->nullable();
            $table->tinyInteger('3_big_repeat_times',3)->nullable();
            $table->tinyInteger('3_small_repeat_times',3)->nullable();
            $table->tinyInteger('4_odd_repeat_times',3)->nullable();
            $table->tinyInteger('4_even_repeat_times',3)->nullable();
            $table->tinyInteger('4_big_repeat_times',3)->nullable();
            $table->tinyInteger('4_small_repeat_times',3)->nullable();
            $table->tinyInteger('5_odd_repeat_times',3)->nullable();
            $table->tinyInteger('5_even_repeat_times',3)->nullable();
            $table->tinyInteger('5_big_repeat_times',3)->nullable();
            $table->tinyInteger('5_small_repeat_times',3)->nullable();
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
