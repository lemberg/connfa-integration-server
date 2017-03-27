<?php

use Illuminate\Database\Seeder;

class FloorsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Floor::class, 3)->create();
    }
}
