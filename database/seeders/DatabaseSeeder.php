<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
     $user = User::factory()->create([
        'name'=>'admin',
        'email'=>'admin@gmail.com',
     ]);
     $role = Role::create(['name'=>'admin']);
     $user->assignRole($role);

       $this->call(PermissionSeeder::class);

    }

}
