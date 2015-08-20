<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFlagsToLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ssc_log', function (Blueprint $table) {
            $table->boolean('oe_flag')->after('non_equal_times')->default(0)->nullable();
            $table->boolean('bs_flag')->after('non_equal_times')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ssc_log', function (Blueprint $table) {
            
        });
    }
}
