<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BlogLinks extends Model
{
    protected $table = 'links';
    protected $primaryKey = 'links_id';
    protected $guarded = [];
}
