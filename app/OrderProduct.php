<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    public function orders()
    {
        return $this->belongsTo('App\Order', 'order_id', 'id');
    }

    public function products()
    {
        return $this->belongsTo('App\Product', 'product_id', 'id');
    }
}
