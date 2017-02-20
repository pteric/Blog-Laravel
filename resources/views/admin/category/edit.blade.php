@extends('layouts.admin')
@section('content')

    <!--面包屑导航 开始-->
    {{--<div class="crumb_warp">--}}
        {{--<i class="fa fa-home"></i> <a href="#">首页</a> &raquo; 分类管理 &raquo; 编辑分类--}}
    {{--</div>--}}
    <!--面包屑导航 结束-->

    <!--结果集标题与导航组件 开始-->
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
                <a href="{{url('admin/category/create')}}"><i class="fa fa-plus"></i>添加分类</a>
                <a href="{{url('admin/category')}}"><i class="fa fa-recycle"></i>全部分类</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->

    <div class="result_wrap">
        <form action="{{url('admin/category/' . $field->cate_id)}}" method="post">
            <input type='hidden' name='_method' value="put">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                <tr>
                    <th width="120"><i class="require">*</i>父级类：</th>
                    <td>
                        <select name="cate_pid">
                            <option value="0">==顶级分类==</option>
                        @foreach($data as $value)
                            <option value="{{$value->cate_id}}"
                                    @if($field->cate_pid == $value->cate_id) selected @endif>{{$value->cate_name}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>分类名：</th>
                    <td>
                        <input type="text" class="lg" name="cate_name" value="{{$field->cate_name}}">
                    </td>
                </tr>
                <tr>
                    <th>发布人：</th>
                    <td>
                        <input type="text" value="pengtuo">
                    </td>
                </tr>
                <tr>
                    <th>描述：</th>
                    <td>
                        <textarea name="cate_description">{{$field->cate_description}}</textarea>
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