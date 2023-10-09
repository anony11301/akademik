<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'email' => 'guru@gmail.com',
                'password' => bcrypt ('123'),
                'id_level' => '2'
            ]      
        ];

        foreach ($users as $key => $value) {
            User::create($value);
        }
    }
}
