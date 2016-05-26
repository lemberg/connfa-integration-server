<?php

namespace App\Http\Controllers\CMS;

use App\Http\Requests\TypeRequest;
use App\Repositories\Event\TypeRepository;
use Illuminate\Contracts\Routing\ResponseFactory;

class TypesController extends BaseController
{

    /**
     * TracksController constructor.
     *
     * @param TypeRequest $request
     * @param TypeRepository $repository
     * @param ResponseFactory $response
     */
    public function __construct(TypeRequest $request, TypeRepository $repository, ResponseFactory $response)
    {
        parent::__construct($request, $repository, $response);
    }

    public function store()
    {
        $this->repository->create($this->saveImage());

        return $this->redirectTo('index');
    }

    public function update($id)
    {
        $this->repository->update($this->saveImage(), $id);

        return $this->redirectTo('index');
    }

    public function destroy($id)
    {
        $type = $this->repository->findOrFail($id);
        if ($image = $type->icon) {
            $this->repository->deleteImage($image);
        }
        $this->repository->delete($id);

        return $this->redirectTo('index');
    }

    /**
     * Delete image file and clean icon field
     *
     * @param $id
     *
     * @return array
     */
    public function iconDelete($id)
    {
        $type = $this->repository->findOrFail($id);
        if ($image = $type->icon) {
            if ($this->repository->deleteImage($image)) {
                $type->icon = "";
                $type->save();

                return ['result' => true];
            }
        }

        return ['result' => false];
    }


    /**
     * Save image and return clean data to save / update
     *
     * @return array
     */
    protected function saveImage()
    {
        if ($this->request->get('icon-switch') == 'file' AND $this->request->hasFile('image')) {
            $path = $this->repository->saveImage($this->request->file('image'), 'types');
            if (!$path) {
                return redirect()->back()->withError('Could not resize image');
            }

            $this->request['icon'] = $path;
        }

        return $this->request->except('_method', '_token', 'icon-switch', 'image');
    }
}
