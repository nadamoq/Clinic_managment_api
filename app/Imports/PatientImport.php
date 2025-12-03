<?php

namespace App\Imports;

use App\Http\Requests\StorePatientRequest;

use App\Models\Patient;


use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use PhpOffice\PhpSpreadsheet\Shared\Date;

class PatientImport implements ToModel ,WithHeadingRow 
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {   
        $birthDate = null;
        
        if (isset($row['birth']) && is_numeric($row['birth'])) {

            try {

             //because excel return date value as Numeric Sequence (we need to convert it to date Object)
                $birthDate=Date::excelToDateTimeObject($row['birth'])->format('Y-m-d');
             
            } catch (\Exception $e) {
              
                return null; 
            }

        } else {
          
            $birthDate = $row['birth'];
        }
        return Patient::firstOrCreate(
            [   
               'name'=>$row['name'],               
                'email'=>$row['email'],
                'birth'=>$birthDate,
                'diabetes'=>$row['diabetes'],
                'gender'=>$row['gender'],
                'Blood_type'=>$row['blood_type'],
                'procedure_id'=>$row['procedure_id'],
                'receptionist_id'=>$row['receptionist_id'],
              
            ]
        );
    }

}
