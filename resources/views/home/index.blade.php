@extends('layouts.home')
@section('info')
    <title>彭拓</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
@endsection
@section('content')
    <div class="banner">
        <section class="box">
            <ul class="texts">
            </ul>
            <div class="avatar"><a href="#"><span></span></a> </div>
        </section>
    </div>
    <article>
        <h2 class="title_tj">
            <p><span>文章推荐</span></p>
        </h2>
        <div class="bloglist left">
            @foreach($data as $v)
                <h3><a href="{{url('/article/' . $v->art_id)}}">{{$v->art_title}}</a></h3>
                <figure><a href="{{url('/article/' . $v->art_id)}}"><img src="{{url($v->art_thumb)}}"></a></figure>
            <ul>
                <p>{{$v->art_description}}...</p>
                <a title="/" href="{{url('/article/' . $v->art_id)}}" class="readmore">Read More >></a>
            </ul>
            <p class="dateview">
                <span>
                    {{$v->created_at}}
                </span>
                <span>作者：{{$v->art_editor}}</span>
                <span>分类：<a href="{{url('category/' . $v->cate_id)}}">{{$v->cate_name}}</a></span>
            </p>
                @endforeach
                <div class="page">{{$data->links()}}</div>
        </div>
        <aside class="right">
            <div class="news">
                <h3 class="ph">
                    <p><span>点击排行</span></p>
                </h3>
                <ul class="paih">
                    @foreach($hot as $value)
                    <li><a href="{{url('/article/' . $value->art_id)}}" title="{{$value->art_title}}">{{$value->art_title}}</a></li>
                        @endforeach
                </ul>
                <h3 class="ph">
                    <p><span>文章分类</span></p>
                </h3>
                <ul class="rank">
                    @foreach($cate as $value)
                        <li><a href="{{url('category/' . $value->cate_id)}}" title="{{$value->cate_name}}">{{$value->cate_name}}</a></li>
                    @endforeach
                </ul>
                {{--<h3 class="ph">--}}
                    {{--<p><span>日期归档</span></p>--}}
                {{--</h3>--}}
                {{--<ul class="rank">--}}
                    {{--@foreach($hot as $value)--}}
                        {{--<li><a href="/" title="{{$value->art_title}}">{{$value->art_title}}</a></li>--}}
                    {{--@endforeach--}}
                {{--</ul>--}}
                <h3 class="links">
                    <p><span>友情链接</span></p>
                </h3>
                <ul class="rank">
                    @foreach($links as $link)
                    <li><a target="_blank" href="{{$link->links_url}}">{{$link->links_name}}</a></li>
                        @endforeach
                </ul>
            </div>
        </aside>
    </article>
    @endsection