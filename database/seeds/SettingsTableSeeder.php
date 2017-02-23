<?php

use App\Models\Conference;
use App\Repositories\SettingsRepository;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{

    /**
     * @var SettingsRepository
     */
    private $repository;

    /**
     * SettingsTableSeeder constructor.
     * @param SettingsRepository $repository
     */
    public function __construct(SettingsRepository $repository)
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
        /*Setting::set('titleMajor', 'Barcelona');
        Setting::set('titleMinor', 'Drupalcon 2015');
        Setting::set('twitterSearchQuery', '#drupalcon');
        Setting::set('timezone', 'Europe/Kiev');*/

        $conference = Conference::first();
        $data = [
            [
                'id' => 1,
                'key' => 'titleMajor',
                'value' => 'Barcelona',
                'conference_id' => $conference->id
            ],
            [
                'id' => 2,
                'key' => 'titleMinor',
                'value' => 'Drupalcon 2015',
                'conference_id' => $conference->id
            ],
            [
                'id' => 3,
                'key' => 'twitterSearchQuery',
                'value' => '#drupalcon',
                'conference_id' => $conference->id
            ],
            [
                'id' => 4,
                'key' => 'timezone',
                'value' => 'Europe/Kiev',
                'conference_id' => $conference->id
            ]
        ];

        foreach ($data as $item) {
            $this->repository->create($item);
        }
        Setting::save();
    }
}
