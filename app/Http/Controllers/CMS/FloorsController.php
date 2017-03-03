<?php

namespace App\Http\Controllers\CMS;

use App\Http\Requests\FloorRequest;
use App\Repositories\FloorRepository;
use Illuminate\Contracts\Routing\ResponseFactory;

/**
 * Class FloorsController
 * @package App\Http\Controllers\CMS
 */
class FloorsController extends BaseController
{

    /**
     * FloorsController constructor.
     *
     * @param FloorRequest $request
     * @param FloorRepository $repository
     * @param ResponseFactory $response
     */
    public function __construct(FloorRequest $request, FloorRepository $repository, ResponseFactory $response)
    {
        parent::__construct($request, $repository, $response);
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
        if ($this->request->get('image-switch') == 'image_file' and $this->request->hasFile('image_file')) {
            $path = $this->repository->saveImage($this->request->file('image_file'), $this->getViewsFolder(), ['width' => 1800, 'height' => 1800]);
            if (!$path) {
                return redirect()->back()->withError('Could not save image');
            }
        } else {
            $path = $this->request->get('image_url');
        }

        $data['image'] = $path;
        $data['conference_id'] = $this->conference->id;
        $this->repository->create($data);

        return $this->redirectTo('index', ['conference_alias' => $conferenceAlias]);
    }

    /**
     * Overridden parent method, added update image
     *
     * @param string  $conferenceAlias
     * @param integer $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($conferenceAlias, $id)
    {
        $data = $this->request->all();
        $path = array_get($data, 'image');
        if (array_get($data, 'image_delete')) {
            $this->repository->deleteImage($data['image_delete']);
            $path = array_get($data, 'image_url');
        }

        if (array_get($data, 'image-switch') == 'image_file' and $this->request->hasFile('image_file')) {
            $path = $this->repository->saveImage($this->request->file('image_file'), $this->getViewsFolder(), ['width' => 1800, 'height' => 1800]);
            if (!$path) {
                return redirect()->back()->withError('Could not save image');
            }
        } elseif (array_get($data, 'image_url') and !array_get($data, 'image_delete')) {
            $path = array_get($data, 'image_url');
        }

        $data['image'] = $path;
        $this->repository->updateRich($data, $id);

        return $this->redirectTo('index', ['conference_alias' => $conferenceAlias]);
    }

    /**
     * Overridden parent method, added delete image
     *
     * @param string  $conferenceAlias
     * @param integer $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($conferenceAlias, $id)
    {
        $repository = $this->repository->findOrFail($id);
        if ($image = $repository->image) {
            $this->repository->deleteImage($image);
        }
        $this->repository->delete($id);

        return $this->redirectTo('index', ['conference_alias' => $conferenceAlias]);
    }
}
