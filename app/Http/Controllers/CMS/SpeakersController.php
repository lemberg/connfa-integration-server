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
        if ($this->request->get('avatar-switch') == 'avatar_file' AND $this->request->hasFile('avatar_file')) {
            $path = $this->repository->saveImage($this->request->file('avatar_file'), $this->getViewsFolder());
            if (!$path) {
                return redirect()->back()->withError('Could not save image');
            }
        } else {
            $path = $this->request->get('avatar_url');
        }

        $data['avatar'] = $path;
        $this->repository->create($data);

        return $this->redirectTo('index');
    }

    public function update($id)
    {
        $data = $this->request->all();
        $path = array_get($data, 'avatar');
        if (array_get($data, 'avatar_delete')) {
            $this->repository->deleteImage($data['avatar_delete']);
            $path = '';
        }

        if ($this->request->get('avatar-switch') == 'avatar_file' AND $this->request->hasFile('avatar_file')) {
            $path = $this->repository->saveImage($this->request->file('avatar_file'), $this->getViewsFolder());
            if (!$path) {
                return redirect()->back()->withError('Could not save image');
            }
        } elseif ($this->request->get('avatar_url') && !array_get($data, 'avatar_delete')) {
            $path = $this->request->get('avatar_url');
        }

        $data['avatar'] = $path;
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
}
