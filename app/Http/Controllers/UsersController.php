<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Handlers\ImageUploadHandler;
class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(User $user){
        $topics = $user->topics()->recent()->paginate(5);
        return view('users.show',compact('user','topics'));
    }
    public function edit(User $user){
        $this->authorize('update',$user);
        return view('users.edit',compact('user'));
    }
    public function update(UserRequest $request,User $user,ImageUploadHandler $uploadHandler){
        $this->authorize('update',$user);
        $data = $request->all();
        if($request->avatar){
            $result = $uploadHandler->save($request->avatar,'avatars',$user->id,416);
            if($result){
                $data['avatar'] = $result['path'];
            }
        }

        $user->update($data);
        return redirect()->route('users.show',$user->id)->with('success','更新个人资料成功');
    }



}
