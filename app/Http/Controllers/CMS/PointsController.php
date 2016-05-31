<?php

namespace App\Http\Controllers\CMS;

use App\Http\Requests\PointRequest;
use App\Repositories\PointRepository;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Controllers\CMS\BaseController;

class PointsController extends BaseController
{
    public function __construct(PointRequest $request, PointRepository $repository, ResponseFactory $response)
    {
        parent::__construct($request, $repository, $response);
    }

    public function store()
    {
        $data = $this->request->all();
        if ($this->request->get('icon-switch') == 'file' AND $this->request->hasFile('file')) {
            $path = $this->repository->saveImage($this->request->file('file'), $this->getViewsFolder());
            if (!$path) {
                return redirect()->back()->withError('Could not save image');
            }

            $data['image'] = $path;
        }
        //dd($data);
        $this->repository->create($data);

        return $this->redirectTo('index');
    }

    public function update($id)
    {
        $data = $this->request->all();
        if ($this->request->get('icon-switch') == 'file' AND $this->request->hasFile('file')) {
            $path = $this->repository->saveImage($this->request->file('file'), $this->getViewsFolder());
            if (!$path) {
                return redirect()->back()->withError('Could not save image');
            }

            $data['image'] = $path;
        }
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

    public function iconDelete($id)
    {
        $this->deleteImageAndCleanField($id, 'image');

        return ['result' => true];
    }
}
