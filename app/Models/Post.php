<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    
    protected $primaryKey   = "id";
    protected $table        = "post";
    public $incrementing    = true;
    public $timestamps      = true;

    protected $fillable = [
        'title',
        'content',
        'categories',
        'tags'
    ];
}
