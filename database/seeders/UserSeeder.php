<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'debali',
                'email' => 'wynbedag@debali.com',
                'password' => bcrypt('asdasdasd'),
            ]
        ];

        foreach ($users as $key => $user) {
            User::updateOrCreate([
                'email' => $user['email']
            ], $user);
        }
    }
}
