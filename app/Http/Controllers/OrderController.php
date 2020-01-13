<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Order_detail;
use App\Inventory;
use App\Order_status;
use Session;
use Redirect;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        foreach($orders as $order){
            $order->status  =  Order_status::find($order->order_status_id)->status_name;
        }
        return view('order.index')->withOrders($orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $order_status = Order_status::all();
        $inventory   = Inventory::all();
        return view('order.create')->withOrderStatus($order_status)->withInventory($inventory);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

//find the max available quantity of the product
         // $quantity = Inventory::find($request->product_id)->quantity_available;

    //validation for order inputs
        $this->validate($request, array(
                'customer_email'         => 'required|max:255|email',
                'order_status_id'          => 'required|integer',
                'inventory_id' => 'required|min:1',
                'quantity' => 'required|min:1',
                'quantity.*'=> 'integer|min:1'
        ));

        $order_detail[]  = new Order_detail;
        $order = new Order;
        $order->customer_email = $request->customer_email;
        $order->order_status_id = $request->order_status_id;
        $order->save();


        foreach($request->inventory_id as $key => $inventory_id){
            if($request->quantity[$key] > 0 ){
                $quantity_available = Inventory::find($inventory_id)->quantity_available;

                 $name = Inventory::find($inventory_id)->name;

                if($request->quantity[$key] < $quantity_available){
                    $order_detail[$key] =  
                    [
                        'order_id' => $order->id,
                        'inventory_id' => $inventory_id,
                        'quantity'=> $request->quantity[$key]
                    ];
                }
                else{
                 
                    return back()->with('message', 'Inventory shortage for '.$name);
                }

            }
        }

          // store in the database

        Inventory::deduct_inventory($order_detail);
        Order_detail::add_order_detail($order_detail);
        return redirect()->route('order.index');
            
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::find($id);

        foreach($order->order_details as $key=> $details)  {
            $order_details[$key]  = [
                "name" => Inventory::find($details->inventory_id)->name,
                "quantity" => $details->quantity
            ];
        }
        $order_status = Order_status::all();
        return view('order.edit')->withOrderStatus($order_status)->withOrder($order)->withOrderDetails($order_details);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            'customer_email'         => 'required|max:255|email',
            'order_status_id'          => 'required|integer',
            'quantity.*'=> 'integer|min:1'
        ));
        $order = Order::find($id);

        foreach($order->order_details as $key=> $details)  {

            $quantity_available = Inventory::find($details->inventory_id)->quantity_available;

            $name = Inventory::find($details->inventory_id)->name;

            if( $request->quantity[$key] - $details->quantity <= $quantity_available){
                Inventory::update_inventory($details->inventory_id ,$details->quantity ,$request->quantity[$key] );
                Order_detail::update_quantity($details->inventory_id ,$id , $request->quantity[$key]) ;
            }
            else{
                return back()->with('message', 'Inventory shortage for '.$name);
            }
        }

        $order->customer_email = $request->customer_email;
        $order->order_status_id = $request->order_status_id;

        $order->save();

        // set flash data with success message
        Session::flash('success', 'The order has been successfully updated!');

        return redirect()->route('order.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $order = Order::find($id);
        //add back to inventory
        Inventory::revert_inventory($order->order_details);

        $order->delete();

        Session::flash('success', 'The order has been successfully deleted.');
        return redirect()->route('order.index');
    }

}
