<?php

use Illuminate\Database\Seeder;

class ConferencesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Conference::class, 1)->create();
    }
}
