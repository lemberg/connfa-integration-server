<?php

namespace App\Http\Controllers\CMS;

use App\Http\Requests\FloorRequest;
use App\Repositories\FloorRepository;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Controllers\CMS\BaseController;

class FloorsController extends BaseController
{
    public function __construct(FloorRequest $request, FloorRepository $repository, ResponseFactory $response)
    {
        parent::__construct($request, $repository, $response);
    }

    public function store()
    {
        $data = $this->request->all();
        if ($this->request->get('image-switch') == 'image_file' and $this->request->hasFile('image_file')) {
            $path = $this->repository->saveImage($this->request->file('image_file'), $this->getViewsFolder());
            if (!$path) {
                return redirect()->back()->withError('Could not save image');
            }
        }else{
            $path = $this->request->get('image_url');
        }

        $data['image'] = $path;
        $this->repository->create($data);

        return $this->redirectTo('index');
    }

    public function update($id)
    {
        $data = $this->request->all();
        $path = array_get($data, 'image');
        if (array_get($data, 'image_delete')) {
            $this->repository->deleteImage($data['image_delete']);
            $path = array_get($data, 'image_url');
        }

        if (array_get($data, 'image-switch') == 'image_file' and $this->request->hasFile('image_file')) {
            $path = $this->repository->saveImage($this->request->file('image_file'), $this->getViewsFolder());
            if (!$path) {
                return redirect()->back()->withError('Could not save image');
            }
        } elseif (array_get($data, 'image_url') and !array_get($data, 'image_delete')) {
            $path = array_get($data, 'image_url');
        }

        $data['image'] = $path;
        $this->repository->updateRich($data, $id);

        return $this->redirectTo('index');
    }

    public function destroy($id)
    {
        $repository = $this->repository->findOrFail($id);
        if ($image = $repository->image) {
            $this->repository->deleteImage($image);
        }
        $this->repository->delete($id);

        return $this->redirectTo('index');
    }

}
