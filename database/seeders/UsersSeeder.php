<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert("INSERT INTO users (id, nama, username, email, password, no_telp, provinsi_id, kabupaten_id, status, alamat_lengkap, level_user) VALUES
        (1, 'Admin', 'admin', 'admin@gmail.com', '" . bcrypt('admin') ."', null, null, null, 'Aktif', 'Kota Mojokerto', 'Admin'),
        (2, 'Adham', 'adham', 'adhamnugroho9@gmail.com', '" . bcrypt('12345') . "', '081217879476', 35, 1115, 'Aktif', 'Kota Mojokerto, Cakarayam', 'Pengguna')
        ");
    }
}
