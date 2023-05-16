<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    ////
    protected $guarded = [];

    /*******************************
     *  RELATIONSHIPS
     *******************************/
    public function items()
    {
        return $this->hasMany('App\Item');
    }
}
