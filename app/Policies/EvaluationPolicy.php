<?php

namespace App\Policies;

use App\Models\Evaluation;
use App\Models\Receptionist;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EvaluationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {   
       return($user->isSupervisor()||$user->isAdmin());
       
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Evaluation $evaluation): bool
    {   
       return match ($user->role) {

                User::ROLE_STUDENT   => $evaluation->appointment->student_id == $user->id,
                User::ROLE_SUPERVISOR => $evaluation->appointment->supervisor->user_id == $user->id,
                User::ROLE_ADMIN     => true,
                default              => false,
            };

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {

       return($user->isSupervisor()||$user->isAdmin());
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Evaluation $evaluation): bool
    {
         return match ($user->role) {
        
              
                User::ROLE_SUPERVISOR => $evaluation->appointment->supervisor->user_id == $user->id,
                User::ROLE_ADMIN     => true,
                default              => false,
            };
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Evaluation $evaluation): bool
    {
         return match ($user->role) {
        
                
                User::ROLE_SUPERVISOR => $evaluation->appointment->supervisor->user_id == $user->id,
                User::ROLE_ADMIN     => true,
                default              => false,
            };
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Evaluation $evaluation): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Evaluation $evaluation): bool
    {
        return false;
    }
}
