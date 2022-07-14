<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin@admin'),
            'gender' => 'male',
            'year' => NULL,
            'role_id' => '1',
            'type' => 'LandLord',
            'lga' => 'Oko',
            'state' => 'Lagos',
            'occupation' => 'Civil Servant',
            'dob' => NULL,
            'phone' => '23454545' 
        ]);

        DB::table('users')->insert([
            'name' => 'CareTaker',
            'email' => 'care@caretaker.com',
            'password' => bcrypt('care@caretaker'),
            'gender' => 'male',
            'year' => NULL,
            'role_id' => '2',
            'type' => 'Caretaker',
            'lga' => 'Oko',
            'state' => 'Lagos',
            'occupation' => 'Civil Servant',
            'dob' => NULL,
            'phone' => '2334434534' 
        ]);

        DB::table('users')->insert([
            'name' => 'Tenant',
            'email' => 'user@user.com',
            'password' => bcrypt('user@user'),
            'gender' => 'male',
            'year' => NULL,
            'role_id' => '3',
            'type' => 'Tenant',
            'lga' => 'Oko',
            'state' => 'Lagos',
            'occupation' => 'Civil Servant',
            'dob' => NULL,
            'phone' => '23234343' 
        ]);
    }
}
