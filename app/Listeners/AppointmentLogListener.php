<?php

namespace App\Listeners;

use App\Events\AppointmentCreated;

use Illuminate\Support\Facades\Log;

class AppointmentLogListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AppointmentCreated $event): void
    {
        //
        $appointment=$event->appointment;
        
        Log::info(" new Appointment created ",[
            
            'id' => $appointment->id,
            'patient' => $appointment->patient_id,
            'student' => $appointment->student_id,
            'supervisor' => $appointment->supervisor_id,
            'date' => $appointment->date,
            'start_time' => $appointment->start_time,
            'end_time' => $appointment->end_time,

        ]);
    }
}
