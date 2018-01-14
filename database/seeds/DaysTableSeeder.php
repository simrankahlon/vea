<?php

use Illuminate\Database\Seeder;
use App\Day;

class DaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Day::create(['days' => 'Sunday']); 
        App\Day::create(['days' => 'Monday']);
        App\Day::create(['days' => 'Tuesday']);
        App\Day::create(['days' => 'Wednesday']);
        App\Day::create(['days' => 'Thursday']);
        App\Day::create(['days' => 'Friday']);
        App\Day::create(['days' => 'Saturday']);
        
    }
}
