<?php

namespace App\Repositories;

use App\Models\Page;

class PageRepository extends BaseRepository
{

    public function model()
    {
        return 'App\Models\Page';
    }

    public function getPagesWithDeleted($since = false)
    {
        if ($since) {
            return Page::withTrashed()->where('updated_at', '>=', $since->toDateTimeString())->get();
        }

        return Page::withTrashed()->get();
    }
}
