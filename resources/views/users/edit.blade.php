@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4> <i class="glyphicon glyphicon-edit"></i> 编辑个人资料</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('users.update',$user->id) }}" method="post" enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                        @include('shared._error')
                        <div class="form-group">
                            <label for="name">用户名</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name',$user->name) }}">
                        </div>
                        <div class="form-group">
                            <label for="email">邮 箱</label>
                            <input class="form-control" type="email" name="email" id="email" value="{{ old('email', $user->email) }}">
                        </div>
                        <div class="form-group">
                            <label for="introduction">个人简介</label>
                            <textarea name="introduction" id="introduction" class="form-control" rows="3">{{ old('introduction', $user->introduction) }}</textarea>
                        </div>
                        <div class="form-group mb-4">
                            <label for="avatar" class="avatar-label">用户头像</label>
                            <input type="file" name="avatar" id="form-control-file">

                            @if($user->avatar)
                                <br>
                                <img src="{{ $user->avatar }}" width="200" alt="" class="thumbnail img-responsive">
                            @endif
                        </div>
                        <div class="well well-sm">
                            <button type="submit" class="btn btn-primary">保存</button>
                        </div>



                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection