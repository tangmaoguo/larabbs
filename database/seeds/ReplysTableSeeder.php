<?php

use Illuminate\Database\Seeder;
use App\Models\Reply;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Support\Arr;
class ReplysTableSeeder extends Seeder
{
    public function run()
    {
        //获取topic_id
        $topic_id = Topic::pluck('id')->toArray();
        $user_id = User::pluck('id')->toArray();
        $replys = factory(Reply::class)->times(100)->make()->each(function ($reply, $index) use($topic_id,$user_id){
            $reply->topic_id = Arr::random($topic_id);
            $reply->user_id = Arr::random($user_id);
        });

        Reply::insert($replys->toArray());
    }

}

