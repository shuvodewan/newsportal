<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['language_id','title','slug','description','placement','status','wbsite_right_column'];
    protected $table    = 'pages';
    public $timestamps  = false;

    public function language(){
        return $this->belongsTo('App\Models\Language')->withDefault(function ($data) {
            foreach($data->getFillable() as $dt){
                $data[$dt] = __('Deleted');
            }
        });
    }
}
