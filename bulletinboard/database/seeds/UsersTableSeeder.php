<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->insert([
        //     'name' => 'Admin',
        //     'email' => 'admin@test.com',
        //     'password' => '12345678',
        //     'profile' => 'unnamed.png',
        //     'type' => '0',
        //     'phone' => '09-12345678',
        //     'address' =>'Yangon',
        //     'dob' => '2010-08-20',
        //     'create_user_id' => '1',
        //     'updated_user_id' => '1',
        //     'deleted_user_id' => '',
        //     'created_at' => date('Y-m-d'),
        //     'updated_at' => date('Y-m-d'),
        //     'deleted_at' => date('Y-m-d'),
        // ]);
        factory(App\Models\User::class, 1)->create();
    }
}