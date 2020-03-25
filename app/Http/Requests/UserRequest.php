<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'regex:/^[a-zA-Z0-9\-\_]+$/','unique:users,name,'.Auth::id(),'between:3,20'],
            'email' => ['required', 'email', 'max:255','unique:users,email,'.Auth::id()],
            'introduction'=>['max:200'],
            'avatar' =>['mimes:jpeg,png,jpg,gif','dimensions:min_width=208,min_height=208']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '用户名不能为空',
            'name.regex' => '用户名只支持数字、英文、下划线和横杠',
            'name.unique' => '用户名已被占用',
            'name.between' =>'用户名必须介于 3 - 20 个字符之间',
            'avatar.mimes' =>'头像必须是 jpeg, bmp, png, gif 格式的图片',
            'avatar.dimensions'=>'图片的清晰度不够，宽和高需要 208px 以上'
        ];
    }
}
