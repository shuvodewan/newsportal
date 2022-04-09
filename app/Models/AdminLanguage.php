<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminLanguage extends Model
{
    protected $fillable = ['is_default','language','file','name','rtl','status'];
    protected $table    = 'admin_languages';
    public $timestamps  = false;
}
