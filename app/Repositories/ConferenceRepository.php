<?php

namespace App\Repositories;

use App\Models\Conference;

class ConferenceRepository extends BaseRepository
{

    public function model()
    {
        return Conference::class;
    }

}
