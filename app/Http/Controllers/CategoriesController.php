<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Topic;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function show(Request $request,Category $category){
        //查询分类下的话题
        $topics = Topic::with('category','user')->whereIn('category_id',$category)->withOrder($request->order)->paginate(20);
        return view('topics.index',compact('topics','category'));
    }
}
