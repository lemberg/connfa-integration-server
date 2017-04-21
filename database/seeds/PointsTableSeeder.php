<?php

use App\Models\Conference;
use Illuminate\Database\Seeder;

class PointsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $conference = Conference::first();
        factory(App\Models\Point::class, 5)->create()->each(function ($point) use ($conference) {
            $point->conference_id = $conference->id;
            $point->save();
        });
    }
}
