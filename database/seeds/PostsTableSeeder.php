<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'Aさん',
            'mail' => '111@gmail.com',
            'password' => bcrypt('password'),
            'bio' => 'りんご',
            'images' => 'A.png',
        ]);

        DB::table('users')->insert([
            'username' => 'Bさん',
            'mail' => '222@gmail.com',
            'password' => bcrypt('password'),
            'bio' => 'ぶどう',
            'images' => 'b.png',
        ]);

        DB::table('users')->insert([
            'username' => 'Cさん',
            'mail' => '333@gmail.com',
            'password' => bcrypt('password'),
            'bio' => 'いちご',
            'images' => 'c.png',
        ]);

        DB::table('users')->insert([
            'username' => 'Dさん',
            'mail' => '444@gmail.com',
            'password' => bcrypt('password'),
            'bio' => 'ばなな',
            'images' => 'd.png',
        ]);

        DB::table('users')->insert([
            'username' => 'Eさん',
            'mail' => '555@gmail.com',
            'password' => bcrypt('password'),
            'bio' => 'すいか',
            'images' => 'e.png',
        ]);
           //
    }
}
