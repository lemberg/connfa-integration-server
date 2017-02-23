<?php

use App\Models\Conference;
use Illuminate\Database\Seeder;

class FloorTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $conference = Conference::first();
        factory(App\Models\Floor::class, 3)->create()->each(function ($floor) use ($conference) {
            $floor->conference_id = $conference->id;
            $floor->save();
        });
    }
}
