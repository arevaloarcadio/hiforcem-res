<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    protected $guarded = [];

    /*******************************
     *  RELATIONSHIPS
     *******************************/
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
