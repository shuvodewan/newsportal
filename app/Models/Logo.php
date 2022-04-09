<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logo extends Model
{
    protected $fillable = [
                    'language_id',
                    'header_logo',
                    'footer_logo'
        ];
    public $timestamps = false;

    public function language(){
        return $this->belongsTo('App\Models\Language')->withDefault(function ($data) {
            foreach($data->getFillable() as $dt){
                $data[$dt] = __('Deleted');
            }
        });
    }
}
