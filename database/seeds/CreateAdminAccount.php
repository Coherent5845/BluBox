<?php

use Illuminate\Database\Seeder;

class CreateAdminAccount extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Modules\User\User::create(['login' => 'admin', 'password' => bcrypt('secret')]);
    }
}
