@extends('layouts.admin')
@section('content')
    <script>
        //删除分类
        function delCate(navigation_id) {
            layer.confirm('确认删除?', {
                btn: ['狠心删除','容我想想'] //按钮
            }, function(){
                $.post("{{url('admin/navigation/')}}/" + navigation_id, {'_method':'delete', '_token':"{{csrf_token()}}"}, function (data) {
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
        {{--<i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 导航管理--}}
    {{--</div>--}}
    <!--面包屑导航 结束-->

    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/navigation/create')}}"><i class="fa fa-plus"></i>添加导航</a>
                    <a href="{{url('admin/navigation')}}"><i class="fa fa-recycle"></i>全部导航</a>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc" width="5%">ID</th>
                        <th class="tc" width="20%">导航名</th>
                        <th class="tc" width="20%">导航别名</th>
                        <th class="tc" width="35%">导航路径</th>
                        <th class="tc">操作</th>
                    </tr>
                    @foreach($data as $v)
                    <tr>
                        <td class="tc">{{$v->navigation_id}}</td>
                        <td>{{$v->navigation_name}}</td>
                        <td>{{$v->navigation_alias}}</td>
                        <td>
                            <a href="{{$v->navigation_url}}">{{$v->navigation_url}}</a>
                        </td>
                        <td>
                            <a href="{{url('admin/navigation/' . $v->navigation_id . '/edit')}}">修改</a>
                            <a href="javascript:;" onclick="delCate({{$v->navigation_id}})">删除</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->
    @endsection
