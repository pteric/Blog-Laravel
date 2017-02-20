<?php

namespace App\Http\Controllers\Admin;

use App\Model\BlogCategory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class CategoryController extends CommonController
{
    //get.admin/category  全部分类列表
    public function index()
    {
        $data = (new BlogCategory)->tree();
        return view('admin.category.list')->with('data', $data);
    }

    //post.admin/category
    public function store()
    {
        $input = Input::except('_token');
        if ($input) {
            $rule = [
                'cate_name' => 'required',
            ];

            $message = [
                'cate_name.required' => '分类名称不能为空',
            ];

            $validator = Validator::make($input, $rule, $message);

            if ($validator->passes()) {
                $re = BlogCategory::create($input);
                if ($re) {
                    return redirect('admin/category');
                } else {
                    return back()->with('errors', '未知错误，稍后再试');
                }
            } else {
                return back()->withErrors($validator);
            }
        }
    }

    //get.admin/category/create  添加分类
    public function create()
    {
        $data = BlogCategory::where('cate_pid', 0)->get();
        return view('admin.category.add', compact('data'));
    }

    //get.admin/category/{category}/edit  编辑分类
    public function edit($cate_id)
    {
        $field = BlogCategory::find($cate_id);
        $data = BlogCategory::where('cate_pid', 0)->get();
        return view('admin/category/edit', compact('field', 'data'));
    }

    //put.admin/category/{category}  更新分类
    public function update($cate_id)
    {
        $input = Input::except('_token', '_method');
        $re = BlogCategory::where('cate_id', $cate_id)->update($input);
        if ($re) {
            return redirect('admin/category');
        } else {
            return back()->with('errors', '未知错误，稍后再试');
        }
    }

    //delete.admin/category/{category}  删除单个分类
    public function destroy($cate_id)
    {
        $re = BlogCategory::where('cate_id', $cate_id)->delete();
        BlogCategory::where('cate_pid',$cate_id)->update(['cate_pid'=>0]);
        if($re){
            $data = [
                'status' => 0,
                'msg' => '分类删除成功！',
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '分类删除失败，请稍后重试！',
            ];
        }
        return $data;
    }

    //get.admin/category/{category}  显示单个分类信息
    public function show()
    {
        //
    }

}
