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
     * Where to redirect users after create / update.
     *
     * @var string
     */
    protected $redirectTo = '';

    /**
     * BaseController constructor.
     *
     * @param string $viewsFolder
     * @param Request $request
     * @param BaseRepository $repository
     * @param string $redirectTo
     */
    public function __construct($viewsFolder, Request $request, BaseRepository $repository, $redirectTo)
    {
        $this->viewsFolder = $viewsFolder;
        $this->request = $request;
        $this->repository = $repository;
        $this->redirectTo = $redirectTo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->viewsFolder . '.index', ['data' => $this->repository->paginate(25)]);
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

        return redirect($this->redirectTo);
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

        return redirect($this->redirectTo);
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
