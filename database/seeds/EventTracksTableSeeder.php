<?php
use App\Repositories\Event\TrackRepository;
use Illuminate\Database\Seeder;

/**
 * @author       Lemberg Solution LAMP Team
 */
class EventTracksTableSeeder extends Seeder
{
    private $repository;

    public function __construct(TrackRepository $repository)
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
                'name' => 'Business',
            ],
            [
                'id'   => 2,
                'name' => 'Drupal Showcase',
            ],
            [
                'id'   => 3,
                'name' => 'Coding and Development',
            ],
            [
                'id'   => 4,
                'name' => 'Community Keynote',
            ],
            [
                'id'   => 5,
                'name' => 'Core Conversations',
            ],
            [
                'id'   => 6,
                'name' => 'DevOps',
            ],
            [
                'id'   => 7,
                'name' => 'Drupal.org',
            ],
            [
                'id'   => 8,
                'name' => 'Front End',
            ],
            [
                'id'   => 9,
                'name' => 'Horizons',
            ],
            [
                'id'   => 10,
                'name' => 'PHP',
            ],
            [
                'id'   => 11,
                'name' => 'Project Management',
            ],
            [
                'id'   => 12,
                'name' => 'Site Building',
            ],
            [
                'id'   => 13,
                'name' => 'Symfony',
            ],
            [
                'id'   => 14,
                'name' => 'UX',
            ],
        ];

        foreach ($data as $item) {
            $this->repository->create($item);
        }
    }
}