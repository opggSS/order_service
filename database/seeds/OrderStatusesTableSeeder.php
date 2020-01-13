<?php

use Illuminate\Database\Seeder;

class OrderStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('order_statuses')->insert([
            [
            'status_name' => 'created'
            ],
           
            [
            'status_name' => 'cancelled'
            ],

            [
            'status_name' => 'completed'
            ]    
        ]);
    }
}

