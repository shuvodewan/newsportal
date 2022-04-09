<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PollResult extends Model
{
    protected $fillable = ['poll_question_id','poll_answer_id','ip_address'];
    protected $table    = 'poll_results';
    public $timestamps  = false;

    public function answer(){
        return $this->belongsTo('App\Models\PollAnswer','poll_answer_id')->withDefault(function ($data) {
            foreach($data->getFillable() as $dt){
                $data[$dt] = __('Deleted');
            }
        });
    }

    public function question(){
        return $this->belongsTo('App\Models\PollQuestion','poll_question_id')->withDefault(function ($data) {
            foreach($data->getFillable() as $dt){
                $data[$dt] = __('Deleted');
            }
        });
    }
}
