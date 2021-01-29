<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'comment' => 'taro',
            'user_id' => '1',
            'content_id' => '1',
        ];
        DB::table('comments')->insert($param);


    }
}
