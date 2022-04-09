<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TriviaAnswer extends Model
{
    protected $fillable = ['trivia_question_id','answer_title','correct_answer','answer_photo'];
    protected $table    = 'trivia_answers';
    public $timestamps  = false;

    public function parent(){
        return $this->belongsTo('App\Models\Post')->withDefault(function ($data) {
            foreach($data->getFillable() as $dt){
                $data[$dt] = __('Deleted');
            }
        });
    }
}
