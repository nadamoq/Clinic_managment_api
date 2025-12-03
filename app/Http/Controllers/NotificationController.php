<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificationResource;


class NotificationController extends Controller
{
    //
    public function index(){

        $notifications=auth()->user()->notifications()->get();

        return NotificationResource::collection($notifications);

    }
    public function markAllAsRead(){

       return  NotificationResource::collection(auth()->user()->markAllAsRead());
      
    }
    public function markAsRead($id){

       return new NotificationResource(auth()->user()->markAsRead($id));

    }
    public function unread(){
       
        return  NotificationResource::collection(auth()->user()->getUnreadNotification());

    }
    public function delete($id){

        auth()->user()->deleteNotification($id);

        return response()->json(['message'=>'deleted successfully']);
        
    }
}
