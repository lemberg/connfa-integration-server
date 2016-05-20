<?php

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;
use Carbon\Carbon;
use Illuminate\Container\Container as App;

class BaseRepository extends Repository implements RepositoryInterface
{

    public $errors;

    public function model()
    {}

    public function findOrFail($id, $columns = ['*'])
    {
        $found = $this->find($id, $columns);

        if (!$found) {
            abort(404);
        }

        return $found;
    }

    public function firstOrNew($params)
    {
        return $this->model->firstOrNew($params);
    }

    /**
     * @param Carbon $since date from If-Modified-Since header
     * @param array $params
     * @return bool
     */
    public function checkLastUpdate($since, $params = [])
    {
        $data = $this->model;

        if ($since) {
            $data = $data->where('updated_at', '>=', $since->toDateTimeString());
        }

        if ($params) {
            $data = $data->where($params);
        }

        $data = $data->first();

        if ($data) {
            return true;
        } else {
            return false;
        }
    }
}
