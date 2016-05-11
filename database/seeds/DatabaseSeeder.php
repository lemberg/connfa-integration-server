<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(SpeakersTableSeeder::class);
         $this->call(EventLevelsSeeder::class);
         $this->call(EventTypesSeeder::class);
         $this->call(EventTracksSeeder::class);
         $this->call(EventsSeeder::class);
    }
}
