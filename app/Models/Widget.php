<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{
    protected $fillable = ['language_id','title','description','status'];
    protected $table    = 'widgets';
    
    public $timestamps  = false;

    public function language(){
        return $this->belongsTo('App\Models\Language')->withDefault(function ($data) {
            foreach($data->getFillable() as $dt){
                $data[$dt] = __('Deleted');
            }
        });
    }
}
