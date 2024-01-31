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
                'nama' => 'User',
                'email' => 'user@example.com',
                'password' => bcrypt('user123'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Irham Azhari Aulia, S.Kom',
                'email' => 'irham@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Roby Arwanto, S.Kom.',
                'email' => 'roby@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Cahyoko Triharsatmo, S.Ds.',
                'email' => 'cahyoko@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Dwi Yuliasari, S.Sn',
                'email' => 'dwiyuli@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Adeline Afigar, A.Md',
                'email' => 'adeline@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Sopan Sopari, S.Kom., M.M',
                'email' => 'sopans@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Abdul Mukhlis, A.Md. Kom',
                'email' => 'abdul@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Agung Nugroho, S.Kom',
                'email' => 'agung@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Agus Nugraha, S.Kom',
                'email' => 'agus@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Alya Ghina Luthfiyyah, S.Pd.',
                'email' => 'aluthfiyyah@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Andika Septiantoro, S.Ds',
                'email' => 'septiantoro@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Azzahra Dhella Safitri, S. Pd',
                'email' => 'azzahra@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Bhilly Nurhakim, S.T., M.Pd.',
                'email' => 'bhilly@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Bobi Heri Yanto, M.Kom.',
                'email' => 'byanto@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Dinda Karunia Putri, S.Pd.',
                'email' => 'dputri@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Farah Wanodyatama, S. Pd',
                'email' => 'farah@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Febriliantoro Kamandalu, S.Sn',
                'email' => 'febri@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Ivan Kevin Mula Karya, S.Pd.',
                'email' => 'imulia@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Khoirunnisa, S. Pd',
                'email' => 'khoirunnisa@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Laras Wulandari, S.I.Kom',
                'email' => 'laras@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Leny, S.Pd.',
                'email' => 'leny@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'M. Reza Saputra, S.H.',
                'email' => 'msaputra@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Marsaktian Y E Saip, SE.',
                'email' => 'marsaktian@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Mita Chadijahtul Aulia S, S.Pd',
                'email' => 'mitaaulia@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Mutmainnah, S.Pd',
                'email' => 'mutmainnah@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Nurlaela Widyasari, S.Pd',
                'email' => 'nurlaela@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Rayana Fitriawan, S.Pd.',
                'email' => 'rayana@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Reinhard Pratama, S.Pd',
                'email' => 'reinhard@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Resa Arya Putra, S.Kom.',
                'email' => 'rputra@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Ricky Hidayat Lubis, S.Ds',
                'email' => 'rickyhidayat@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Ridwan Syah, S.Kom.',
                'email' => 'ridwansyah@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Riyadh Rizqullah, S.Kom',
                'email' => 'riyadh@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Salasa Murni Izha Nurbayity, S.I.Kom',
                'email' => 'sizha@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Sapta Nur Faiz, S.Pd.',
                'email' => 'sapta@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Sarudin, S.Pd',
                'email' => 'sarudin@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Selly Apriliana, S.Pd',
                'email' => 'selly@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Seni Litya Kassa, S. Pd',
                'email' => 'seni@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Silviana Eka Dewi Hapsari, S.Pd',
                'email' => 'silvianaeka@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'M Faris Fajar Muslim, S.Tr. Ds',
                'email' => 'farisfajar@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Singgih Kurniawan, S.Pd',
                'email' => 'singgih@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Siyoin Sipahutar, S.Pd',
                'email' => 'siyoin@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Supriyanto, S.Pd., M.Hum',
                'email' => 'supriyanto@smkpretasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Syahrul Ramadhan, S.Pd.',
                'email' => 'syahrul@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Tiwi Maylani, S.Pd',
                'email' => 'tiwi@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Veni Agave Hutajulu, S.Pd',
                'email' => 'veni@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Wastoni, S. Pd. I.',
                'email' => 'wastoni@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Yance, S.Pd.',
                'email' => 'yance@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Yeni Lestari, S.Pd',
                'email' => 'yeni@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Yoni Esa Mahendra, S.Kom',
                'email' => 'yoni@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Zaidan Elvantio, S.Kom',
                'email' => 'zaidan@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Muhamad Ichsan, A.Md.',
                'email' => 'Ichsan@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'I Gede Adi Pratama, S.Kom.',
                'email' => 'adi@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Nur Ela, S.Pd.',
                'email' => 'ela@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ],
            [
                'nama' => 'Muhammad Irfany Ananda, S. Pd.',
                'email' => 'irfani@smkprestasiprima.sch.id',
                'password' => bcrypt('ppsmk'),
                'id_level' => '2'
            ]
        ];

        foreach ($users as $key => $value) {
            User::create($value);
        }
    }
}
