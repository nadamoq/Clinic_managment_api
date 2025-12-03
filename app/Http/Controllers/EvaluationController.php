<?php

namespace App\Http\Controllers;

use App\Actions\EvaluateAppointmentAction;
use App\Http\Requests\StoreEvaluationRequest;
use App\Http\Requests\UpdateEvaluationRequest;
use App\Models\Evaluation;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Symfony\Component\HttpFoundation\Response;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
      use AuthorizesRequests;
      
    public function index()
    {
        //
        $this->authorize('viewAny');
        $evaluation=Evaluation::all();
        return response()->json($evaluation);

    }

   
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEvaluationRequest $request,EvaluateAppointmentAction $action)
    {
         $this->authorize('create',Evaluation::class);
        return $action->execute($request->validated());

    }

    /**
     * Display the specified resource.
     */
    public function show(Evaluation $evaluation)
    {
        //
        $this->authorize('view',$evaluation);
        return response()->json($evaluation);
    }

  
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEvaluationRequest $request, Evaluation $evaluation)
    {
        //
        $this->authorize('update',$evaluation);

        if(!$evaluation->checkOlderPreviousMonth()){

            $updated= $evaluation->update($request->validated());

            return response()->json(['message'=>$updated?'updated successfuly':'error'],
            $updated?Response::HTTP_OK:Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response(['message'=>'reported marks can not be updated']);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evaluation $evaluation)
    {
        //
        $this->authorize('delete',$evaluation);

        if(!$evaluation->checkOlderPreviousMonth()){

            $evaluation->delete();
            return response()->json(['message'=>'deleted successfuly']);
            
        }
        return response(['message'=>'reported marks can not be deleted']);
        
    }
}
