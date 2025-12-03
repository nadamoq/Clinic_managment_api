<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSupervisorRequest;
use App\Http\Requests\UpdateSupervisorRequest;
use App\Models\Supervisor;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SupervisorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $supervisors=Supervisor::all();
        return response()->json($supervisors);

    }

   
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSupervisorRequest $request)
    {
        //
        $supervisor=Supervisor::create($request->all());
        return response()->json(['message'=>$supervisor?'created successfully':'error']
        ,$supervisor?Response::HTTP_OK:Response::HTTP_INTERNAL_SERVER_ERROR);

    }

    /**
     * Display the specified resource.
     */
    public function show(Supervisor $supervisor)
    {
        //
        return response()->json($supervisor);
    }

   

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSupervisorRequest $request, Supervisor $supervisor)
    {
        //
        $updated= $supervisor->update($request->validated());

       if($request->hasFile('image')){

        $result = $supervisor->upload($request->file('image'),'public');

        $supervisor->user->image()->updateOrCreate(['path'=>$result['path'],'alt_txt'=>'supervisor']);

       }

       return response()->json(['message'=>$updated?'profile updated successfully':'error']
       ,$updated?Response::HTTP_OK:Response::HTTP_INTERNAL_SERVER_ERROR);
          
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supervisor $supervisor)
    {
        //
        $supervisor->delete();
        return response()->json(['message'=>'deleted successfully']);
    }
}
