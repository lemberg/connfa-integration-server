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
        $this->call(ConferencesTableSeeder::class);
        $this->call(SpeakersTableSeeder::class);
        $this->call(EventLevelsTableSeeder::class);
        $this->call(EventTypesTableSeeder::class);
        $this->call(EventTracksTableSeeder::class);
        $this->call(EventsTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(FloorsTableSeeder::class);
        $this->call(PagesTableSeeder::class);
        $this->call(LocationsTableSeeder::class);
        $this->call(PointsTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(SchedulesTableSeeder::class);
    }
}
