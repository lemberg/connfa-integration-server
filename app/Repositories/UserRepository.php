<?php 

namespace App\Repositories;

use App\Models\Role;

class UserRepository extends BaseRepository
{

    public function model()
    {
        return 'App\Models\User';
    }

    public function updateProfile($data, $id)
    {
        $user = $this->find($id);

        if (array_get($data, 'role')) {
            $role = Role::where('name', array_get($data, 'role'))->first();
            $user->roles()->sync([$role->id]);
            unset($data['role']);
        }

        $user->update($data);

        return $user;
    }
}
