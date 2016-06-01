<?php

namespace App\Http\Controllers\CMS;

use App\Http\Requests\PageRequest;
use App\Repositories\PageRepository;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Controllers\CMS\BaseController;

class PagesController extends BaseController
{
    public function __construct(PageRequest $request, PageRepository $repository, ResponseFactory $response)
    {
        parent::__construct($request, $repository, $response);
    }

    public function store()
    {
        $data = $this->request->all();
        $this->repository->create($this->checkAndMakeAlias($data));

        return $this->redirectTo('index');
    }

    public function update($id)
    {
        $data = $this->request->all();
        $this->repository->updateRich($this->checkAndMakeAlias($data), $id);

        return $this->redirectTo('index');
    }

    /**
     * Check and set slug to alias
     *
     * @param array $data
     *
     * @return mixed
     */
    protected function checkAndMakeAlias($data)
    {
        if (empty($data['alias'])) {
            $data['alias'] = str_slug($data['name']);
        } else {
            $data['alias'] = str_slug($data['alias']);
        }

        return $data;
    }
}
