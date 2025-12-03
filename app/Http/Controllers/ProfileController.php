<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAvatarRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProfileController extends Controller
{
    //
    public function updateAvatar(UpdateAvatarRequest $request)
    {
        //
        $user=auth()->user();

        $result = $user->upload($request->file('image'),'public');

        $user->image()->updateOrCreate(['path'=>$result['path'],'alt_txt'=>$result['alt_txt']]);
        
        return response()->json( ['message' => "your profile's avatar  updated successfully"],
            Response::HTTP_OK
        );

    }
    public function delete()
    {   
        $user=auth()->user();

        if($user->image()) {

            $user->deleteImage('public',$user->image()->path);
            $user->image()->delete();
       }
       return response()->json(['message'=>'You do not have image profile'],Response::HTTP_METHOD_NOT_ALLOWED);

    }
}
