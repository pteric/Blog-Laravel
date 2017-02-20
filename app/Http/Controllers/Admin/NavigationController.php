<?php

namespace App\Http\Controllers\Admin;

use App\Model\BlogNavigation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class NavigationController extends CommonController
{
    public function index()
    {
        $data = BlogNavigation::all();
        return view('admin.navigation.list', compact('data'));
    }

    //get.admin/navigation/create  添加链接
    public function create()
    {
        return view('admin.navigation.add');
    }

    //post.admin/navigation 存储链接
    public function store()
    {
        $input = Input::except('_token');
        if ($input) {
            $rule = [
                'navigation_name'        => 'required',
                'navigation_alias'       => 'required',
                'navigation_url'         => 'required',
            ];

            $message = [
                'navigation_name.required'        => '导航名称不能为空',
                'navigation_url.required'         => '导航路径不能为空',
                'navigation_alias.required'       => '导航别名不能为空',
            ];

            $validator = Validator::make($input, $rule, $message);

            if ($validator->passes()) {
                $re = BlogNavigation::create($input);
                if ($re) {
                    return redirect('admin/navigation');
                } else {
                    return back()->with('errors', '未知错误，稍后再试');
                }
            } else {
                return back()->withErrors($validator);
            }
        }
    }

    //get.admin/navigation/{navigation}/edit  编辑文章
    public function edit($navigation_id)
    {
        $field = BlogNavigation::find($navigation_id);
        return view('admin/navigation/edit', compact('field'));
    }

    //put.admin/navigation/{navigation}  更新链接
    public function update($navigation_id)
    {
        $input = Input::except('_token', '_method');
        $re = BlogNavigation::where('navigation_id', $navigation_id)->update($input);
        if ($re) {
            return redirect('admin/navigation');
        } else {
            return back()->with('errors', '未知错误，稍后再试');
        }
    }

    //delete.admin/navigation/{navigation}  删除单个链接
    public function destroy($navigation_id)
    {
        $re = BlogNavigation::where('navigation_id', $navigation_id)->delete();
        if($re){
            $data = [
                'status' => 0,
                'msg' => '导航删除成功！',
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '导航删除失败，请稍后重试！',
            ];
        }
        return $data;
    }

}
