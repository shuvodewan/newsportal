<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    protected $fillable = ['add_placement','banner_type','addSize','photo','banner_code','link','status'];
    protected $table    = 'advertisements';
    public $timestamps  = false;
}
