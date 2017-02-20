@extends('layouts.admin')
@section('content')
    <!--面包屑导航 开始-->
    {{--<div class="crumb_warp">--}}
        {{--<i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a>--}}
    {{--</div>--}}
    <!--面包屑导航 结束-->

    <!--结果集标题与导航组件 开始-->
    <div class="result_wrap">
        <div class="result_title">
    </div>
    <!--结果集标题与导航组件 结束-->


    <div class="result_wrap">
        <div class="result_title">
            <h3>系统基本信息</h3>
        </div>
        <div class="result_content">
            <ul>
                <li>
                    <label>操作系统</label><span>{{PHP_OS}}</span>
                </li>
                <li>
                    <label>运行环境</label><span>{{$_SERVER['SERVER_SOFTWARE']}}</span>
                </li>
                <li>
                    <label>PHP运行方式</label><span>apache2handler</span>
                </li>
                <li>
                    <label>版本</label><span>v-1.0</span>
                </li>
                <li>
                    <label>上传附件限制</label><span>{{get_cfg_var ("upload_max_filesize")?get_cfg_var ("upload_max_filesize"):"不允许上传附件"}}</span>
                </li>
                <li>
                    <label>北京时间</label><span>{{date("Y-m-d H:i:s", time())}}</span>
                </li>
                <li>
                    <label>服务器域名/IP</label><span>{{$_SERVER['REMOTE_ADDR']}}</span>
                </li>
                <li>
                    <label>Host</label><span>{{$_SERVER['HTTP_HOST']}}</span>
                </li>
            </ul>
        </div>
    </div>
@endsection