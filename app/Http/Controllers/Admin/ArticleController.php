<?php

namespace App\Http\Controllers\Admin;

use App\Model\BlogArticle;
use App\Model\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ArticleController extends CommonController
{
    //get.admin/article  全部文章列表
    public function index()
    {
        $data = BlogArticle::orderby('art_id', 'dec')->paginate(20);
        return view('admin.article.list', compact('data'));
    }

    //post.admin/article 存储文章
    public function store()
    {
        $input = Input::except('_token');
        if ($input) {
            $rule = [
                'art_cateId'  => 'required',
                'art_title'   => 'required',
                'art_editor'  => 'required',
                'art_content' => 'required',
            ];

            $message = [
                'art_cateId.required'  => '请选择文章分类',
                'art_title.required'   => '请填写文章标题',
                'art_editor.required'  => '请填写文章作者',
                'art_content.required' => '请填写文章内容',
            ];

            $validator = Validator::make($input, $rule, $message);

            if ($validator->passes()) {
                $re = BlogArticle::create($input);
                if ($re) {
                    return redirect('admin/article');
                } else {
                    return back()->with('errors', '未知错误，稍后再试');
                }
            } else {
                return back()->withErrors($validator);
            }
        }
    }

    //get.admin/article/create  添加文章
    public function create()
    {
        $data = (new BlogCategory)->tree();
        return view('admin.article.add', compact('data'));
    }

    //添加文字缩略图
    public function upload()
    {
        $file = Input::file('Filedata');
        if ($file->isValid()) {
            $extension = $file->getClientOriginalExtension();
            $filename = date('YmdHis') . mt_rand(100, 999) . '.' . $extension;
            $file->move(base_path() . '/public/img', $filename);
            return 'img/' . $filename;
        }
    }

    //get.admin/article/{article}/edit  编辑文章
    public function edit($art_id)
    {
        $field = BlogArticle::find($art_id);
        $data = (new BlogCategory)->tree();
        return view('admin/article/edit', compact('field', 'data'));
    }

    //put.admin/article/{article}  更新文章
    public function update($art_id)
    {
        $input = Input::except('_token', '_method');
        $re = BlogArticle::where('art_id', $art_id)->update($input);
        if ($re) {
            return redirect('admin/article');
        } else {
            return back()->with('errors', '未知错误，稍后再试');
        }
    }

    //delete.admin/article/{article}  删除单个文章
    public function destroy($art_id)
    {
        $re = BlogArticle::where('art_id', $art_id)->delete();
        if($re){
            $data = [
                'status' => 0,
                'msg' => '文章删除成功！',
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '文章删除失败，请稍后重试！',
            ];
        }
        return $data;
    }

    //get.admin/article/{article}  显示单个文章信息
    public function show()
    {
        //
    }
}
