<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function orderProducts()
    {
        return $this->hasMany('App\OrderProduct', 'id', 'product_id');
    }
}
