<?php

namespace App\Filters;

class PatientFilter
{
    
    public function apply($query,$filters)
    {   
        if(isset($filters['name'])){

            $query->where('name','like',"%".$filters['name']."%");
        }
        if ( isset($filters['gender']) ){

            $query->where('gender',$filters['gender']);

        }
        if(isset($filters['diabetes']))
        {
            $query->where('diabetes',$filters['diabetes']);

        }
           if(isset($filters['procedure_id']))
        {
            $query->where('procedure_id',$filters['procedure_id']);

        }
           if(isset($filters['blood_type']))
        {
            $query->where('blood_type',$filters['blood_type']);

        }
          if(auth()->user()->isStudent()){

            $query->whereDoesntHave('appointment');

        }
        return $query;
    }


}