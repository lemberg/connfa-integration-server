<?php

namespace App\Http\Controllers\CMS;

use App\Http\Requests\SpeakerRequest;
use App\Repositories\SpeakerRepository;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Controllers\CMS\BaseController;

class SpeakersController extends BaseController
{

    public function __construct(SpeakerRequest $request, SpeakerRepository $repository, ResponseFactory $response)
    {
        parent::__construct($request, $repository, $response);
    }

    public function store()
    {
        $data = $this->request->all();
        if ($this->request->get('icon-switch') == 'file' AND $this->request->hasFile('image')) {
            $path = $this->repository->saveImage($this->request->file('image'), $this->getViewsFolder());
            if (!$path) {
                return redirect()->back()->withError('Could not save image');
            }

            $data['avatar'] = $path;
        }

        $this->repository->create($data);

        return $this->redirectTo('index');
    }

    public function update($id)
    {
        $data = $this->request->all();
        if ($this->request->get('icon-switch') == 'file' AND $this->request->hasFile('image')) {
            $path = $this->repository->saveImage($this->request->file('image'), $this->getViewsFolder());
            if (!$path) {
                return redirect()->back()->withError('Could not save image');
            }

            $data['avatar'] = $path;
        }
        $this->repository->updateRich($data, $id);

        return $this->redirectTo('index');
    }

    public function destroy($id)
    {
        $repository = $this->repository->findOrFail($id);
        if ($image = $repository->avatar) {
            $this->repository->deleteImage($image);
        }
        $this->repository->delete($id);

        return $this->redirectTo('index');
    }

    public function iconDelete($id)
    {
        $this->deleteImageAndCleanField($id, 'avatar');

        return ['result' => true];
    }
}
