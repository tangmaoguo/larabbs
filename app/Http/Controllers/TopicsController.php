<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Models\Category;
use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use Illuminate\Support\Facades\Auth;


class TopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index(Request $request)
	{
		$topics = Topic::with('user','category')->withOrder($request->order)->paginate(30);
		return view('topics.index', compact('topics'));
	}

    public function show(Request $request,Topic $topic)
    {
        //用户回复列表
        $replies = $topic->replies()->with('user')->recent()->get();
        if(!empty($topic->slug) && $request->slug !== $topic->slug){
            return redirect($topic->link(),301);
        }
        return view('topics.show', compact('topic','replies'));
    }

	public function create(Topic $topic)
	{
	    $categories = Category::pluck('name','id');
		return view('topics.create_and_edit', compact('topic','categories'));
	}

	public function store(TopicRequest $request,Topic $topic)
	{
        $topic->fill($request->all());
        $topic->user_id = Auth::id();
        $topic->save();
        return redirect()->to($topic->link())->with('message', 'Created successfully.');
	}

	public function edit(Topic $topic)
	{
        $this->authorize('update', $topic);
        $categories = Category::pluck('name','id');
		return view('topics.create_and_edit', compact('topic','categories'));
	}

	public function update(TopicRequest $request, Topic $topic)
	{
		$this->authorize('update', $topic);
		$topic->update($request->all());
        return redirect()->to($topic->link())->with('message', 'Updated successfully.');
//		return redirect()->route('topics.show', $topic->id)->with('message', 'Updated successfully.');
	}

	public function destroy(Topic $topic)
	{
		$this->authorize('destroy', $topic);
		$topic->delete();

		return redirect()->route('topics.index')->with('message', 'Deleted successfully.');
	}

	public function uploadImage(Request $request,ImageUploadHandler $imageUploadHandler){
        // 初始化返回数据，默认是失败的
        $data = [
            'success'   => false,
            'msg'       => '上传失败!',
            'file_path' => ''
        ];
        if($request->upload_file){
            // 保存图片到本地
            $result = $imageUploadHandler->save($request->upload_file, 'topics', Auth::id(), 1024);
            if($result){
                $data = [
                    'success'   => true,
                    'msg'       => '上传成功!',
                    'file_path' => $result['path']
                ];
            }
        }
        return $data;
    }
}
