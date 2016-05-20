<?php

use App\Repositories\Event\TypeRepository;
use Illuminate\Database\Seeder;

class EventTypesTableSeeder extends Seeder
{
    private $repository;

    public function __construct(TypeRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Run the database seeds.
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

        foreach ($data as $item) {
            $this->repository->create($item);
        }
    }
}
