<?php

namespace App\Repositories;

use App\Models\Conference;

class ConferenceRepository extends BaseRepository
{

    public function model()
    {
        return Conference::class;
    }

    /**
     * Get conference info by alias
     *
     * @param string $alias
     * @return mixed
     */
    public function getByAlias($alias)
    {
        return $this->model->where('alias', '=', $alias)->firstOrFail();
    }
    /**
     * Get all ordered by name
     *
     * @return mixed
     */
    public function getAllOrderedByName()
    {
        return $this->model->orderBy('name', 'asc')->get();
    }


}
