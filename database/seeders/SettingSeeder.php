<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'site_name' => 'Lodge',
            'site_email' => 'accomodation@lodge.com',
            'site_phone' => '7888872783',
            'site_rent' => '180000',
            'room_numbers' => '30'
        ]);
    }
}
