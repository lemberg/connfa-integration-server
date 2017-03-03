<?php

namespace App\Http\Controllers\CMS;

use App\Http\Requests\PageRequest;
use App\Repositories\PageRepository;
use Illuminate\Contracts\Routing\ResponseFactory;

/**
 * Class PagesController
 * @package App\Http\Controllers\CMS
 */
class PagesController extends BaseController
{
    /**
     * PagesController constructor.
     *
     * @param PageRequest $request
     * @param PageRepository $repository
     * @param ResponseFactory $response
     */
    public function __construct(PageRequest $request, PageRepository $repository, ResponseFactory $response)
    {
        parent::__construct($request, $repository, $response);
    }

    /**
     * Overridden parent method, added check to unique alias
     *
     * @param string  $conferenceAlias
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($conferenceAlias)
    {
        $data = $this->request->all();
        $data['conference_id'] = $this->conference->id;
        $this->repository->create($this->checkAndMakeAlias($data));

        return $this->redirectTo('index', ['conference_alias' => $conferenceAlias]);
    }

    /**
     * Overridden parent method, added check to unique alias
     *
     * @param string  $conferenceAlias
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($conferenceAlias, $id)
    {
        $data = $this->request->all();
        $this->repository->updateRich($this->checkAndMakeAlias($data), $id);

        return $this->redirectTo('index', ['conference_alias' => $conferenceAlias]);
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
