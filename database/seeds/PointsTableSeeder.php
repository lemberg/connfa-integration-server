<?php
/**
 * @author       Lemberg Solution LAMP Team
 */

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
        factory(App\Models\Point::class, 5)->create();
    }
}