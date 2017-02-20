<?php

namespace App\Http\Controllers\Admin;

use App\Model\BlogConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ConfigController extends CommonController
{
    public function index()
    {
        $data = BlogConfig::all();
        $this->putFile();
        return view('admin.config.list', compact('data'));
    }

    //get.admin/config/create  添加链接
    public function create()
    {
        return view('admin.config.add');
    }

    //post.admin/config 存储链接
    public function store()
    {
        $input = Input::except('_token');
        if ($input) {
            $rule = [
                'config_title' => 'required',
                'config_name'  => 'required',
            ];

            $message = [
                'config_title.required'       => '配置标题不能为空',
                'config_name.required'        => '配置名称不能为空',
            ];

            $validator = Validator::make($input, $rule, $message);

            if ($validator->passes()) {
                $re = BlogConfig::create($input);
                if ($re) {
                    $this->putFile();
                    return redirect('admin/config');
                } else {
                    return back()->with('errors', '未知错误，稍后再试');
                }
            } else {
                return back()->withErrors($validator);
            }
        }
    }

    //get.admin/config/{config}/edit  编辑文章
    public function edit($config_id)
    {
        $field = BlogConfig::find($config_id);
        return view('admin/config/edit', compact('field'));
    }

    //put.admin/config/{config}  更新链接
    public function update($config_id)
    {
        $input = Input::except('_token', '_method');
        $re = BlogConfig::where('config_id', $config_id)->update($input);
        if ($re) {
            $this->putFile();
            return redirect('admin/config');
        } else {
            return back()->with('errors', '未知错误，稍后再试');
        }
    }

    //delete.admin/config/{config}  删除单个链接
    public function destroy($config_id)
    {
        $re = BlogConfig::where('config_id', $config_id)->delete();
        if($re){
            $data = [
                'status' => 0,
                'msg' => '配置删除成功！',
            ];
            $this->putFile();
        }else{
            $data = [
                'status' => 1,
                'msg' => '配置删除失败，请稍后重试！',
            ];
        }
        return $data;
    }

    public function putFile()
    {
        $config = BlogConfig::pluck('config_content', 'config_name')->all();
        $path = base_path() . '/config/BlogConfig.php';
        $str = '<?php return ' . var_export($config, true) . ';';
        file_put_contents($path, $str);
        return;
    }

}
