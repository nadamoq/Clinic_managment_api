<?php

namespace App\Listeners;

use App\Events\AppointmentCreated;
use App\Models\Patient;
use App\Notifications\PatientAppointmentNotification;
use App\Notifications\SupervisorAppointmentNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class AppointmentNotificationListener
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
       
        Notification::send($event->appointment->supervisor,new SupervisorAppointmentNotification($event->appointment));
        Notification::send($event->appointment->patient,new PatientAppointmentNotification($event->appointment));
    }
}
