<?php

use Illuminate\Database\Seeder;
use OgaBoss\Modules\Auth\Models\ApiRole;
use OgaBoss\Modules\Auth\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        /* $superAdminRole = ApiRole::where('name', 'super_admin')->first();
        $userRole = ApiRole::where('name', 'user')->first() */

        //if ($superAdminRole) {
        User::where('email', 'admin@smartmetre.com')->delete();

        User::create([
                'username' => 'Admin',
                //'surname' => 'Admin',
                'first_name' => 'Admin',
                'last_name' => 'Admin',
                'image' => 'chat.png',
                'phone' => '7777777',
                //'gender' => 'male',
                'email' => 'admin@smartmetre.com',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
               // 'api_role_id' => $superAdminRole->id,
            ]);
        // }

        User::where('email', 'user1@smartmetre.com')->delete();
        User::where('email', 'user2@smartmetre.com')->delete();

        User::create([
                'username' => 'User 1',
                //'surname' => 'User 1',
                'first_name' => 'User 1',
                'last_name' => 'User 1',
                'email' => 'user1@smartmetre.com',
                'phone' => '7777777',
                //'gender' => 'male',
                // 'status'    => 'enabled',
                'image' => 'chat.png',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                //'api_role_id' => $userRole->id,
            ]);

        User::create([
                'username' => 'User 2',
                //'surname' => 'User 2',
                'first_name' => 'User 2',
                'last_name' => 'User 2',
                //'gender' => 'male',
                // 'status'    => 'enabled',
                'image' => 'chat.png',
                'phone' => '7777777',
                'email' => 'user2@smartmetre.com',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
               // 'api_role_id' => $userRole->id,
            ]);
    }
}
