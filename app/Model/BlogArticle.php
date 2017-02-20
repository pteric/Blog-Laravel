<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BlogArticle extends Model
{
    protected $table = 'article';
    protected $primaryKey = 'art_id';
    protected $guarded = [];
}
