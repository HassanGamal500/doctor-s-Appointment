<?php

use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('administrations')->insert([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'phone' => '01010101010',
            'password' => Hash::make('admin123'),
            'type' => 1
        ]);
    }
}
