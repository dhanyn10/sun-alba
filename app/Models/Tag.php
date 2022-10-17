<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $primaryKey   = "id";
    protected $table        = "tag";

    public $incrementing    = true;
    public $timestamps      = true;

    protected $fillable = ['name'];
}
