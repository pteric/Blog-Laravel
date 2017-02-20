<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BlogNavigation extends Model
{
    protected $table = 'navigation';
    protected $primaryKey = 'navigation_id';
    protected $guarded = [];
}
