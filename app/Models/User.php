<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $primaryKey   = "id";
    protected $table        = "user";

    public $incrementing    = true;
    public $timestamps      = false;

    protected $fillable = [
        'name',
        'email',
        'password'
    ];
}
