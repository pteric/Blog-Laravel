<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Model\BlogArticle;
use App\Model\BlogCategory;
use App\Model\BlogLinks;
use App\Model\BlogNavigation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class CommonController extends Controller
{
    public function __construct()
    {
        $navs = BlogNavigation::get();
        $hot = BlogArticle::orderBy('art_view', 'desc')->take(5)->get();
        $links = BlogLinks::get();
        $cate = BlogCategory::where('cate_pid', 0)->get();
        View::share('navs', $navs);
        View::share('hot', $hot);
        View::share('links', $links);
        View::share('cate', $cate);
    }
}
