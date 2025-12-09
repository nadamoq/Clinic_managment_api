<?php
namespace App\Services;

use App\Models\Appointment;
use Carbon\Carbon;


class AppointmentSuggestionService{

    public function Suggest($date,$duration){
        
        $work_start=Carbon::parse($date.' 09:50');
        $work_end=Carbon::parse($date.' 23:59');
        
        $supervisor_id=auth()->user()->student->supervisor_id;

        $appointments=Appointment::pending()
                    ->where('supervisor_id',$supervisor_id)
                    ->where('date',$date)
                    ->orderBy('start_time')
                    ->get();
        
        $searchPoint=$work_start->copy();

        foreach($appointments as $appointment){

            $start_time=Carbon::parse($date." ".$appointment->start_time);
            $end_time=Carbon::parse($date." ".$appointment->end_time);

            if( $searchPoint->copy()->diffInMinutes($start_time,false) >= $duration  ){

                // if(!Appointment::conflict($date,$searchPoint,$searchPoint->copy()->addMinutes($duration),$supervisor_id)->exists()){
                    
                    return [

                    'start_time'=>$searchPoint->format('H:i'),
                    'end_time'=>$searchPoint->copy()->addMinutes($duration)->format('H:i')
                ];
                // }
               
            }  

            if($end_time->greaterThan($searchPoint)){
                 $searchPoint = $end_time->copy();
            }
            
        }
        if($searchPoint->diffInMinutes($work_end,false)>=$duration){

                 return [

                        'start_time'=>$searchPoint->format('H:i'),
                        'end_time'=>$searchPoint->copy()->addMinutes($duration)->format('H:i')
                ];
        }
        return null;
    }
}