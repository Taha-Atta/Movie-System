<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private $permissions = [
        'create roles',
        'update roles',
        'delete roles',
        'show all roles',
        'assign role to permission',
        'unassign role from permission',
        'show all permissions',
        'assign role to user',
        'revoke role to user',
        'assign permission to user',
        'revoke permission to user',
        'show all categories',
        'create category',
        'edit category',
        'soft delete category',
        'show all movies',
        'create movie',
        'edit movie',
        'soft delete movie',
        'show movie by category id',
        'show movie whether paid or free',
        'show all reviews',
        'create new review',
        'edit review',
        'delete any review',
        'hide/unhide any review.',
    ];
    public function run(): void
    {
        foreach($this->permissions as $permission ){

            Permission::create(['name'=>$permission]);
        }
        // $user = User::create([
        //     'name' => 'admin',
        //     'email' => 'admin@gmail.com',
        //     'password' => bcrypt('12345678'),
        //     'age' =>55,
        //     'type' => 1,
        // ]);

        // $role = Role::create(['name' => 'Admin']);

        // $permissions = Permission::pluck('id', 'id')->all();

        // $role->syncPermissions($permissions);

        // $user->assignRole([$role->id]);
    }
}
