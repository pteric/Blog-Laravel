@extends('layouts.admin')
@section('content')
    <script>
        //删除分类
        function delCate(config_id) {
            layer.confirm('确认删除?', {
                btn: ['狠心删除','容我想想'] //按钮
            }, function(){
                $.post("{{url('admin/config/')}}/" + config_id, {'_method':'delete', '_token':"{{csrf_token()}}"}, function (data) {
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
        {{--<i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 配置管理--}}
    {{--</div>--}}
    <!--面包屑导航 结束-->

    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <!--快捷配置 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/config/create')}}"><i class="fa fa-plus"></i>添加配置</a>
                    <a href="{{url('admin/config')}}"><i class="fa fa-recycle"></i>全部配置</a>
                </div>
            </div>
            <!--快捷配置 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc" width="5%">ID</th>
                        <th class="tc" width="10%">配置标题</th>
                        <th class="tc" width="10%">配置名称</th>
                        <th class="tc" width="25%">配置内容</th>
                        <th class="tc" width="15%">配置说明</th>
                        <th class="tc" width="7%">配置类型</th>
                        <th class="tc" width="15%">类型值</th>
                        <th class="tc">操作</th>
                    </tr>
                    @foreach($data as $v)
                    <tr>
                        <td class="tc">{{$v->config_id}}</td>
                        <td>{{$v->config_title}}</td>
                        <td>{{$v->config_name}}</td>
                        <td>{{$v->config_content}}</td>
                        <td>{{$v->config_tips}}</td>
                        <td>{{$v->field_type}}</td>
                        <td>{{$v->field_value}}</td>
                        <td>
                            <a href="{{url('admin/config/' . $v->config_id . '/edit')}}">修改</a>
                            <a href="javascript:;" onclick="delCate({{$v->config_id}})">删除</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->
    @endsection
