<?php

namespace App\Repositories;

use App\Models\Speaker;

class SpeakerRepository extends BaseRepository
{

    public function model()
    {
        return Speaker::class;
    }

    public function getSpeakersWithDeleted($since = false)
    {
        if ($since) {
            return $this->model->withTrashed()->where('updated_at', '>=', $since->toDateTimeString())->get();
        }

        return $this->model->withTrashed()->get();
    }
}
