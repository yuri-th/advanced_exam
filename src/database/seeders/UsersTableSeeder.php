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
            'name' => '岡本太郎',
            'email' => 'taro@example.com',
            'password' => bcrypt('12312312'),
        ];
        DB::table('users')->insert($param);
    }
}
