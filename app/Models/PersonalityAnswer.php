<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalityAnswer extends Model
{
    protected $fillable = ['personality_question_id','answer_title','answer_photo','answer_option'];
    protected $table    = 'personality_answers';
    public $timestamps  = false;

    public function parent(){
        return $this->belongsTo('App\Models\PersonalityQuestion')->withDefault(function ($data) {
            foreach($data->getFillable() as $dt){
                $data[$dt] = __('Deleted');
            }
        });
    }
}
