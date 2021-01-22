<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DOSEN

        DB::table('userclasses')->insert([
            'user_id'=>'2',
            'classes_id'=>'1'
        ]);

        DB::table('userclasses')->insert([
            'user_id'=>'2',
            'classes_id'=>'3'
        ]);

        DB::table('userclasses')->insert([
            'user_id'=>'2',
            'classes_id'=>'5'
        ]);
        
        DB::table('userclasses')->insert([
            'user_id'=>'3',
            'classes_id'=>'2'
        ]);

        DB::table('userclasses')->insert([
            'user_id'=>'3',
            'classes_id'=>'4'
        ]);

        DB::table('userclasses')->insert([
            'user_id'=>'3',
            'classes_id'=>'6'
        ]);
        
        //MAHASISWA
        DB::table('userclasses')->insert([
            'user_id'=>'4',
            'classes_id'=>'1'
        ]);

        DB::table('userclasses')->insert([
            'user_id'=>'4',
            'classes_id'=>'4'
        ]);

        DB::table('userclasses')->insert([
            'user_id'=>'4',
            'classes_id'=>'5'
        ]);
        
        DB::table('userclasses')->insert([
            'user_id'=>'5',
            'classes_id'=>'2'
        ]);

        DB::table('userclasses')->insert([
            'user_id'=>'5',
            'classes_id'=>'3'
        ]);

        DB::table('userclasses')->insert([
            'user_id'=>'5',
            'classes_id'=>'6'
        ]);
    }
}
