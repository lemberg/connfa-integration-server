<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Repositories\ConferenceRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory;
use Yajra\Datatables\Datatables;

/**
 * Class ConferencesController
 * @package App\Http\Controllers\CMS
 */
class ConferencesController extends Controller
{

    /**
     * @var Request
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
     * @param Request $request
     * @param ResponseFactory $response
     * @param ConferenceRepository $conferenceRepository
     */
    public function __construct(Request $request, ResponseFactory $response, ConferenceRepository $conferenceRepository)
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
     * Show edit form
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        /** @todo Stub */
        return $this->response->view('conferences.edit', []);
    }

    /**
     * Delete conference
     *
     * @param integer $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        /** @todo Stub */
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

}