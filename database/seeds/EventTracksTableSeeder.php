<?php

use App\Repositories\Event\TrackRepository;
use App\Models\Conference;
use Illuminate\Database\Seeder;

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
        $conference = Conference::first();
        $data = [
            [
                'id'   => 1,
                'name' => 'Business',
                'conference_id' => $conference->id
            ],
            [
                'id'   => 2,
                'name' => 'Drupal Showcase',
                'conference_id' => $conference->id
            ],
            [
                'id'   => 3,
                'name' => 'Coding and Development',
                'conference_id' => $conference->id
            ],
            [
                'id'   => 4,
                'name' => 'Community Keynote',
                'conference_id' => $conference->id
            ],
            [
                'id'   => 5,
                'name' => 'Core Conversations',
                'conference_id' => $conference->id
            ],
            [
                'id'   => 6,
                'name' => 'DevOps',
                'conference_id' => $conference->id
            ],
            [
                'id'   => 7,
                'name' => 'Drupal.org',
                'conference_id' => $conference->id
            ],
            [
                'id'   => 8,
                'name' => 'Front End',
                'conference_id' => $conference->id
            ],
            [
                'id'   => 9,
                'name' => 'Horizons',
                'conference_id' => $conference->id
            ],
            [
                'id'   => 10,
                'name' => 'PHP',
                'conference_id' => $conference->id
            ],
            [
                'id'   => 11,
                'name' => 'Project Management',
                'conference_id' => $conference->id
            ],
            [
                'id'   => 12,
                'name' => 'Site Building',
                'conference_id' => $conference->id
            ],
            [
                'id'   => 13,
                'name' => 'Symfony',
                'conference_id' => $conference->id
            ],
            [
                'id'   => 14,
                'name' => 'UX',
                'conference_id' => $conference->id
            ],
        ];

        foreach ($data as $item) {
            $this->repository->create($item);
        }
    }
}
