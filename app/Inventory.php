<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Http\Request;


class Inventory extends Model
{

    public function order_details()
    {
    	return $this->belongsTo('App\Order_detail');
    }

    public static function deduct_inventory($order_detail){
        foreach($order_detail as $key=> $detail){
            DB::table('inventories')->where('id' , $detail['inventory_id']) ->decrement('quantity_available', $detail['quantity']);  
        }          
    }

    public static function revert_inventory($order_detail){
    	foreach($order_detail as $key=> $detail){
           DB::table('inventories')->where('id' , $detail['inventory_id']) ->increment('quantity_available', $detail['quantity']);
        }
    }
    

    public static function update_inventory($inventory_id, $origin_quantity, $updated_quantity){
        if($origin_quantity > $updated_quantity){
            DB::table('inventories')->where('id' ,$inventory_id) ->increment('quantity_available', $origin_quantity - $updated_quantity);
        }
        else{
            DB::table('inventories')->where('id' ,$inventory_id) ->decrement('quantity_available', $updated_quantity - $origin_quantity );
        }
    }

}
