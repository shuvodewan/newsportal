<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialSettings extends Model
{
    protected $fillable = ['fclient_id','fclient_secret','fredirect','gclient_id','gclient_secret','gredirect'];
    protected $table    = 'socialsettings';
    public $timestamps  = false;
}
