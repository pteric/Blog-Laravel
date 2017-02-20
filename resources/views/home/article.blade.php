@extends('layouts.home')
@section('info')
    <title>彭拓 — {{$article->art_title}}</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    @endsection
@section('content')
    <article class="blogs">
        <div>
            <h2 class="c_titile">{{$article->art_title}}</h2>
            <p class="box_c"><span class="d_time">发布时间：{{$article->created_at}}</span><span>作者：{{$article->art_editor}}</span><span>查看次数：{{$article->art_view}}</span></p>
            <ul class="infos">
                {!! $article->art_content !!}
            </ul>
            <div class="keybq">
                <p><span>分类</span>：{{$article->cate_name}}</p>
            </div>
            <div class="ad"> </div>
            <div class="nextinfo">
                @if($article->pre)<p>上一篇：<a href="{{url('article/' . $article->pre->art_id)}}">{{$article->pre->art_title}}</a></p>@endif
                @if($article->next)<p>下一篇：<a href="{{url('article/' . $article->next->art_id)}}">{{$article->next->art_title}}</a></p>@endif
            </div>
        </div>
    </article>
    @endsection