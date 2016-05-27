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
        $data = $this->request->all();
        if ($this->request->get('icon-switch') == 'file' AND $this->request->hasFile('image')) {
            $path = $this->repository->saveImage($this->request->file('image'), 'events/types');
            if (!$path) {
                return redirect()->back()->withError('Could not save image');
            }

            $data['icon'] = $path;
        }

        $this->repository->create($data);

        return $this->redirectTo('index');
    }

    public function update($id)
    {
        $data = $this->request->all();
        if ($this->request->get('icon-switch') == 'file' AND $this->request->hasFile('image')) {
            $path = $this->repository->saveImage($this->request->file('image'), 'events/types');
            if (!$path) {
                return redirect()->back()->withError('Could not save image');
            }

            $data['icon'] = $path;
        }

        $this->repository->updateRich($data, $id);

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
