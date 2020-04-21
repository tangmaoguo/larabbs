<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Reply;

class ReplyPolicy extends Policy
{
    public function update(User $user, Reply $reply)
    {
         return $reply->user_id == $user->id;
    }

    public function destroy(User $user, Reply $reply)
    {
        //发表评论本人可删除 || 话题本人可删除
        if($reply->user_id == $user->id || $user->id == $reply->topic->user_id){
            return true;
        }

    }
}
