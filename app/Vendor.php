<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    public function products()
    {
        return $this->hasMany('App\Product', 'vendors_id', 'id');
    }
}
