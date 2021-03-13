<?php

namespace Database\Seeders;
use DB;

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
  public function run()
    {
        DB::table('users')->insert([
        'name' => env('INITIAL_USER_NAME'),
        'email' => env('INITIAL_USER_EMAIL'),
        'password' => env('INITIAL_USER_PASSWORDHASH'),
        'is_admin' => 1
        ]);
  }
}
