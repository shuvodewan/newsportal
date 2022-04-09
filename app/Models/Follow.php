<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $fillable = ['admin_id','follower_id'];
    protected $table    = 'follows';
    public $timestamps  = false;
}
