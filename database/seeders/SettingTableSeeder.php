<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('setting')->insert(array(
            [
                'nama_perusahaan' => 'LaMart',
                'alamat' => 'Jl. Jamblang No. 21A Srengseng sawah, JakSel',
                'telepon' => '081806781447',
                'logo' => 'logo.png',
                'kartu_member' => 'card.png',
                'diskon_member' => '10',
                'tipe_nota' => '0'
            ]
            ));
    }
}
