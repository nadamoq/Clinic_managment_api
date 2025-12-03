<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;

use Illuminate\Http\Response;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $students=Student::all();
        return response()->json($students);
    }

 

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        //
        $student= Student::create($request->validated());
        return response()->json(['message'=>"created Successfuly $student"]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
        return response()->json($student);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        //
        
       $updated= $student->update($request->validated());

       if($request->hasFile('image')){

        $result = $student->user->upload($request->file('image'),'public');

        $student->image()->updateOrCreate(['path'=>$result['path'],'alt_txt'=>'student']);

       }

       return response()->json(['message'=>$updated?'profile updated successfully':'error']
       ,$updated?Response::HTTP_OK:Response::HTTP_INTERNAL_SERVER_ERROR);
          

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
        $student->delete();
        return response()->json(['message'=>'deleted successfully']);
    }
}
