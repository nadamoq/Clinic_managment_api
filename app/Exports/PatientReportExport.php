<?php

namespace App\Exports;

use App\Models\Patient;
use App\Services\PatientFilterService;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PatientReportExport implements FromCollection , WithHeadings ,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $filters;
    public $service;
    public function __construct($filters ,PatientFilterService $service)
    {
        $this->filters=$filters;
        $this->service=$service;
    }
    public function collection()
    { 
        $patient= $this->service->filterPatient($this->filters);
        return $patient->get();
    }
    public function headings(): array
    {
        return [
            'name',
            'email',
            'birth',
            'diabetes',
            'gender',
            'Blood_type',
            'procedure_id',
            'receptionist_id',
        ];

    }
    public function map($row): array
    {
        return [
            $row->name,
            $row->email,
            $row->birth,
            $row->diabetes,
            $row->gender,
            $row->Blood_type,
            $row-> procedure_id,
            $row->receptionist_id?? 0

        ];
    }
}
