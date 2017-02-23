<?php

use App\Repositories\Event\TypeRepository;
use App\Models\Conference;
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
        $conference = Conference::first();
        $data = [
            [
                'id'   => 1,
                'name' => 'Speech',
                'conference_id' => $conference->id
            ],
            [
                'id'   => 2,
                'name' => 'Speech of day',
                'conference_id' => $conference->id
            ],
            [
                'id'   => 3,
                'name' => 'Coffee break',
                'conference_id' => $conference->id
            ],
            [
                'id'   => 4,
                'name' => 'Lunch',
                'conference_id' => $conference->id
            ],
            [
                'id'   => 5,
                'name' => '24h',
                'conference_id' => $conference->id
            ],
            [
                'id'   => 6,
                'name' => 'Group',
                'conference_id' => $conference->id
            ],
            [
                'id'   => 7,
                'name' => 'Walking',
                'conference_id' => $conference->id
            ],
            [
                'id'   => 8,
                'name' => 'Registration',
                'conference_id' => $conference->id
            ],
            [
                'id'   => 9,
                'name' => 'Free slot',
                'conference_id' => $conference->id
            ],
            [
                'id'   => 0,
                'name' => 'None',
                'conference_id' => $conference->id
            ],
        ];

        foreach ($data as $item) {
            $this->repository->create($item);
        }
    }
}
