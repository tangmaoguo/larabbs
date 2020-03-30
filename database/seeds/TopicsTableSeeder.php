<?php

use Illuminate\Database\Seeder;
use App\Models\Topic;
use App\Models\User;
use \App\Models\Category;
use \Illuminate\Support\Arr;
class TopicsTableSeeder extends Seeder
{
    public function run()
    {
        //获取所有用户id
        $user_ids = User::all()->pluck('id')->toArray();
        //获取所有分类id
        $category_ids = Category::all()->pluck('id')->toArray();

        $topics = factory(Topic::class)->times(50)->make()->each(function ($topic, $index) use ($user_ids,$category_ids){
                $topic->user_id = Arr::random($user_ids);
                $topic->category_id = Arr::random($category_ids);
        });

        Topic::insert($topics->toArray());
    }

}

