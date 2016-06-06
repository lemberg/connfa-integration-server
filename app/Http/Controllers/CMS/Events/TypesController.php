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
        if ($this->request->get('icon-switch') == 'icon_file' AND $this->request->hasFile('icon_file')) {
            $path = $this->repository->saveImage($this->request->file('icon_file'), 'events/types');
            if (!$path) {
                return redirect()->back()->withError('Could not save image');
            }
        } else {
            $path = $this->request->get('icon_url');
        }

        $data['icon'] = $path;
        $this->repository->create($data);

        return $this->redirectTo('index');
    }

    public function update($id)
    {
        $data = $this->request->all();
        $path = array_get($data, 'icon');
        if (array_get($data, 'icon_delete')) {
            $this->repository->deleteImage($data['icon_delete']);
            $path = '';
        }

        if ($this->request->get('icon-switch') == 'icon_file' AND $this->request->hasFile('icon_file')) {
            $path = $this->repository->saveImage($this->request->file('icon_file'), 'events/types');
            if (!$path) {
                return redirect()->back()->withError('Could not save image');
            }
        } elseif ($this->request->get('icon_url') && !array_get($data, 'icon_delete')) {
            $path = $this->request->get('icon_url');
        }

        $data['icon'] = $path;
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
}
