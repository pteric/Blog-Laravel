@extends('layouts.admin')
@section('content')
    <script>
        //删除文章
        function delCate(art_id) {
            layer.confirm('确认删除?', {
                btn: ['狠心删除','容我想想'] //按钮
            }, function(){
                $.post("{{url('admin/article/')}}/" + art_id, {'_method':'delete', '_token':"{{csrf_token()}}"}, function (data) {
                    if(data.status==0){
                        layer.msg(data.msg, {icon: 6});
                    }else{
                        layer.msg(data.msg, {icon: 5});
                    }
                    location.href = location.href;
                });
            }, function(){});
        }
    </script>

    <!--面包屑导航 开始-->
    {{--<div class="crumb_warp">--}}
        {{--<i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 文章管理--}}
    {{--</div>--}}
    <!--面包屑导航 结束-->

    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>添加文章</a>
                    <a href="{{url('admin/article')}}"><i class="fa fa-recycle"></i>全部文章</a>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc" width="5%">ID</th>
                        <th class="tc" width="35%">文章名</th>
                        <th class="tc" width="10%">查看次数</th>
                        <th class="tc" width="10%">作者</th>
                        <th class="tc" width="20%">发布时间</th>
                        <th class="tc">操作</th>
                    </tr>
                    @foreach($data as $v)
                    <tr>
                        <td class="tc">{{$v->art_id}}</td>
                        <td>
                            <a href="#">{{$v->art_title}}</a>
                        </td>
                        <td>{{$v->art_view}}</td>
                        <td>{{$v->art_editor}}</td>
                        <td>{{$v->created_at}}</td>
                        <td>
                            <a href="{{url('admin/article/' . $v->art_id . '/edit')}}">修改</a>
                            <a href="javascript:;" onclick="delCate({{$v->art_id}})">删除</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="page_list">{{$data->links()}}</div>
    </form>
    <!--搜索结果页面 列表 结束-->
    @endsection
