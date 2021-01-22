<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PertemuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pertemuans')->insert([
            'classes_id'=>'1',
            'name'=>'Pertemuan 1 - Pengenalan HTML',
            'date_start'=>'2020-09-14 10:00:00',
            'date_end'=>'2020-09-14 11:40:00'
        ]);

        // DB::table('pertemuans')->insert([
        //     'classes_id'=>'1',
        //     'name'=>'Pertemuan 2 - HTML',
        //     'date_start'=>'2020-09-21 10:00:00',
        //     'date_end'=>'2020-09-21 11:40:00'
        // ]);

        // DB::table('pertemuans')->insert([
        //     'classes_id'=>'1',
        //     'name'=>'Pertemuan 3 - HTML Form',
        //     'date_start'=>'2020-09-28 10:00:00',
        //     'date_end'=>'2020-09-28 11:40:00'
        // ]);
    }
}
