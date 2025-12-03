<?php

namespace App\Jobs;

use App\Models\Receptionist;
use App\Models\Student;
use App\Models\Supervisor;
use App\Models\User;
use App\UploadImage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class StoreProfile implements ShouldQueue
{
    use Queueable,UploadImage;

    /**
     * Create a new job instance.
     */
    protected $user;
    protected $data;
    public function __construct(User $user,$data)
    {
        //
        $this->user=$user;
        $this->data=$data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
       $profile= match($this->user->role){

            'student' => Student::create($this->data),
            'supervisor' => Supervisor::create($this->data),
            'receptionist' => Receptionist::create($this->data),
            'default'=>null

            };
            
        if ($profile === null) {
       
            Log::error(" Failed to create profile for user: {$this->user->id} with role: {$this->user->role} ");
            return ;
        }

         $this->user->image->create(['alt_txt'=>'profile Image','path'=>'userProfile/male.jpg']);
    }
}
