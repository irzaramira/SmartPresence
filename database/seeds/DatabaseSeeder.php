<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(ClassesSeeder::class);
        $this->call(UserClassesSeeder::class);
        $this->call(PertemuanSeeder::class);
        $this->call(AbsenSeeder::class);
    }
}
