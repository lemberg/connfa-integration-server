<?php

use App\Models\Conference;
use App\Repositories\Event\LevelRepository;
use Illuminate\Database\Seeder;

/**
 * @author       Lemberg Solution LAMP Team
 */
class EventLevelsTableSeeder extends Seeder
{
    private $repository;

    public function __construct(LevelRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $conference = Conference::first();
        $data = [
            [
                'id'   => 1,
                'name' => 'Beginner',
                'conference_id' => $conference->id
            ],
            [
                'id'   => 2,
                'name' => 'Intermediate',
                'conference_id' => $conference->id
            ],
            [
                'id'   => 3,
                'name' => 'Advanced',
                'conference_id' => $conference->id
            ]
        ];

        foreach ($data as $item) {
            $this->repository->create($item);
        }
    }
}