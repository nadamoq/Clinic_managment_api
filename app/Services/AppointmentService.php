<?php

namespace App\Services;

use App\Events\AppointmentCreated;
use App\Models\Appointment;
use App\Models\Patient;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;

class AppointmentService
{
    public $data;
    public $patient;
    public $user;

    public function delete( Appointment $appointment ){

         if($appointment->isPending())
        {
            $result= $appointment->delete();
            return $result?['message'=>'Appointment deleted successfully','status'=>Response::HTTP_OK]
            :['message'=>'sth went wrong','status'=>Response::HTTP_INTERNAL_SERVER_ERROR];
        }

        return ['messgae'=>'only pending appointments can be deleted','status'=>Response::HTTP_METHOD_NOT_ALLOWED];
    }
    public  function create(array $data){

            $this->user=auth()->user();
            $this->data=$data;
            
            //student check
        
           if($result = $this->studentLimit()) return $result;

            //check patient

            if($result = $this->patientLimit()) return $result;

            //appointment booking

            $this->data['supervisor_id']=$this->user->student->supervisor_id;
            if($result=$this->checkConflict()) return $result;

            //email for patient

            $this->data['student_id']=$this->user->id;      
            $this->data['status']='pending';

            $created=Appointment::create($this->data);
            AppointmentCreated::dispatch($created);
            
            return ($created)?
            ['message'=> "appointment booked successfully on {$this->data['date']} at {$this->data['start_time']} .",
            'status' => Response::HTTP_CREATED]
            :
            ['message' => 'sth went wrong',
            'error' => Response::HTTP_INTERNAL_SERVER_ERROR
            ];
    }
    public function update(array $data ,Appointment $appointment)  {

        if(!$appointment->isPending()){

            return ['message'=>'only pending appointments can be updated',
                    'status'=>Response::HTTP_METHOD_NOT_ALLOWED];
        }

        
        $this->user=auth()->user();
        $this->data=$data;  
        $this->patient=Patient::findOrFail($this->data['patient_id']); 
        $this->data['supervisor_id'] = $this->user->student->supervisor_id;

        if($result=$this->checkConflict()) return $result;

        $result= $appointment->update($data);
        return ($result)?['message'=>'Appointment updated successfully','status'=>Response::HTTP_OK]:
        ['message'=>'update failed','status'=>Response::HTTP_BAD_REQUEST];
        
    }
    protected  function patientLimit(){

        $this->patient=Patient::findOrFail($this->data['patient_id']); 

            if($this->patient->appointment)
            {
                return ['message'=>'This patient is already booked','status' => Response::HTTP_CONFLICT] ;
            };
        return null;

    }
    protected  function studentLimit(){

        $pendingAppointment=Appointment::pending()->where('student_id',$this->user->id)->count();
        
            if( $pendingAppointment >= 2){

                return ['message'=>'You have reached the limit','status' => Response::HTTP_TOO_MANY_REQUESTS];

            }; 
        return null;
    }
    protected  function checkConflict(){

            $duration=$this->patient->procedure->duration_minutes; 
           
            $start_time=Carbon::createFromFormat('H:i',$this->data['start_time']);
            $end_time=$start_time->copy()->addMinutes($duration);
            $this->data['end_time']=$end_time->format('H:i');
            $conflict=Appointment::
                      conflict($this->data['date'],$this->data['start_time'],$this->data['end_time'],$this->data['supervisor_id'])
                      ->exists();

            if($conflict){
                return ['message'=>"Conflict with other's appointment",'status'=>Response::HTTP_CONFLICT];
            }
            
           
            return null;
    }
    

}