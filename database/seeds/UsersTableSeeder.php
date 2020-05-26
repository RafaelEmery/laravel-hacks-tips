<?php

use Illuminate\Database\Seeder;
use App\Observers\UserObserver;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 1)->create();
    }
}
