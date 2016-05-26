<?php

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;
use Carbon\Carbon;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BaseRepository extends Repository implements RepositoryInterface
{
    public $errors;

    public function model()
    {}

    /**
     * Find resource or throw NotFoundHttpException
     *
     * @param $id
     * @param array $columns
     * @throws NotFoundHttpException
     * @return mixed
     */
    public function findOrFail($id, $columns = ['*'])
    {
        $found = $this->find($id, $columns);

        if (!$found) {
            throw new NotFoundHttpException;
        }

        return $found;
    }

    /**
     * Find first resource or create new
     *
     * @param $params
     * @return mixed
     */
    public function firstOrNew($params)
    {
        return $this->model->firstOrNew($params);
    }

    /**
     * Check if resource was updated since $since param
     *
     * @param Carbon $since date from If-Modified-Since header
     * @param array $params
     * @return bool
     */
    public function checkLastUpdate($since, $params = [])
    {
        $data = $this->model->withTrashed();

        if ($since) {
            $data = $data->where('updated_at', '>=', $since->toDateTimeString());
        }

        if ($params) {
            $data = $data->where($params);
        }

        $data = $data->withTrashed()->first();

        if ($data) {
            return true;
        } else {
            return false;
        }
    }
}
