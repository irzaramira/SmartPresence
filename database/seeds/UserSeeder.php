<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'admin',
            'email'=>'admin@upnvj.ac.id',
            'username'=>'admin',
            'password'=>Hash::make('admin'),
            'image'=>'empty',
            'role'=>'admin'
            ]);
            
        User::create([
            'name'=>'dosen1',
            'email'=>'dosen1@upnvj.ac.id',
            'username'=>'0000000001',
            'password'=>Hash::make('12345'),
            'image'=>'empty',
            'role'=>'dosen'
            ]);

        User::create([
            'name'=>'dosen2',
            'email'=>'dosen2@upnvj.ac.id',
            'username'=>'0000000002',
            'password'=>Hash::make('12345'),
            'image'=>'empty',
            'role'=>'dosen'
            ]);

        User::create([
            'name'=>'mahasiswa1',
            'email'=>'mahasiswa1@upnvj.ac.id',
            'username'=>'1810511001',
            'password'=>Hash::make('12345'),
            'image'=>'empty',
            'role'=>'mahasiswa'
            ]);
        
        User::create([
            'name'=>'mahasiswa2',
            'email'=>'mahasiswa2@upnvj.ac.id',
            'username'=>'1810511002',
            'password'=>Hash::make('12345'),
            'image'=>'empty',
            'role'=>'mahasiswa'
            ]);
    }
}
