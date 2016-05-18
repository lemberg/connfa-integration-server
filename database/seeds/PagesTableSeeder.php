<?php

use Illuminate\Database\Seeder;

/**
 * @author       Lemberg Solution LAMP Team
 */
class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        factory(App\Models\Page::class, 3)->create();
    }
}