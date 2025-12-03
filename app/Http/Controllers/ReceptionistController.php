<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReceptionistRequest;
use App\Http\Requests\UpdateReceptionistRequest;
use App\Models\Receptionist;
use App\Models\Supervisor;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReceptionistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $receptionists=Receptionist::all();
        return response()->json($receptionists);
    }

    
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReceptionistRequest $request)
    {
        //
        $receptionist=Supervisor::create($request->validated());
        return response()->json(['message'=>$receptionist?'created successfully':'error']
        ,$receptionist?Response::HTTP_OK:Response::HTTP_INTERNAL_SERVER_ERROR);

    }

    /**
     * Display the specified resource.
     */
    public function show(Receptionist $receptionist)
    {
        //
        return response()->json($receptionist);
    }

  

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReceptionistRequest $request, Receptionist $receptionist)
    {
        //
        $updated= $receptionist->update($request->validated());

        if($request->hasFile('image')){

            $result = $receptionist->upload($request->file('image'),'public');

            $receptionist->image()->updateOrCreate(['path'=>$result['path'],'alt_txt'=>'student']);

        } 

        return response()->json(['message'=>$updated?'profile updated successfully':'error']
        ,$updated?Response::HTTP_OK:Response::HTTP_INTERNAL_SERVER_ERROR);
          

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Receptionist $receptionist)
    {
        //
        $receptionist->delete();
        return response()->json(['message'=>'deleted successfully']);
    }
}
