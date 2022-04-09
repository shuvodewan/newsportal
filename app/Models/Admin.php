<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone','photo','role_id','token','verify'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts(){
        return $this->hasMany('App\Models\Post','admin_id');
    }

    public function role(){
        return $this->belongsTo('App\Models\Role')->withDefault(function ($data) {
            foreach($data->getFillable() as $dt){
                $data[$dt] = __('Deleted');
            }
        });
    }

    public function socialProviders()
    {
        return $this->hasMany('App\Models\SocialProvider');
    }

    public function IsSuper(){
        if ($this->id == 1) {
           return true;
        }
        return false;
    }

    public function sectionCheck($value){
        $sections = json_decode($this->role->section);
        if (in_array($value, $sections)){
            return true;
        }else{
            return false;
        }
    }

    public function filterByLanguage($id){
        return $this->posts()
                    ->where('language_id',$id)
                    ->where('status','=','true')
                    ->where('schedule_post','=',0)
                    ->where('schedule_post_date','=',NULL)
                    ->orderBy('id','desc')
                    ->get();
    }

    public function filterByCategory($id){
        if($id==0){
            return $this->posts()
                        ->where('status','=','true')
                        ->where('schedule_post','=',0)
                        ->where('schedule_post_date','=',NULL)
                        ->orderBy('id','desc')
                        ->get();
        }
        return $this->posts()
                    ->where('category_id',$id)
                    ->where('status','=','true')
                    ->where('schedule_post','=',0)
                    ->where('schedule_post_date','=',NULL)
                    ->orderBy('id','desc')
                    ->get();
    }

    public function followers(){
        return $this->hasMany('App\Models\Follow');
    }

}
