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
        $this->repository->create($this->saveImage('avatar'));

        return $this->redirectTo('index');
    }

    public function update($id)
    {
        $this->repository->updateRich($this->saveImage('avatar'), $id);

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
