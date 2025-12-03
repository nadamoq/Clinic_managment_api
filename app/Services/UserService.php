<?php

namespace App\Services;

use App\Http\Requests\StoreReceptionistRequest;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\StoreSupervisorRequest;
use App\Http\Requests\StoreUserRequest;
use App\Jobs\StoreProfile;
use App\Models\Receptionist;
use App\Models\Student;
use App\Models\Supervisor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserService 
{

    public static function store(Request $request){

        $request->validate((new StoreUserRequest)->rules());

        match($request->role){

            'student' => $request->validate((new StoreStudentRequest)->rules()),
            'supervisor' => $request->validate((new StoreSupervisorRequest)->rules()),
            'receptionist' => $request->validate((new StoreReceptionistRequest)->rules()),
            'default' => null
        };
        
        $user=User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        $request['user_id'] = $user->id;
        
        StoreProfile::dispatch($user,$request->all());
          
        return $user;
    }
    
}