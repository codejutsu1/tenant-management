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
            'lga' => 'lga',
            'state' => 'state',
            'occupation' => 'Civil Servant',
            'dob' => NULL,
            'phone' => '23454545',
            'created_at' => Carbon::now()
        ]);

        DB::table('users')->insert([
            'name' => 'CareTaker',
            'email' => 'care@caretaker.com',
            'password' => bcrypt('care@caretaker'),
            'gender' => 'male',
            'year' => NULL,
            'role_id' => '2',
            'type' => 'Caretaker',
            'lga' => 'lga',
            'state' => 'state',
            'occupation' => 'Civil Servant',
            'dob' => NULL,
            'phone' => '2334434534',
            'created_at' => Carbon::now()
        ]);

        DB::table('users')->insert([
            'name' => 'Tenant',
            'email' => 'user@user.com',
            'password' => bcrypt('user@user'),
            'gender' => 'male',
            'year' => NULL,
            'role_id' => '3',
            'type' => 'Tenant',
            'lga' => 'lga',
            'state' => 'state',
            'occupation' => 'Civil Servant',
            'dob' => NULL,
            'phone' => '23234343',
            'created_at' => Carbon::now()
        ]);
    }
}
