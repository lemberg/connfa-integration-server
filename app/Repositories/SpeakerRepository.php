<?php namespace App\Repositories;

use App\Models\Role;
use App\Models\Speaker;


class SpeakerRepository extends BaseRepository
{

    public function model()
    {
        return 'App\Models\Speaker';
    }

    public function getSpeakersWithDeleted($since = false)
    {
        if ($since) {
            return Speaker::withTrashed()->where('updated_at', '>=', $since->toDateTimeString())->get();
        }

        return Speaker::withTrashed()->get();
    }
}
