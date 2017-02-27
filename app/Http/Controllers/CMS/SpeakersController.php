<?php

namespace App\Http\Controllers\CMS;

use App\Http\Requests\SpeakerRequest;
use App\Repositories\ConferenceRepository;
use App\Repositories\SpeakerRepository;
use Illuminate\Contracts\Routing\ResponseFactory;

/**
 * Class SpeakersController
 * @package App\Http\Controllers\CMS
 */
class SpeakersController extends BaseController
{

    /**
     * SpeakersController constructor.
     *
     * @param SpeakerRequest $request
     * @param SpeakerRepository $repository
     * @param ResponseFactory $response
     * @param ConferenceRepository $conferenceRepository
     */
    public function __construct(SpeakerRequest $request, SpeakerRepository $repository, ResponseFactory $response, ConferenceRepository $conferenceRepository)
    {
        parent::__construct($request, $repository, $response, $conferenceRepository);
    }

    /**
     * Overridden parent method, added save image
     *
     * @param string $conferenceAlias
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($conferenceAlias)
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

        return $this->redirectTo('index', ['conference_alias' => $conferenceAlias]);
    }

    /**
     * Overridden parent method, added save image
     *
     * @param string $conferenceAlias
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($conferenceAlias, $id)
    {
        $data = $this->request->all();
        $path = array_get($data, 'avatar');
        if (array_get($data, 'avatar_delete')) {
            $this->repository->deleteImage($data['avatar_delete']);
            $path = array_get($data, 'avatar_url');
        }

        if (array_get($data, 'avatar-switch') == 'avatar_file' and $this->request->hasFile('avatar_file')) {
            $path = $this->repository->saveImage($this->request->file('avatar_file'), $this->getViewsFolder());
            if (!$path) {
                return redirect()->back()->withError('Could not save image');
            }
        } elseif (array_get($data, 'avatar_url') and !array_get($data, 'avatar_delete')) {
            $path = array_get($data, 'avatar_url');
        }

        $data['avatar'] = $path;
        $this->repository->updateRich($data, $id);

        return $this->redirectTo('index', ['conference_alias' => $conferenceAlias]);
    }

    /**
     * Overridden parent method, added delete image
     *
     * @param string $conferenceAlias
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($conferenceAlias, $id)
    {
        $repository = $this->repository->findOrFail($id);
        if ($image = $repository->avatar) {
            $this->repository->deleteImage($image);
        }
        $this->repository->delete($id);

        return $this->redirectTo('index', ['conference_alias' => $conferenceAlias]);
    }
}
