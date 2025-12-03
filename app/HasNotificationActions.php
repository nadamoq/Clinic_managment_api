<?php

namespace App;

trait HasNotificationActions
{
    //
    
    public function markAllAsRead()
    {  
        $notifications=  $this->unreadNotifications;
        $notifications->markAsRead();
         return $notifications??0;

    }
    public function markAsRead($id)
    {   
        
        $notification= $this->unreadNotifications->findOrFail($id);
        $notification->markAsRead();
        return  $notification;

    }
    public function getUnreadNotification()
    {   
        return $this->unreadNotifications()->get();

    }
    public function deleteNotification($id)
    {
        return $this->notifications->findOrFail($id)->delete();
    }
}
