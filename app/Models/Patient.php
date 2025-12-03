<?php

namespace App\Models;

use App\Policies\PatientPolicy;
use App\UploadImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
#[UsePolicy(PatientPolicy::class)]
class Patient extends Model
{
    use Notifiable ,UploadImage;
    //
    protected $fillable =[
        'name',
        'email',
        'birth',
        'diabetes',
        'gender',
        'Blood_type',
        'procedure_id',
        'receptionist_id',
                            
    ];
    
    public function procedure(){

        return $this->belongsTo(Procedure::class);

    }
     public function receptionist(){

        return $this->belongsTo(Receptionist::class);
        
    }
     public function appointment(){

        return $this->hasOne(Appointment::class);

    }
    public function image(){

        return $this->morphOne(Image::class,'imageable');

    }
    public function getFeeAttribute(){

        return $this->procedure?->price;
        
    }
}
