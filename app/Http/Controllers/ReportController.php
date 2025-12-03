<?php

namespace App\Http\Controllers;

use App\Exports\PatientReportExport;
use App\Imports\PatientImport;
use App\Imports\UserImport;
use App\Services\PatientFilterService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    //
    public function report(Request $request ,PatientFilterService $service){
        
        $data=$service->filterPatient($request->all())->get();

        return response()->json($data);

    }
    public function export(Request $request,PatientFilterService $service){

        return Excel::download(new PatientReportExport($request->all(),$service),"Patient.xlsx");

    }
    public function import(Request $request){

        if($request->validate(['file'=>'required|mimes:xlsx,xlx']))
        {
            Excel::import(new PatientImport,$request->file('file'));
            return response()->json('imported');
        }

         return response()->json('error');
    }
}
