<?php

namespace App\Http\Controllers\CMS;

use App\Exceptions\DirectoryNotFoundException;
use App\Repositories\SettingsRepository;
use Exception;
use Illuminate\Http\Request;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Support\Facades\Auth;
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
        parent::__construct();
        $this->request = $request;
        $this->repository = $repository;
        $this->response = $response;
        $this->viewsFolder = $this->getViewsFolder();
        $this->routeName = $this->getRouteName();
        $this->isSetTimezone();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->response->view($this->getViewName('index'), [
            'data' => $this->repository->findByConference($this->getConference()->id)->paginate(25)
        ]);
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getData()
    {
        return Datatables::of($this->repository->findByConference($this->getConference()->id))
            ->addColumn('actions', function ($data) {
                return view('partials/actions', ['route' => $this->getRouteName(), 'id' => $data->id]);
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
     * @param string $conferenceAlias
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($conferenceAlias)
    {
        $data = $this->request->all();
        $data['conference_id'] = $this->getConference()->id;
        $this->repository->create($data);

        return $this->redirectTo('index', ['conference_alias' => $conferenceAlias]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string $conferenceAlias
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($conferenceAlias, $id)
    {
        $item = $this->repository->findOrFail($id);
        $this->checkConference($item->conference_id);
        return $this->response->view($this->getViewName('show'), ['data' => $item]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $conferenceAlias
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($conferenceAlias, $id)
    {
        $item = $this->repository->findOrFail($id);
        $this->checkConference($item->conference_id);
        return $this->response->view($this->getViewName('edit'), ['data' => $item]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  string $conferenceAlias
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update($conferenceAlias, $id)
    {
        $item = $this->repository->findOrFail($id);
        $this->checkConference($item->conference_id);
        $item->fill($this->request->except('_method', '_token'))->save();

        return $this->redirectTo('index', ['conference_alias' => $conferenceAlias]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $conferenceAlias
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($conferenceAlias, $id)
    {
        $item = $this->repository->findOrFail($id);
        $this->checkConference($item->conference_id);
        $item->delete();

        return $this->redirectTo('index', ['conference_alias' => $conferenceAlias]);
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
     * @param array  $parameters
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectTo($url, $parameters = [])
    {
        return $this->response->redirectToRoute($this->getRouteName() . "." . $url, $parameters);
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

    /**
     * Set or unset Session 'settings'
     *
     * @return Session
     */
    private function isSetTimezone()
    {
        /** @var SettingsRepository $settingsRepository */
        $settingsRepository = \App::make(SettingsRepository::class);
        $settings = $settingsRepository->getAllSettingInSingleArray($this->getConference()->id);
        if (!isset($settings['timezone'])) {
            session(['settings' => true]);
        } elseif (session()->has('settings')) {
            session()->forget('settings');
        }

        return true;
    }

    /**
     * Is user has role
     *
     * @param string $roleName
     *
     * @return bool
     */
    public function isRole($roleName = 'admin')
    {
        if ($roles = Auth::user()->roles->toArray()) {
            foreach ($roles as $role) {
                if (array_get($role, 'name') == $roleName) {

                    return true;
                }
            }
        }

        return false;
    }
}
