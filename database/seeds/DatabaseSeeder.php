<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
//        DB::table('chiennguyen')->insert(
//            [
//                [
//                    'hoten'       => str_random(10),
//                    'email'       => str_random(10) . '@gmail.com',
//                    'sodienthoai' => 108123123
//                ],
//                [
//                    'hoten'       => str_random(10),
//                    'email'       => str_random(10) . '@gmail.com',
//                    'sodienthoai' => 999999
//                ]
//            ]
//        );

        $this->call(AddTableSeeder::class);
    }
}
