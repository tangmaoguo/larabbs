<?php

namespace App\Observers;

use App\Handlers\SlugTranslateHandler;
use App\Models\Topic;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class TopicObserver
{
    public function creating(Topic $topic)
    {
        //
    }

    public function updating(Topic $topic)
    {
        //
    }

    public function saving(Topic $topic){
        //翻译
        $topic->slug = app(SlugTranslateHandler::class)->translate($topic->title);
        //xss过滤
        $topic->body = clean($topic->body,'user_topic_body');
        //生成话题摘录
        $topic->excerpt = make_exceprt($topic->body);
    }
}
