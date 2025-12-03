<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receptionist extends Model
{
    //
    protected $fillable=[
        
        'office_number',
        'location',
        'user_id'   
    ];
    

     public function user(){

        return $this->belongsTo(User::class);

    }
     public function patients(){

        return $this->hasMany(Patient::class);
        
    }
}
