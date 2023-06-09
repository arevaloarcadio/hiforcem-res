<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    //
    protected $guarded = [];
    
    /*******************************
     *  RELATIONSHIPS
     *******************************/
    public function products()
    {
        return $this->hasMany('App\Product');
    }

    public function options()
    {
        return $this->hasMany('App\Option');
    }
}
