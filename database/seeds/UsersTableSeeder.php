<?php

use Illuminate\Database\Seeder;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $anurag = App\User::create(['name' => 'Simran Kahlon', 'email' => 'simran.kahlon@atos.net', 'password'=> bcrypt('Pass@123')]); 
        
    }
}
