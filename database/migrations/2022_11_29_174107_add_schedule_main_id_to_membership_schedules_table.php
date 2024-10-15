<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddScheduleMainIdToMembershipSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('membership_schedules', function (Blueprint $table) {
            $table->unsignedBigInteger('schedule_main_id')->nullable();
            $table->foreign('schedule_main_id')->references('id')->on('schedule_mains');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('membership_schedules', function (Blueprint $table) {
            //
        });
    }
}
