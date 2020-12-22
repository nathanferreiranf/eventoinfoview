<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class AdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = [];

        array_push($rows, [
            'id' => Str::uuid(),
            'name' => 'Gotec',
            'email' => 'gotec@gotec.com.br',
            'password' => Hash::make('go102030@@'),
            'created_at' => date('Y-m-d H:m:s')
        ]);

        array_push($rows, [
            'id' => Str::uuid(),
            'name' => 'Cristiane',
            'email' => 'cristiane@iview.com.br',
            'password' => Hash::make('cris102030@@'),
            'created_at' => date('Y-m-d H:m:s')
        ]);

        DB::table('admins')->insert($rows);
    }
}
