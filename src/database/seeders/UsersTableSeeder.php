<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => '岡本としこ',
            'email' => 'toshiko@example.com',
            'email_verified_at' => now(), 
            'password' => bcrypt('12312312'),
        ];
        DB::table('users')->insert($param);
    }
}
