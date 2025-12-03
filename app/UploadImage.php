<?php

namespace App;

use App\Models\Patient;
use Illuminate\Http\UploadedFile as HttpUploadedFile;
use Illuminate\Support\Facades\Storage;

trait UploadImage
{
    //
    public function upload(HttpUploadedFile $file,$disk,$patient=null)
    {   
        if($this->image){

            $this->deleteImage($disk,$this->image->path);

        }
        $folder=class_basename($this)=='patient'?'patient':auth()->user()->role;
        $folderName = "{$folder}/{$this->id}";
        $fileName = $this->id . time() . '.'. $file->getClientOriginalExtension();
        $path= $file->storeAs($folderName, $fileName , $disk);
        $alt_txt= $folder." image";
        return ['path'=>$path,'alt_txt'=>$alt_txt];

    }
    public function deleteImage($disk,$path){

        Storage::disk($disk)->delete($path);
        $this->image()->delete();
    }
}
