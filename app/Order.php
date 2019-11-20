<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function partners()
    {
        return $this->hasOne('App\Partner', 'id', 'partner_id');
    }

    public function orderProducts()
    {
        return $this->hasMany('App\OrderProduct', 'order_id', 'id');
    }

}
