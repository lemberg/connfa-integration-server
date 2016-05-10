<?php namespace App\Repositories;

use App\Models\Role;
use app\Models\Speaker;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
