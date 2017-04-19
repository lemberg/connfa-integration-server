<?php

use App\Models\Conference;
use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $conference = Conference::first();
        factory(App\Models\Page::class, 3)->create()->each(function ($page) use ($conference) {
            $page->conference_id = $conference->id;
            $page->save();
        });
    }
}
