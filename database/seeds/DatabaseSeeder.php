<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    protected $toTruncate = [
        'users',
        'batch_day',
        'days'];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        foreach($this->toTruncate as $table){
    		DB::table($table)->truncate();	
    	}
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        $this->call(UsersTableSeeder::class);
        $this->call(DaysTableSeeder::class);
        
    }
}

