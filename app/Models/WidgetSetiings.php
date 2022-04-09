<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WidgetSetiings extends Model
{
    protected $fillable = ['feature_inhome','category_inhome','follow_inhome','tag_inhome','poll_inhome','calendar_inhome','newsletter_inhome',
                            'category_incategory','newsletter_incategory','calendar_incategory','category_indetails','newsletter_indetails','calendar_indetails'];
    protected $table    = 'widget_settings';
    
    public $timestamps  = false;
}
