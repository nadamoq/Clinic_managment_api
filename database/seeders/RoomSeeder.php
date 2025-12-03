<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $room=[
            [
                'name'=>'K100',
                'location'=>'first floor',
                'availabilty'=>true
            ],
            [
                'name'=>'K101',
                'location'=>'first floor',
                'availabilty'=>true
            ],
            [
                'name'=>'K102',
                'location'=>'first floor',
                'availabilty'=>false
            ],
            [
                'name'=>'K200',
                'location'=>'seconed floor',
                'availabilty'=>true
            ],
            
        ];
    }
}
