<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Student extends Model
{
    //
 
    
    protected $fillable=[
        'gender',
        'birth',
        'mobile',
        'supervisor_id',
        'user_id'
    ];
  

     public function user(){

        return $this->belongsTo(User::class);

    }
    public function supervisor(){

        return $this->belongsTo(Supervisor::class);
        
    }
    public function appointments(){

        return $this->hasMany(Appointment::class,'student_id');

    }
   
    
    
}
