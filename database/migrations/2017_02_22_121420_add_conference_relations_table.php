<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConferenceRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table
                ->integer('conference_id')
                ->unsigned()
                ->default(null)
                ->nullable()
                ->foreign('conference_id')
                ->references('id')
                ->on('conferences')
                ->onDelete('cascade');
        });

        Schema::table('event_types', function (Blueprint $table) {
            $table
                ->integer('conference_id')
                ->unsigned()
                ->default(null)
                ->nullable()
                ->foreign('conference_id')
                ->references('id')
                ->on('conferences')
                ->onDelete('cascade');
        });

        Schema::table('event_levels', function (Blueprint $table) {
            $table
                ->integer('conference_id')
                ->unsigned()
                ->default(null)
                ->nullable()
                ->foreign('conference_id')
                ->references('id')
                ->on('conferences')
                ->onDelete('cascade');
        });

        Schema::table('event_tracks', function (Blueprint $table) {
            $table
                ->integer('conference_id')
                ->unsigned()
                ->default(null)
                ->nullable()
                ->foreign('conference_id')
                ->references('id')
                ->on('conferences')
                ->onDelete('cascade');
        });

        Schema::table('events', function (Blueprint $table) {
            $table
                ->integer('conference_id')
                ->unsigned()
                ->default(null)
                ->nullable()
                ->foreign('conference_id')
                ->references('id')
                ->on('conferences')
                ->onDelete('cascade');
        });

        Schema::table('speakers', function (Blueprint $table) {
            $table
                ->integer('conference_id')
                ->unsigned()
                ->default(null)
                ->nullable()
                ->foreign('conference_id')
                ->references('id')
                ->on('conferences')
                ->onDelete('cascade');
        });

        Schema::table('floors', function (Blueprint $table) {
            $table
                ->integer('conference_id')
                ->unsigned()
                ->default(null)
                ->nullable()
                ->foreign('conference_id')
                ->references('id')
                ->on('conferences')
                ->onDelete('cascade');
        });

        Schema::table('pages', function (Blueprint $table) {
            $table
                ->integer('conference_id')
                ->unsigned()
                ->default(null)
                ->nullable()
                ->foreign('conference_id')
                ->references('id')
                ->on('conferences')
                ->onDelete('cascade');
        });

        Schema::table('locations', function (Blueprint $table) {
            $table
                ->integer('conference_id')
                ->unsigned()
                ->default(null)
                ->nullable()
                ->foreign('conference_id')
                ->references('id')
                ->on('conferences')
                ->onDelete('cascade');
        });

        Schema::table('points', function (Blueprint $table) {
            $table
                ->integer('conference_id')
                ->unsigned()
                ->default(null)
                ->nullable()
                ->foreign('conference_id')
                ->references('id')
                ->on('conferences')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('conference_id');
        });

        Schema::table('event_types', function (Blueprint $table) {
            $table->dropColumn('conference_id');
        });

        Schema::table('event_levels', function (Blueprint $table) {
            $table->dropColumn('conference_id');
        });

        Schema::table('event_tracks', function (Blueprint $table) {
            $table->dropColumn('conference_id');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('conference_id');
        });

        Schema::table('floors', function (Blueprint $table) {
            $table->dropColumn('conference_id');
        });

        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('conference_id');
        });

        Schema::table('locations', function (Blueprint $table) {
            $table->dropColumn('conference_id');
        });

        Schema::table('points', function (Blueprint $table) {
            $table->dropColumn('conference_id');
        });
    }
}
