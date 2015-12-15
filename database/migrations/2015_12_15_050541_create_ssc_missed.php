<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSscMissed extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ssc_number_missed', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type',20);
            $table->datetime('log_time')->nullable();
            $table->integer('src_record_id')->unsigned()->unsigned()->nullable();
            $table->tinyInteger('period')->unsigned()->nullable();
            $table->tinyInteger('missed_times_0')->unsigned()->nullable();
            $table->tinyInteger('missed_times_1')->unsigned()->nullable();
            $table->tinyInteger('missed_times_2')->unsigned()->nullable();
            $table->tinyInteger('missed_times_3')->unsigned()->nullable();
            $table->tinyInteger('missed_times_4')->unsigned()->nullable();
            $table->tinyInteger('missed_times_5')->unsigned()->nullable();
            $table->tinyInteger('missed_times_6')->unsigned()->nullable();
            $table->tinyInteger('missed_times_7')->unsigned()->nullable();
            $table->tinyInteger('missed_times_8')->unsigned()->nullable();
            $table->tinyInteger('missed_times_9')->unsigned()->nullable();
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
        //
    }
}
