<?php

namespace App\Http\Controllers;

use App\Actions\GetAllAppointmentAction;

use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\SuggestAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Appointment;
use App\Models\Patient;
use App\Services\AppointmentService;
use App\Services\AppointmentSuggestionService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Request;
use Symfony\Component\HttpFoundation\Response;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     use AuthorizesRequests;

    public function index(GetAllAppointmentAction $action)
    {
        //
        $this->authorize('viewAny',Appointment::class);
        $appointments = $action->execute();
        return response()->json($appointments);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAppointmentRequest $request,AppointmentService $appointmentService)
    {
        $this->authorize('create',Appointment::class);
        $result =$appointmentService->create($request->validated());  
        return response()->json(['message'=>$result['message']],$result['status']);
       
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        //
        $this->authorize('view',$appointment);
        return response()->json($appointment??Response::HTTP_NOT_FOUND);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAppointmentRequest $request, Appointment $appointment,AppointmentService $service)
    {
        $this->authorize('update',$appointment);
        $result=$service->update($request->validated(),$appointment);
        return response()->json($result['message'],$result['status']);   
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment,AppointmentService $service)
    {
        //
        $this->authorize('delete',$appointment);
        $result=$service->delete($appointment);
        return response()->json($result['message'],$result['status']);  

    }
    public function suggest(SuggestAppointmentRequest $request,AppointmentSuggestionService $service){
        
        $patient=Patient::findOrFail($request->patient_id);
        $suggested=$service->Suggest($request->date,$patient->procedure->duration_minutes);

        return response()->json($suggested);

    }
}
