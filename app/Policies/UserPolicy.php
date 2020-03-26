<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param User $currentUser
     * @param User $user
     * @desc 第一个参数是当前登录用户，第二个参数是要进行授权的用户实例
     */
    public function update(User $currentUser,User $user){
        return $currentUser->id === $user->id;
    }
}
