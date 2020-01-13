<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

      public function order_statuses()
    {
        return $this->belongsTo('App\Order_status');
    }

     public function order_details()
    {
        return $this->hasMany('App\Order_detail');
    }
}
