<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BlogConfig extends Model
{
    protected $table = 'config';
    protected $primaryKey = 'config_id';
    protected $guarded = [];
}
