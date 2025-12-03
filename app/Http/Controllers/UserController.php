<?php

namespace App\Http\Controllers;


use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
       $users= User::all();
        return response()->json($users);
    }

    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
       
        $user=UserService::store($request);
        return response()->json(['message'=>$user?"User created :$user":'error'],
        $user?Response::HTTP_CREATED:Response::HTTP_BAD_REQUEST);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json($user);

    }

  

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
       $updated= $user->update($request->validated());
        response()->json(['message'=>$updated?'updated successfuly'+$user:'error'],
        $updated?Response::HTTP_OK:Response::HTTP_BAD_REQUEST);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
        $deleted=$user->delete();
        response()->json(['message'=>$deleted?'deleted successfuly':'error'],
        $deleted?Response::HTTP_OK:Response::HTTP_BAD_REQUEST);
    }
  
}
