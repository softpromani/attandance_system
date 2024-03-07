<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'admin',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Teacher',
                'guard_name' => 'web',
            ],
        ];
       
foreach ($roles as $roleData) {
    $role = Role::create($roleData);
}
        if($role){
            $user = User::create([
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('Admin@123'),
            ]);
            $user->assignRole('admin'); 
        }
       
      
    }
}
