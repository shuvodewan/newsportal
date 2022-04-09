<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    protected $fillable = ['name','link','icon'];
    protected $table    = 'social_links';
    public $timestamps  = false;
}
