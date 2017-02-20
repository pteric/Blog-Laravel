<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'cate_id';
    protected $guarded = [];

    public function tree()
    {
        $categories = $this->all();
        return $this->getTree($categories, 'cate_name', 'cate_pid', 'cate_id');
    }

    public function getTree($data, $field_name='name', $field_pid='pid', $field_id='id', $pid=0)
    {
        $arr = [];
        foreach ($data as $key => $value) {
            if ($pid == $value->$field_pid) {
                $data[$key]['_' . $field_name] = $data[$key][$field_name];
                $arr[] = $data[$key];
            }
            foreach ($data as $k => $v) {
                if ($v->$field_pid == $value->$field_id) {
                    $data[$k]['_' . $field_name] ='(～o￣3￣)～' . $data[$k][$field_name];
                    $arr[] = $data[$k];
                }
            }
        }
        return $arr;
    }
}
