<?php
use App\Models\Event\Type;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

/**
 * @author       Lemberg Solution LAMP Team
 */
class EventTypesSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id'   => 1,
                'name' => 'Speech',
            ],
            [
                'id'   => 2,
                'name' => 'Speech of day',
            ],
            [
                'id'   => 3,
                'name' => 'Coffee break',
            ],
            [
                'id'   => 4,
                'name' => 'Lunch',
            ],
            [
                'id'   => 5,
                'name' => '24h',
            ],
            [
                'id'   => 6,
                'name' => 'Group',
            ],
            [
                'id'   => 7,
                'name' => 'Walking',
            ],
            [
                'id'   => 8,
                'name' => 'Registration',
            ],
            [
                'id'   => 9,
                'name' => 'Free slot',
            ],
            [
                'id'   => 0,
                'name' => 'None',
            ],
        ];

        Model::unguard();
        foreach ($data as $item) {
            Type::create($item);
        }
//        Model::reguard();
    }
}