<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order_detail extends Model
{
	public function inventories()
    {
    	return $this->hasMany('App\Inventory');
    }

     public function orders()
    {
        return $this->belongsTo('App\Order');
    }

    public static function add_order_detail($order_detail){


    	foreach($order_detail as $detail){
    		DB::table('order_details')->insert([
			    [
			    	'order_id' => $detail['order_id'], 
			    	'inventory_id' => $detail['inventory_id'],
			    	'quantity'=> $detail['quantity']
			    ]
			]);

    	}
    }

    public static function update_quantity($inventory_id, $order_id , $quantity){
    	DB::table('order_details')->where([
    		["inventory_id", '=', $inventory_id],
    		['order_id' , '=' , $order_id]
    	])->update(
		    [
		    	'quantity'=> $quantity
		    ]
		);

    }
}
