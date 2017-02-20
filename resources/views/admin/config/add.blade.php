@extends('layouts.admin')
@section('content')

    <script>
        showTr();
        function showTr() {
            var type = $('input[name = field_type]:checked').val();
            if(type == 'radio') {
                $('.field_value') . show();
            } else {
                $('.field_value') . hide();
            }
        }
    </script>

    <!--面包屑导航 开始-->
    {{--<div class="crumb_warp">--}}
        {{--<i class="fa fa-home"></i> <a href=" {{url('admin/info')}}">首页</a> &raquo; 配置管理 &raquo; 添加配置--}}
    {{--</div>--}}
    <!--面包屑导航 结束-->

    <!--结果集标题与配置组件 开始-->
    <div class="result_wrap">
        <div class="result_title">
            @if(count($errors) > 0)
            <div style="color:red">
                @if(is_object($errors))
                    @foreach($errors->all() as $error)
                        <p>{{$error}}</p>
                    @endforeach
                @else
                    <p>{{$errors}}</p>
                @endif
            </div>
            @endif
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/config/create')}}"><i class="fa fa-plus"></i>添加配置</a>
                <a href="{{url('admin/config')}}"><i class="fa fa-recycle"></i>全部配置</a>
            </div>
        </div>
    </div>
    <!--结果集标题与配置组件 结束-->

    <div class="result_wrap">
        <form action="{{url('admin/config')}}" method="post">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                <tr>
                    <th><i class="require">*</i>配置标题：</th>
                    <td>
                        <input type="text" name="config_title">
                        <span><i class="fa fa-exclamation-circle yellow"></i>配置标题必须填写</span>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>配置名称：</th>
                    <td>
                        <input type="text" name="config_name">
                        <span><i class="fa fa-exclamation-circle yellow"></i>配置名称必须填写</span>
                    </td>
                </tr>
                <tr>
                    <th>类型：</th>
                    <td>
                        <input type="radio"  value="input"    name="field_type" onclick="showTr()">input　　
                        <input type="radio"  value="textarea" name="field_type" onclick="showTr()">textarea　　
                        <input type="radio"  value="radio"    name="field_type" onclick="showTr()">radio　　
                    </td>
                </tr>
                <tr class="field_value">
                    <th>类型值：</th>
                    <td>
                        <input type="text" name="field_value" value="">
                    </td>
                </tr>
                <tr>
                    <th>配置内容：</th>
                    <td>
                        <textarea type="text" name="config_content"></textarea>
                    </td>
                </tr>
                <tr>
                    <th>配置说明：</th>
                    <td>
                        <textarea type="text" name="config_tips"></textarea>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <input type="submit" value="提交">
                        <input type="button" class="back" onclick="history.go(-1)" value="返回">
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>

@endsection