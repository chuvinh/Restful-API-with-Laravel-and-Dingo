<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $email = 'admin@example.com';

        if(User::where('email', $email)->exists()){
            echo 'User already exists'.PHP_EOL;
            return;
        }

        $user = factory(User::class)->times(1)->create([
            'email' =>  $email,
        ])->first();

        $adminRole = \App\Models\Auth\Role::where('name', 'root')->first();
        $user->attachRole($adminRole);

        echo "Admin created".PHP_EOL;
    }
}
