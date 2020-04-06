<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Topic;

class TopicPolicy extends Policy
{
    protected function isAuthorOf($user,$topic)
    {
        return $user->id == $topic->user_id;
    }

    public function update(User $user, Topic $topic)
    {
        return $this->isAuthorOf($user,$topic);
    }

    public function destroy(User $user, Topic $topic)
    {
        return $this->isAuthorOf($user,$topic);
    }
}
