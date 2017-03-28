<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_event', function (Blueprint $table) {

            $table->integer('schedule_id')->unsigned()->nullable();
            $table->foreign('schedule_id')->references('id')
                ->on('schedules')->onDelete('cascade');

            $table->integer('event_id')->unsigned()->nullable();
            $table->foreign('event_id')->references('id')
                ->on('events')->onDelete('cascade');

            $table->primary(['schedule_id', 'event_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedule_event');
    }
}
