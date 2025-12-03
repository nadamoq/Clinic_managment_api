<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Models\Patient;
use App\Services\PatientService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Request;

use Symfony\Component\HttpFoundation\Response;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use AuthorizesRequests;

    public $service;

    public function __construct(PatientService $service)
    {
        $this->service = $service;
    }


    public function index(Request $request)
    {
        //
        $patient=$this->service->list($request->all());

        return response()->json($patient);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePatientRequest $request)
    {
        //
        $patient=$this->service->store($request->validated());
      
        return response()->json( $patient->load('image') , Response::HTTP_CREATED );
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        //
        $this->authorize('view',$patient);

        return response()->json($patient??Response::HTTP_NOT_FOUND); 
    }

 
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePatientRequest $request, Patient $patient)
    {
        //
        $updated=$this->service->update($patient,$request->validated());

        return response()->json(['message'=>$updated?'Updated successfully':'Error']
        ,$updated?Response::HTTP_OK:Response::HTTP_INTERNAL_SERVER_ERROR);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        //
        $deleted=$this->service->delete($patient);
        return response()->json(['message'=>$deleted>0?'Deleted successfully':'Error']
        ,$deleted>0?Response::HTTP_OK:Response::HTTP_INTERNAL_SERVER_ERROR);
   
    }
}
