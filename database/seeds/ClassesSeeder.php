<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classes')->insert([
            'name'=>'Pemrograman Web A',
            'timedesc'=>'Senin, 08.00-09.40',
            'location' => 'FIKLAB 301',
            'image'=>'empty',
            'dosen_id'=>2
        ]);

        DB::table('classes')->insert([
            'name'=>'Pemrograman Web B',
            'timedesc'=>'Senin, 08.00-09.40',
            'location' => 'FIKLAB 302',
            'image'=>'empty',
            'dosen_id'=>3
        ]);

        DB::table('classes')->insert([
            'name'=>'Pemrograman Berorientasi Objek A',
            'timedesc'=>'Selasa, 10.00-11.40',
            'location' => 'FIKLAB 301',
            'image'=>'empty',
            'dosen_id'=>2
        ]);

        DB::table('classes')->insert([
            'name'=>'Pemrograman Berorientasi Objek B', 
            'timedesc'=>'Selasa, 10.00-11.40',
            'location' => 'FIKLAB 302',
            'image'=>'empty',
            'dosen_id'=>3
        ]);

        DB::table('classes')->insert([
            'name'=>'Pengolahan Citra Digital A',
            'timedesc'=>'Rabu, 13.00-14.40',
            'location' => 'FIKLAB 301',
            'image'=>'empty',
            'dosen_id'=>2
        ]);

        DB::table('classes')->insert([
            'name'=>'Pengolahan Citra Digital B',
            'timedesc'=>'Rabu, 13.00-14.40',
            'location' => 'FIKLAB 302',
            'image'=>'empty',
            'dosen_id'=>3
        ]);
    }
}
