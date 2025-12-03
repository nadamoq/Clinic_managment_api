<?php

namespace App\Notifications;

use App\Models\Evaluation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EvalutedStudentNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $evaluation;

    public function __construct(Evaluation $evaluation)
    {
        //
        $this->evaluation=$evaluation;
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
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable)
    {
        return [
            //
            'Student_id'=>$notifiable->id,
            'student_name'=>$notifiable->name,
            'mark'=>$this->evaluation->mark,
            'appointment'=>$this->evaluation->appointment
        ];
    }
}
