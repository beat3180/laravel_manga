<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'category' => '一行感想',
        ]);

        DB::table('categories')->insert([
            'category' => '単行本感想',
        ]);

        DB::table('categories')->insert([
            'category' => '真面目考察',
        ]);
    }
}
