<?php

namespace App\Repositories\Event;

use App\Models\Event\Type;
use App\Repositories\BaseRepository;

class TypeRepository extends BaseRepository
{
    public function model()
    {
        return Type::class;
    }

    public function getTypesWithDeleted($since = false)
    {
        if ($since) {
            return $this->model->withTrashed()->where('updated_at', '>=', $since->toDateTimeString())->get();
        }

        return $this->model->withTrashed()->get();
    }
}
