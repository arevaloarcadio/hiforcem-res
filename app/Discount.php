<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $guarded = [];
    //
    //
    /*******************************
     *  RELATIONSHIPS
     *******************************/
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
