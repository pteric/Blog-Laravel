<?php

namespace App\Http\Controllers\Home;

use App\Model\BlogArticle;
use App\Model\BlogCategory;
use Illuminate\Http\Request;

class IndexController extends CommonController
{
    public function index()
    {
        $data = BlogArticle::Join('category', 'article.art_cateId', '=', 'category.cate_id')->orderBy('article.created_at', 'desc')->paginate(8);
        return view('home.index', compact('data'));
    }

    public function category($cate_id)
    {
        BlogCategory::where('cate_id', $cate_id)->increment('cate_view');//查看次数自增
        $category = BlogCategory::find($cate_id);
        $data = BlogArticle::orderBy('created_at', 'desc')->where('art_cateId', $cate_id)->paginate(10);
        return view('home.list', compact('category', 'data'));
    }

    public function article($art_id)
    {
        BlogArticle::where('art_id', $art_id)->increment('art_view');//查看次数自增
        $article = BlogArticle::Join('category', 'article.art_cateId', '=', 'category.cate_id')->find($art_id);
        $article['pre'] = BlogArticle::where('art_id','<',$art_id)->orderBy('art_id','desc')->first();
        $article['next'] = BlogArticle::where('art_id','>',$art_id)->orderBy('art_id','asc')->first();
        return view('home.article', compact('article'));
    }

    public function about()
    {
        $about = BlogArticle::find(1000);
        return view('home.about', compact('about'));
    }

    public function time()
    {
        return view('home.time');
    }
}
