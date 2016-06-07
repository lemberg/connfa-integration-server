<?php

namespace App\Repositories;

use App\Models\Page;

class PageRepository extends BaseRepository
{

    public function model()
    {
        return Page::class;
    }

    /**
     * Get pages with deleted since $since param if passed
     *
     * @param string|bool $since
     * @return mixed
     */
    public function getPagesWithDeleted($since = false)
    {
        if ($since) {
            return $this->model->withTrashed()->where('updated_at', '>=', $since->toDateTimeString())->get();
        }

        return $this->model->withTrashed()->get();
    }
}
