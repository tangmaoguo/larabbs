@extends('layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/simditor.css')}}" />
@endsection
@section('content')

    <div class="container">
        <div class="col-md-10 offset-md-1">
            <div class="card ">
                <div class="card-body">
                    <h2>
                        <i class="far fa-edit"></i>
                        @if($topic->id)
                            编辑话题
                        @else
                            新建话题
                        @endif
                    </h2>
                    <hr>
                    @if($topic->id)
                        <form action="{{ route('topics.update', $topic->id) }}" method="post">
                            @method('put')
                            @else
                        <form action="{{ route('topics.store') }}" method="post">
                    @endif
                            @csrf
                            @include('shared._error')
                            <div class="form-group">
                                <input class="form-control" type="text" name="title" value="{{ old('title', $topic->title ) }}" placeholder="请填写标题" required />
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="category_id" required>
                                    <option value="" hidden disabled {{ $topic->id ? '': 'selected' }}>请选择分类</option>
                                    @foreach ($categories as $key=>$value)
                                        <option value="{{ $key }}" {{ $topic->category_id == $key ? 'selected' : '' }} >{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <textarea name="body" class="form-control" id="editor" rows="6" placeholder="请填入至少三个字符的内容。" required>{{ old('body', $topic->body ) }}</textarea>
                            </div>
                            <div class="well well-sm">
                                <button type="submit" class="btn btn-primary"><i class="far fa-save mr-2" aria-hidden="true"></i> 保存</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>



@endsection


@section('js')

    <script type="text/javascript" src="{{ asset('js/module.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/hotkeys.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/uploader.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/simditor.js') }}"></script>

    <script>
        $(function(){
            var editor = new Simditor({
                textarea: $('#editor'),
                upload:{
                    url:'{{ route('topics.upload_image') }}',
                    params:{
                        _token:'{{ csrf_token() }}'
                    },
                    fileKey: 'upload_file',
                    connectionCount: 3,
                    leaveConfirm: '文件上传中，关闭此页面将取消上传。'

                }
            });
        })
    </script>
@endsection
