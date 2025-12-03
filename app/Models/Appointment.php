<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Appointment extends Model
{
    //
    protected $fillable=[
        'date',
        'start_time',
        'end_time',
        'status',
        'evaluated',
        'supervisor_id',
        'patient_id',
        'student_id',
        'room_id'
    ];

      public function student(){

        return $this->belongsTo(Student::class,'student_id','user_id');

     }
       public function supervisor(){

         return $this->belongsTo(Supervisor::class);

        }
       public function patient(){

            return $this->belongsTo(Patient::class);

       }
       public function evaluation(){

            return $this->hasOne(Evaluation::class);
        
        }   
       public function room() {

           return $this->belongsTo(Room::class);

        }
        public function scopePending($query){

            return $query->where('status','pending');
        
        }
        public function scopeConflict($query,$date,$start ,$end ,$supervisor_id){
            return $query->where('date',$date)
            ->where('supervisor_id',$supervisor_id)
            ->where(function($q) use ($start,$end){
                    $q->where('start_time', '<', $end)
                    ->where('end_time', '>', $start);
            });
        }
        public function isPending(){

            return  $this->status=='pending';

        }
        public function isCompleted(){

            return  $this->status=='completed';

        }
}
