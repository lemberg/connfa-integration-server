<?php

use Illuminate\Database\Seeder;
use App\Models\Conference;

class SpeakersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $conference = Conference::first();
        factory(App\Models\Speaker::class, 50)->create()->each(function ($speaker) use ($conference) {
            $speaker->conference_id = $conference->id;
            $speaker->save();
        });
    }
}
