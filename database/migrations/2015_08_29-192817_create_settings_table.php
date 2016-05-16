<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SettingsTable extends Migration
{
    /**
     * Table name
     */
    private $table;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->table = config('settings.table');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->table, function(Blueprint $table)
		{
		    $table->increments('id');

            $table->string('group');
            $table->string('key')->unique()->index();
            $table->string('value')->nullable();

            $table->softDeletes()->nullable()->default(null);
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
        Schema::drop($this->table);
    }
}

