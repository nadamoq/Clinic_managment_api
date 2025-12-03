<?php

namespace App\Actions;


use App\Models\Appointment;
use App\Models\Evaluation;
use App\Models\User;
use App\Notifications\EvalutedStudentNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Symfony\Component\HttpFoundation\Response;
class EvaluateAppointmentAction
{


    public function execute($data){
                   
        $appointment=Appointment::findOrFail($data['appointment_id']);

        if(!$appointment->isCompleted()) {
            
            return response()->json(['message'=>"Appointment is $appointment->status ,can't be evaluated"]
                ,Response::HTTP_METHOD_NOT_ALLOWED);
        }
        DB::transaction(function () use ($data,$appointment,&$created) {
        
            $created=Evaluation::create($data);
            $appointment->update(['evaluated'=>true]);
        
        });
        
        
         return response()->json(['message'=>$created?" Evaluated Successfully ":'error'],
        $created?Response::HTTP_CREATED:Response::HTTP_BAD_REQUEST);

     
    }
}