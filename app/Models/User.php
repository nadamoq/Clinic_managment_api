<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\HasNotificationActions;
use App\UploadImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    
    use HasFactory, Notifiable,HasApiTokens,HasNotificationActions,UploadImage;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    const ROLE_SUPERVISOR='supervisor';
    const ROLE_ADMIN='admin';
    const ROLE_RECEPTIONIST='receptionist';
    const ROLE_STUDENT='student';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];
    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function receptionist(){

        return $this->hasOne(Receptionist::class);

    }
     public function supervisor(){

        return $this->hasOne(Supervisor::class);

    }
     public function student(){

        return $this->hasOne(Student::class);
        
    }
    public function image(){

        return $this->morphOne(Image::class,'imageable');

    }
    public function isSupervisor(){

        return $this->role==self::ROLE_SUPERVISOR;

    }
      public function isStudent(){

        return $this->role==self::ROLE_STUDENT;

    }
      public function isReceptionist(){

        return $this->role==self::ROLE_RECEPTIONIST;

    }
      public function isAdmin(){

        return $this->role==self::ROLE_ADMIN;
        
    }
  
}
