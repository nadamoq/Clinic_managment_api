<?php

namespace App\Actions;

use App\Models\Appointment;

class GetAllAppointmentAction
{
    public function  execute()  {

          if(auth()->user()->isStudent()){

            $appointments= Appointment::where('student_id',auth()->user()->id)->get();

        }elseif(auth()->user()->isSupervisor()){

            $appointments=Appointment::where('supervisor_id',auth()->user()->supervisor->id)->get();

        }else{

            $appointments=Appointment::all();
        }
        return $appointments;
        
    }
}