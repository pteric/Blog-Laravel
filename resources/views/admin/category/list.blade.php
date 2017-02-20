@extends('layouts.admin')
@section('content')
    <script>
        //删除分类
        function delCate(cate_id) {
            layer.confirm('确认删除?', {
                btn: ['狠心删除','容我想想'] //按钮
            }, function(){
                $.post("{{url('admin/category/')}}/" + cate_id, {'_method':'delete', '_token':"{{csrf_token()}}"}, function (data) {
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
        {{--<i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 分类管理--}}
    {{--</div>--}}
    <!--面包屑导航 结束-->

    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/category/create')}}"><i class="fa fa-plus"></i>添加分类</a>
                    <a href="{{url('admin/category')}}"><i class="fa fa-recycle"></i>全部分类</a>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc" width="5%">ID</th>
                        <th class="tc" width="15%">分类名</th>
                        <th class="tc">分类说明</th>
                        <th class="tc" width="10%">点击次数</th>
                        <th class="tc" width="10%">发布人</th>
                        <th class="tc" width="15%">更新时间</th>
                        <th class="tc">操作</th>
                    </tr>
                    @foreach($data as $v)
                    <tr>
                        <td class="tc">{{$v->cate_id}}</td>
                        <td>
                            <a href="#">{{$v->_cate_name}}</a>
                        </td>
                        <td>{{$v->cate_description}}</td>
                        <td>{{$v->cate_view}}</td>
                        <td>pengtuo</td>
                        <td>{{$v->updated_at}}</td>
                        <td>
                            <a href="{{url('admin/category/' . $v->cate_id . '/edit')}}">修改</a>
                            <a href="javascript:;" onclick="delCate({{$v->cate_id}})">删除</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->
    @endsection
