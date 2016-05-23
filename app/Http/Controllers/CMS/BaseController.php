<?php

namespace App\Http\Controllers\CMS;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Routing\ResponseFactory;
use \Config;

/**
 * Class BaseController
 * @package App\Http\Controllers\CMS
 */
class BaseController extends Controller
{

    /**
     * @var Request
     */
    protected $request = '';

    /**
     * @var BaseRepository
     */
    protected $repository = '';

    /**
     * @var ResponseFactory
     */
    protected $responseFactory;

    /**
     * @var string
     */
    protected $viewsFolder = null;

    /**
     * Where to redirect users after create / update.
     *
     * @var string
     */
    protected $route = null;

    /**
     * BaseController constructor.
     *
     * @param Request $request
     * @param BaseRepository $repository
     * @param ResponseFactory $responseFactory
     */
    public function __construct(Request $request, BaseRepository $repository, ResponseFactory $responseFactory)
    {
        $this->request = $request;
        $this->repository = $repository;
        $this->responseFactory = $responseFactory;
        $this->viewsFolder = $this->getViewsFolder();
        $this->route = $this->getRoute();

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->responseFactory->view($this->viewsFolder . '.index', ['data' => $this->repository->paginate(25)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->responseFactory->view($this->viewsFolder . '.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $this->repository->create($this->request->all());

        return $this->responseFactory->redirectToRoute($this->route.'.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        return $this->responseFactory->view($this->viewsFolder . '.show', ['data' => $this->repository->findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->responseFactory->view($this->viewsFolder . '.edit', ['data' => $this->repository->findOrFail($id)]);
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

        return $this->responseFactory->redirectToRoute($this->route.'.index');
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

        return $this->responseFactory->redirectToRoute($this->route.'.index');
    }

    /**
     * Get lower class name
     *
     * @return string
     */
    protected function getBaseClassName()
    {
        $namespace = explode('\\', get_class($this));

        return strtolower(str_replace('Controller', '', end($namespace)));
    }

    /**
     * Get route by class name
     *
     * @return string
     */
    protected function getRoute()
    {
        $route = $this->route;
        if(!$route)
        {
            $route = $this->getBaseClassName();
        }

        return $route;
    }

    /**
     * Get views folder by class name
     *
     * @return null|string
     * @throws Exception
     */
    protected function getViewsFolder()
    {
        $paths = Config::get('view.paths')[0];
        $folder = $this->viewsFolder;
        if(!$folder)
        {
            $folder = $this->getBaseClassName();
            if(!is_dir($paths.DIRECTORY_SEPARATOR.$folder))
            {
                throw new Exception('No directory');
            }
        }

        return $folder;
    }
}
