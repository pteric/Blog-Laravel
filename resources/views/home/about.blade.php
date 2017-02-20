@extends('layouts.home')
@section('info')
    <title>彭拓 — {{$about->art_title}}</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    @endsection
@section('content')
    <article class="blogs">
        <div>
            <h2 class="c_titile">{{$about->art_title}}</h2>
            <p class="box_c"><span class="d_time">发布时间：{{$about->created_at}}</span><span>作者：{{$about->art_editor}}</span><span>查看次数：{{$about->art_view}}</span></p>
            <ul class="infos">
                {!! $about->art_content !!}
            </ul>
        </div>
    </article>
    @endsection