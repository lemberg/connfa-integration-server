<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{

    public function model()
    {
        return User::class;
    }

    /**
     * Change password to Hash
     *
     * @param $id
     * @param $password
     *
     * @return boolean
     */
    public function changePassword($id, $password)
    {
        $user = $this->findOrFail($id);
        $user->password = $password;
        return $user->save();
    }
}
