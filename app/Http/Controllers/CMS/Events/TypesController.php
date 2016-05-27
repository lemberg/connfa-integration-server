<?php

namespace App\Http\Controllers\CMS\Events;

use App\Http\Requests\TypeRequest;
use App\Repositories\Event\TypeRepository;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Controllers\CMS\BaseController;

class TypesController extends BaseController
{

    protected $viewsFolder = 'events.types';

    public function __construct(TypeRequest $request, TypeRepository $repository, ResponseFactory $response)
    {
        parent::__construct($request, $repository, $response);
    }

    public function store()
    {
        $this->repository->create($this->saveImage('icon'));

        return $this->redirectTo('index');
    }

    public function update($id)
    {
        $this->repository->updateRich($this->saveImage('icon'), $id);

        return $this->redirectTo('index');
    }

    public function destroy($id)
    {
        $repository = $this->repository->findOrFail($id);
        if ($image = $repository->icon) {
            $this->repository->deleteImage($image);
        }
        $this->repository->delete($id);

        return $this->redirectTo('index');
    }

    public function iconDelete($id)
    {
        $this->deleteImageAndCleanField($id, 'icon');

        return ['result' => true];
    }
}
