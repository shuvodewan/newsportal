<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialProvider extends Model
{
    protected $fillable = ['admin_id','provider_id','provider'];

    function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
