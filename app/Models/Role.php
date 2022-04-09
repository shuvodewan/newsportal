<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name','section'];
    protected $table    = 'roles';
    public $timestamps  = false;

    public function users(){
        return $this->hasMany('App\Models\Admin','role_id');
    }
}
