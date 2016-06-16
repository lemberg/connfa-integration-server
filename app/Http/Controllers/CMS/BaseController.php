<?php

namespace App\Http\Controllers\CMS;

use App\Exceptions\DirectoryNotFoundException;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Routing\ResponseFactory;
use Yajra\Datatables\Datatables;
/**
 * Class BaseController
 * @package App\Http\Controllers\CMS
 */
class BaseController extends Controller
{

    /**
     * @var Request
     */
    protected $request = null;

    /**
     * @var BaseRepository
     */
    protected $repository = null;

    /**
     * @var ResponseFactory
     */
    protected $response = null;

    /**
     * @var string
     */
    protected $viewsFolder = null;

    /**
     * Where to redirect users after create / update.
     *
     * @var string
     */
    protected $routeName = null;

    /**
     * The calling class name
     *
     * @var string
     */
    protected $currentCallingControllerName = null;

    /**
     * BaseController constructor.
     *
     * @param Request $request
     * @param BaseRepository $repository
     * @param ResponseFactory $response
     */
    public function __construct(Request $request, BaseRepository $repository, ResponseFactory $response)
    {
        $this->request = $request;
        $this->repository = $repository;
        $this->response = $response;
        $this->viewsFolder = $this->getViewsFolder();
        $this->routeName = $this->getRouteName();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->response->view($this->getViewName('index'), ['data' => $this->repository->paginate(25)]);
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getData()
    {
        return Datatables::of($this->repository->all())
            ->addColumn('actions', function ($data) {
                return view('partials/actions', ['item' => $data, 'viewFolder' => $this->getRouteName()]);
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->response->view($this->getViewName('create'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $this->repository->create($this->request->all());

        return $this->redirectTo('index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        return $this->response->view($this->getViewName('show'), ['data' => $this->repository->findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->response->view($this->getViewName('edit'), ['data' => $this->repository->findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $this->repository->updateRich($this->request->except('_method', '_token'), $id);

        return $this->redirectTo('index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->delete($id);

        return $this->redirectTo('index');
    }

    /**
     * Get lower current calling class name
     *
     * @return string
     */
    protected function getCurrentCallingControllerName()
    {
        if (is_null($this->currentCallingControllerName)) {
            $namespace = explode('\\', get_class($this));
            $this->currentCallingControllerName = strtolower(str_replace('Controller', '', end($namespace)));
        }

        return $this->currentCallingControllerName;
    }

    /**
     * Get route by class name
     *
     * @return string
     */
    protected function getRouteName()
    {
        if (is_null($this->routeName)) {
            $this->routeName = $this->getCurrentCallingControllerName();
        }

        return $this->routeName;
    }

    /**
     * Get views folder by class name
     *
     * @return string
     * @throws Exception
     */
    protected function getViewsFolder()
    {
        if (is_null($this->viewsFolder)) {
            $folder = strtolower($this->getCurrentCallingControllerName());
            $paths = resource_path('views') . DIRECTORY_SEPARATOR . $folder;
            if (!is_dir($paths)) {
                throw new DirectoryNotFoundException("Directory {$paths} not found");
            }

            $this->viewsFolder = $folder;
        }

        return $this->viewsFolder;
    }

    /**
     * Redirect to url
     *
     * @param string $url
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectTo($url)
    {
        return $this->response->redirectToRoute($this->getRouteName() . "." . $url);
    }

    /**
     * Get view name
     *
     * @param string $viewName
     *
     * @return string
     */
    protected function getViewName($viewName)
    {
        return $this->getViewsFolder() . '.' . $viewName;
    }

    /**
     * Delete image file and clean field
     *
     * @param int $id
     * @param string $fieldName
     *
     * @return bool
     */
    public function deleteImageAndCleanField($id, $fieldName)
    {
        $repository = $this->repository->findOrFail($id);
        if ($image = $repository[$fieldName]) {
            $this->repository->deleteImage($image);
        }

        $repository[$fieldName] = "";
        $repository->save();

        return true;
    }
}
