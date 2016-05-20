<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Repositories\BaseRepository;

class BaseController extends Controller
{
    /**
     * @var string
     */
    protected $viewsFolder = '';

    /**
     * @var Request
     */
    protected $request = '';

    /**
     * @var BaseRepository
     */
    protected $repository = '';

    /**
     * BaseController constructor.
     *
     * @param string $viewsFolder
     * @param Request $request
     * @param BaseRepository $repository
     */
    public function __construct($viewsFolder, Request $request, BaseRepository $repository)
    {
        $this->viewsFolder = $viewsFolder;
        $this->request = $request;
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->viewsFolder . '.index', ['data' => $this->repository->paginate(1)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->viewsFolder . '.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $this->repository->create($this->request->all());

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view($this->viewsFolder . '.show', ['data' => $this->repository->findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view($this->viewsFolder . '.edit', ['data' => $this->repository->findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $this->repository->update($this->request->except('_method', '_token'), $id);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->delete($id);

        return back();
    }
}
