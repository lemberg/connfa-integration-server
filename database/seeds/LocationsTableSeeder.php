<?php

use App\Models\Conference;
use Illuminate\Database\Seeder;

class LocationsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $conference = Conference::first();
        factory(App\Models\Location::class, 1)->create()->each(function ($location) use ($conference) {
            $location->conference_id = $conference->id;
            $location->save();
        });
    }
}
