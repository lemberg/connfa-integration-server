<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConferenceRequest;
use App\Repositories\ConferenceRepository;
use Illuminate\Contracts\Routing\ResponseFactory;
use Yajra\Datatables\Datatables;

/**
 * Class ConferencesController
 * @package App\Http\Controllers\CMS
 */
class ConferencesController extends Controller
{

    /**
     * @var ConferenceRequest
     */
    protected $request = null;

    /**
     * @var ResponseFactory
     */
    protected $response = null;

    /**
     * @var ConferenceRepository
     */
    protected $conferenceRepository;

    /**
     * BaseController constructor.
     *
     * @param ConferenceRequest $request
     * @param ResponseFactory $response
     * @param ConferenceRepository $conferenceRepository
     */
    public function __construct(ConferenceRequest $request, ResponseFactory $response, ConferenceRepository $conferenceRepository)
    {
        $this->request = $request;
        $this->response = $response;
        $this->conferenceRepository = $conferenceRepository;
    }

    /**
     * Show list of conferences.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->response->view('conferences.index');
    }

    /**
     * Show list of conferences.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->response->view('conferences.create');
    }

    /**
     * Store a newly created conference in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $data = $this->request->all();
        $this->conferenceRepository->create($this->checkAndMakeAlias($data));

        return redirect()->route('conferences.index');
    }

    /**
     * Show edit form
     *
     * @param integer $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->response->view('conferences.edit', ['data' => $this->conferenceRepository->findOrFail($id)]);
    }

    /**
     * Update conference data.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id)
    {
        $data = $this->request->all();
        $this->conferenceRepository->updateRich($this->checkAndMakeAlias($data), $id);

        return redirect()->route('conferences.index');
    }

    /**
     * Delete conference.
     *
     * @param integer $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->conferenceRepository->delete($id);
        return redirect()->route('conferences.index');
    }

    /**
     * Process DataTables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getData()
    {
        return Datatables::of($this->conferenceRepository->all())
            ->addColumn('actions', function ($data) {
                return view('conferences.actions', ['conference' => $data])->render();
            })
            ->make(true);
    }

    /**
     * Select another conference.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function select($id)
    {
        $conference = $this->conferenceRepository->findOrFail($id);
        return redirect()->route('dashboard', ['conference_alias' => $conference->alias]);
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