<?php

namespace App\Notifications;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SupervisorAppointmentNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $appointment;

    public function __construct(Appointment $appointment)
    {
        //
        $this->appointment=$appointment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    // public function toMail(object $notifiable): MailMessage
    // {
    //     return (new MailMessage)
    //         ->line('The introduction to the notification.')
    //         ->action('Notification Action', url('/'))
    //         ->line('Thank you for using our application!');
    // }

   public function toDatabase(object $notifiable)
    {
        return [
            'supervisor_id'=>$notifiable->id,
            'appointment_id'=>$this->appointment->id,
            'student_id'=>$this->appointment->student_id,
            'student_name'=>$this->appointment->student->name,
            'start_time'=>$this->appointment->start_time,
            'end_time'=>$this->appointment->end_time,
            'date'=>$this->appointment->date,
        ];
    }
   
    
}
