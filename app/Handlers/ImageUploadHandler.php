<?php
namespace App\Handlers;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class ImageUploadHandler{
    protected $allowed_ext = ["png","jpg","gif","jpeg"];

    public function save($file,$folder,$file_prefix,$max_width = false){
        //获取文件后缀
        $extension = strtolower($file->getClientOriginalExtension());

        if(!in_array($extension,$this->allowed_ext)){
            return false;
        }

        //拼接文件名
        $filename = $file_prefix.'_'.time().'_'.Str::random().'.'.$extension;

        //拼接文件路径
        $folder_name = 'uploads/'.'images/'.$folder.'/'.date("Ymd",time());

        //拼接地址
        $file_path = '/'.$folder_name.'/'.$filename;

        //绝对路径
        $absolute_path = public_path().$file_path;


        $file->move($folder_name,$filename);

        //裁剪图片
        if($max_width){
            $img = Image::make($absolute_path);
            $img->resize($max_width,null,function($constraint){
                //设置宽度，等比例缩放
                $constraint->aspectRatio();
                //防止图片尺寸变大
                $constraint->upsize();
            });
            $img->save();
        }

        return ['path'=>$file_path];


    }
}