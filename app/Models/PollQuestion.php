<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PollQuestion extends Model
{
    protected $fillable = ['language_id','question','status','end_date'];
    protected $table    = 'poll_questions';

    // public $timestamps  = false;


    public function language(){
        return $this->belongsTo('App\Models\Language')->withDefault(function ($data) {
            foreach($data->getFillable() as $dt){
                $data[$dt] = __('Deleted');
            }
        });
    }

    public function child(){
        return $this->hasMany('App\Models\PollAnswer','poll_question_id');
    }

    public function results(){
        return $this->hasMany('App\Models\PollResult','poll_question_id');
    }

}
