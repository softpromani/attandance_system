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
                'name' => 'staff',
                'guard_name' => 'web',
            ],
        ];
       
foreach ($roles as $roleData) {
    $role = Role::create($roleData);
}
        if($role){
            $user = User::create([
                'name' => 'admin JFS',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('Admin@123'),
                'teacher_id'=>'001',
                'first_name'=>'admin',
                'last_name'=>'JFS',
                'father_name'=>'Super Admin',
                'mobile_number'=>'9555710197',
               
            ]);
            $user->assignRole('admin'); 
        }
       
      
    }
}
