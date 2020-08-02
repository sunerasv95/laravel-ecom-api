<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    public function users()
    {
        return $this->belongsToMany('App\User', 'product_user');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function product_stock()
    {
        return $this->hasOne('App\ProductStock');
    }

}
