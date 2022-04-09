<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    protected $fillable = ['google_analytics','meta_keys'];
    protected $table    = 'seotools';
    public $timestamps  = false;
}
