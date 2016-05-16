<?php
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
        $data = [
            [
                'id'   => 1,
                'name' => 'Beginner',
            ],
            [
                'id'   => 2,
                'name' => 'Intermediate',
            ],
            [
                'id'   => 3,
                'name' => 'Advanced',
            ]
        ];

        foreach ($data as $item) {
            $this->repository->create($item);
        }
    }
}