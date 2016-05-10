<?php namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;
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
}
