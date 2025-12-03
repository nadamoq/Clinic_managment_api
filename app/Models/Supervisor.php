<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Supervisor extends Model
{
    //
    use Notifiable;
    protected $fillable=[
        
        'university_degree',
        'address',
        'specialty',
        'user_id'
    ];
    
    public function user(){

        return $this->belongsTo(User::class);
        
    }
    public function students(){

        return $this->hasMany(Student::class);

    }
     public function appointments(){

        return $this->hasMany(Appointment::class);

    }
    

}
