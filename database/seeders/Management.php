<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class Management extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'nama' => 'Management',
                'email' => 'management@example.com',
                'password' => bcrypt('management123'),
                'id_level' => '1'
            ],
            [
                'nama' => 'Hotmaita Teresia M., A. Md.',
                'email' => 'hotmaita@smkprestasiprima.sch.id',
                'password' => bcrypt('stafftas'),
                'id_level' => '1'
            ],
            [
                'nama' => 'Santi Wahyuni, S.Pd.',
                'email' => 'santi@smkprestasiprima.sch.id',
                'password' => bcrypt('stafftas'),
                'id_level' => '1'
            ],
            [
                'nama' => 'Nurul Azizah, S.IP',
                'email' => 'nurulaz@smkprestasiprima.sch.id',
                'password' => bcrypt('stafftas'),
                'id_level' => '1'
            ],
            [
                'nama' => 'Mufti Ahmad Abdullah, S.Pd',
                'email' => 'Mufti@smkprestasiprima.sch.id',
                'password' => bcrypt('stafftas'),
                'id_level' => '1'
            ],
            [
                'nama' => 'Rifa Auliasari Churul’ain, S.Pd.',
                'email' => 'rifa@smkprestasiprima.sch.id',
                'password' => bcrypt('stafftas'),
                'id_level' => '1'
            ],
            [
                'nama' => 'Pembina Siswa',
                'email' => 'pembina@gmail.com',
                'password' => bcrypt('stafftas'),
                'id_level' => '1'
            ]
        ];

        foreach ($users as $key => $value) {
            User::create($value);
        }
    }
}
