<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'brand_id','title','details','banner','image','show_in_home','ordering'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        '',
    ];

    /**
     *  Brand Relation
     */
    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }
}
