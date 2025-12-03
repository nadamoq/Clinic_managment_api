<?php

namespace Database\Seeders;

use App\Models\Procedure;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProcedureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $procedures=[
                        'filling'=>[
                            'name'=>'filling',
                            'description'=>'filling tooth',
                            'duration_minutes'=>'50',
                            'price'=>50
                            ]
                            ,
                        'nerve'=>[
                            'name'=>'nerve',
                            'description'=>'filling tooth',
                            'duration_minutes'=>'30',
                            'price'=>70
                            ],
                        'cleaning'=>[
                            'name'=>'cleaning',
                            'description'=>'cleaning teeth',
                            'duration_minutes'=>'20',
                            'price'=>10
                            ],
                        'diagnose'=>[
                            'name'=>'diagnose',
                            'description'=>'diagnose and regester',
                            'duration_minutes'=>'15',
                            'price'=>0
                            ]
                    ];
        
        foreach($procedures as $item){

            Procedure::create($item);

        }
    }
}
