<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey   = "id";
    protected $table        = "category";
    public $incrementing    = true;
    public $timestamps      = true;

    protected $fillable = ['name'];
}
