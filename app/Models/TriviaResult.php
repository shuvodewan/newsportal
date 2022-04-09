<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TriviaResult extends Model
{
    protected $fillable = ['post_id','result_title','result_photo','result_description','min','max'];
    protected $table    = 'trivia_results';
    public $timestamps  = false;

    public function parent(){
        return $this->belongsTo('App\Models\Post')->withDefault(function ($data) {
            foreach($data->getFillable() as $dt){
                $data[$dt] = __('Deleted');
            }
        });
    }
}
