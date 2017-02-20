<?php

namespace App\Http\Controllers\Admin;

use App\Model\BlogLinks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class LinksController extends CommonController
{
    public function index()
    {
        $data = BlogLinks::all();
        return view('admin.links.list', compact('data'));
    }

    //get.admin/links/create  添加链接
    public function create()
    {
        return view('admin.links.add');
    }

    //post.admin/links 存储链接
    public function store()
    {
        $input = Input::except('_token');
        if ($input) {
            $rule = [
                'links_name'        => 'required',
                'links_url'         => 'required',
                'links_description' => 'required',
            ];

            $message = [
                'links_name.required'        => '链接名称不能为空',
                'links_url.required'         => '链接路径不能为空',
                'links_description.required' => '链接描述不能为空',
            ];

            $validator = Validator::make($input, $rule, $message);

            if ($validator->passes()) {
                $re = BlogLinks::create($input);
                if ($re) {
                    return redirect('admin/links');
                } else {
                    return back()->with('errors', '未知错误，稍后再试');
                }
            } else {
                return back()->withErrors($validator);
            }
        }
    }

    //get.admin/links/{links}/edit  编辑文章
    public function edit($links_id)
    {
        $field = BlogLinks::find($links_id);
        return view('admin/links/edit', compact('field'));
    }

    //put.admin/links/{links}  更新链接
    public function update($links_id)
    {
        $input = Input::except('_token', '_method');
        $re = BlogLinks::where('links_id', $links_id)->update($input);
        if ($re) {
            return redirect('admin/links');
        } else {
            return back()->with('errors', '未知错误，稍后再试');
        }
    }

    //delete.admin/links/{links}  删除单个链接
    public function destroy($links_id)
    {
        $re = BlogLinks::where('links_id', $links_id)->delete();
        if($re){
            $data = [
                'status' => 0,
                'msg' => '链接删除成功！',
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '链接删除失败，请稍后重试！',
            ];
        }
        return $data;
    }

}
