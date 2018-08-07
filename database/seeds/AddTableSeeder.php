<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        DB::table('cate_news')->insert([
//            ['name' => 'The gioi'],
//            ['name' => 'The thao'],
//            ['name' => 'Am nhac']
//        ]);
        DB::table('news')->insert([
            ['title' => 'title 1', 'intro' => 'intro 1', 'cate_id' => 1],
            ['title' => 'title 2', 'intro' => 'intro 2', 'cate_id' => 1],
            ['title' => 'title 3', 'intro' => 'intro 3', 'cate_id' => 1],
            ['title' => 'title 4', 'intro' => 'intro 4', 'cate_id' => 1],
        ]);
    }
}
