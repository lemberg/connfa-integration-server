<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('start_at');
            $table->dateTime('end_at');
            $table->text('text');
            $table->string('name');
            $table->string('place')->nullable();
            $table->string('version')->nullable();
            $table->integer('level_id')->nullable()->unsigned();
            $table->integer('type_id')->nullable()->unsigned();
            $table->integer('track_id')->nullable()->unsigned();
            $table->string('url');
            $table->enum('event_type', ['session', 'bof', 'social']);
            $table->softDeletes()->nullable()->default(null);
            $table->timestamps();
        });

        Schema::create('event_speaker', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('event_id')
                ->unsigned()
                ->index('event_id')
                ->foreign('event_id')
                ->references('id')
                ->on('events')
                ->onDelete('cascade');
            $table->integer('speaker_id')
                ->unsigned()
                ->index('speaker_id')
                ->foreign('speaker_id')
                ->references('id')
                ->on('speakers')
                ->onDelete('cascade');
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
        Schema::dropIfExists('events');
        Schema::dropIfExists('event_speaker');
    }
}
