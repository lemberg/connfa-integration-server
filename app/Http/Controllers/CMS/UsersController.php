<?php

namespace App\Http\Controllers\CMS;

use App\Http\Requests\UserRequest;
use App\Repositories\ConferenceRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Support\Facades\Auth;

/**
 * Class UsersController
 * @package App\Http\Controllers\CMS
 */
class UsersController extends BaseController
{

    /**
     * @var RoleRepository
     */
    protected $roleRepository;

    /**
     * UsersController constructor.
     *
     * @param UserRequest $request
     * @param UserRepository $repository
     * @param RoleRepository $roleRepository
     * @param ResponseFactory $response
     * @param ConferenceRepository $conferenceRepository
     */
    public function __construct(
        UserRequest $request,
        UserRepository $repository,
        RoleRepository $roleRepository,
        ResponseFactory $response,
        ConferenceRepository $conferenceRepository
    ) {
        $this->roleRepository = $roleRepository;
        parent::__construct($request, $repository, $response, $conferenceRepository);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->response->view('users.create',
            ['roles' => $this->roleRepository->all()->pluck('display_name', 'id')]);
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
        $user = $this->repository->create($data);
        $user->roles()->sync(array_get($data, 'roles', []));

        return $this->redirectTo('index', ['conference_alias' => $conferenceAlias]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $conferenceAlias
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($conferenceAlias, $id)
    {
        return $this->response->view('users.edit', [
            'roles' => $this->roleRepository->all()->pluck('display_name', 'id'),
            'data' => $this->repository->findOrFail($id),
        ]);
    }

    /**
     * Update data, if set change_password true then update password
     *
     * @param string $conferenceAlias
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($conferenceAlias, $id)
    {
        $data = $this->request->all();
        $roles = array_get($data, 'roles', []);
        if ($this->request->get('change_password') != 'true') {
            $this->repository->updateRich($this->request->except('roles', 'change_password', 'password',
                'password_confirmation'), $id);
        } else {
            $this->repository->updateRich($this->request->except('roles', 'change_password',
                'password_confirmation'), $id);
        }

        $user = $this->repository->findOrFail($id);
        $user->roles()->sync($roles);

        if (!$this->isRole()) {

            return $this->response->redirectTo('/dashboard');
        }

        return $this->redirectTo('index', ['conference_alias' => $conferenceAlias]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $conferenceAlias
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($conferenceAlias, $id)
    {
        $user = $this->repository->findOrFail($id);
        $user->roles()->sync([]);
        $this->repository->delete($id);

        return $this->redirectTo('index', ['conference_alias' => $conferenceAlias]);
    }
}
