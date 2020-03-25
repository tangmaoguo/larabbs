<?php
namespace App\Handlers;

use Illuminate\Support\Str;

class ImageUploadHandler{
    protected $allowed_ext = ["png","jpg","gif","jpeg"];

    public function save($file,$folder,$file_prefix){
        //获取文件后缀
        $extension = strtolower($file->getClientOriginalExtension());

        //拼接文件名
        $filename = $file_prefix.'_'.time().'_'.Str::random().'.'.$extension;

        //拼接文件路径
        $folder_name = 'uploads/'.'images/'.$folder.'/'.date("Ymd",time());

        $file->move($folder_name,$filename);

        return ['path'=>"/$folder_name/$filename"];


    }
}