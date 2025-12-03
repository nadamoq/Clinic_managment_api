<?php

namespace App\Observers;

use App\Models\Evaluation;
use App\Models\User;
use App\Notifications\EvalutedStudentNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class EvaluationObserver
{
    /**
     * Handle the Evaluation "created" event.
     */
    public function created(Evaluation $evaluation): void
    {
        //
        Log::alert('evaluation is made',[
            'id'=>$evaluation->id,
            'mark'=>$evaluation->mark,
            'supervisor_id'=>$evaluation->appointment->supervisor_id,
            'appointment_id'=>$evaluation->appointment_id
        ]);
        Notification::send(User::find($evaluation->appointment->student_id),new EvalutedStudentNotification($evaluation));
    }

    /**
     * Handle the Evaluation "updated" event.
     */
    public function updated(Evaluation $evaluation): void
    {
        //
    }

    /**
     * Handle the Evaluation "deleted" event.
     */
    public function deleted(Evaluation $evaluation): void
    {
        //
    }

    /**
     * Handle the Evaluation "restored" event.
     */
    public function restored(Evaluation $evaluation): void
    {
        //
    }

    /**
     * Handle the Evaluation "force deleted" event.
     */
    public function forceDeleted(Evaluation $evaluation): void
    {
        //
    }
}
