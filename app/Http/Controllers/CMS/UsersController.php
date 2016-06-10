<?php

namespace App\Http\Controllers\CMS;

use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Routing\ResponseFactory;

/**
 * Class UsersController
 * @package App\Http\Controllers\CMS
 */
class UsersController extends BaseController
{

    /**
     * UsersController constructor.
     *
     * @param UserRequest $request
     * @param UserRepository $repository
     * @param ResponseFactory $response
     */
    public function __construct(UserRequest $request, UserRepository $repository, ResponseFactory $response)
    {
        parent::__construct($request, $repository, $response);
    }

    /**
     * Update data, if set change_password true then update password
     * 
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id)
    {
        if ($this->request->get('change_password') != 'true') {
            $this->repository->updateRich($this->request->except('change_password', 'password', 'password_confirmation'), $id);
        }
        else{
            $this->repository->updateRich($this->request->except('change_password', 'password_confirmation'), $id);
        }

        return $this->redirectTo('index');
    }
}
