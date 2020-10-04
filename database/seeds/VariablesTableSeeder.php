<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use Carbon\Carbon;

class VariablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker::create();

        // 10 personas
        for ($i=0; $i < 200; $i++) { 
            \DB::table('mediciones')->insert(array (
            'fecha'  => Carbon::now()->format('Y-m-d'),
            'hora'  => Carbon::now()->format('H:i:s'),
            'medicion'  => $i % 20 ,
            'lugar_id'  => '1',            
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ));
        }






    }
}
