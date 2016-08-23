<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $admin = new Role();
        $admin->name = 'admin';
        $admin->display_name = 'Administrator';
        $admin->description = 'User is allowed to manage and edit other users';
        $admin->save();

        $editor = new Role();
        $editor->name = 'editor';
        $editor->display_name = 'Editor';
        $editor->description = 'User is allowed to manage and edit other users';
        $editor->save();

        $permission = App\Models\Permission::where(['name' => 'edit-user'])->first();
        $admin->attachPermission($permission);
    }
}
