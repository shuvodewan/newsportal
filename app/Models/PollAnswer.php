<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PollAnswer extends Model
{
    protected $fillable = ['poll_question_id','poll_option'];
    protected $table    = 'poll_answers';

    public $timestamps  = false;

    public function parent(){
        return $this->belongsTo('App\Models\PollQuestion','poll_question_id')->withDefault(function ($data) {
            foreach($data->getFillable() as $dt){
                $data[$dt] = __('Deleted');
            }
        });
    }

    public function results(){
        return $this->hasMany('App\Models\PollResult','poll_answer_id');
    }

}
