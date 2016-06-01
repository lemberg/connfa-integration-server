<?php

namespace App\Http\Controllers\CMS;

use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Controllers\CMS\BaseController;

class UsersController extends BaseController
{
    public function __construct(UserRequest $request, UserRepository $repository, ResponseFactory $response)
    {
        parent::__construct($request, $repository, $response);
    }

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
