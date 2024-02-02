<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    private $permissions = [
        'role-list',
        'role-create',
        'role-edit',
        'role-delete',
        'product-list'
    ];
    /**
     * Seed the application's database.
     */
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
