<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    private $permissions = [
        'role-list',
        'role-create',
        'role-edit',
        'role-delete',
        'product-list'
    ];
    public function run(): void
    {
        foreach ($this -> permissions as $permission) {
            Permission::create(['name'=>$permission]);
        }
        $user = User::create([
            'name' =>'Rosca Filadelfia',
            'email' =>'admin@admin.com',
            'password' =>Hash::make('Secret2024')
        ]);
        $role = Role::create(['name'=>'Admin']);
        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
        
    }
}
