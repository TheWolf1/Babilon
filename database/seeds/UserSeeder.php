<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::insert('insert into users (rol_id, name, email, password, telefono) values (?, ?, ?, ?, ?)', [1, 'Kevin Paz','pazortizkevindaniel@gmail.com',bcrypt('Loco2541003'),'2541003' ]);
    }
}
