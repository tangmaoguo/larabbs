@include('shared._error')

<div class="reply-box">
    <form action="{{ route('replies.store') }}" method="post">
        @csrf
        <input type="hidden" name="topic_id" value="{{ $topic->id }}">
        <div class="form-group">
            <textarea name="content" id=""  rows="3" class="form-control" placeholder="分享你的观点"></textarea>
        </div>
        <button class="btn btn-primary btn-sm"><i class="fa fa-share mr-1"></i> 回复</button>
    </form>
</div>

