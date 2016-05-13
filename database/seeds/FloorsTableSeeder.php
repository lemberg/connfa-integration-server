<?php
/**
 * @author       Lemberg Solution LAMP Team
 */

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
        factory(App\Models\Floor::class, 3)->create();
    }
}