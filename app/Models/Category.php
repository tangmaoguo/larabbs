<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description'
    ];

    public function categories(){
//        Cache::forget('categories');
        if(!Cache::has('categories')){
            Cache::put('categories',$this->all()->pluck('name','id'),86400*7);
        }
        return Cache::get('categories');
    }
}
