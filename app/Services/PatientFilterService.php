<?php

namespace App\Services;

use App\Filters\PatientFilter;
use App\Models\Patient;

class PatientFilterService
{   
    public function filterPatient($filters)
    {   
    
        $query =Patient::query();

        $filter=new PatientFilter();
       
        $query= $filter->apply($query,$filters);

        return $query;

    }
}