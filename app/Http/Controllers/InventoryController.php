<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventory;
use Session;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventory = Inventory::orderBy('id', 'desc')->paginate(10);
        return view('inventory.index')->withInventory($inventory);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('inventory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


//validation for inventory inputs

        $this->validate($request, array(
                // 'name'         => 'required|max:255|unique:inventory,name',
                'name'         => 'required|max:255|unique:inventories,name',
                'description'          => 'required|min:5|max:255|',
                'price'       => 'required|numeric|min:0',
                'quantity_available'       => 'required|digits_between:0,9999'
            ));


        // store in the database

        $product = new Inventory;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity_available = $request->quantity_available;

        $product->save();

        Session::flash('success', 'The product '. $product->name .' was successfully updated!');


        return redirect()->route('inventory.show', $product->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $inventory = Inventory::find($id);
        return view('inventory.show')->withInventory($inventory);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Inventory::find($id);
        return view('inventory.edit')->withInventory($product);
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
        $product = Inventory::find($id);
        if ($request->input('name') == $product->name) {
            $this->validate($request, array(
                'description'          => 'required|min:5|max:255|',
                'price'       => 'required|numeric|min:0',
                'quantity_available'       => 'required|digits_between:0,9999'
            ));
        } else {
        $this->validate($request, array(
                'name'         => 'required|max:255|unique:inventories,name',
                'description'          => 'required|min:5|max:255|',
                'price'       => 'required|numeric|min:0',
                'quantity_available'       => 'required|digits_between:0,9999',
            ));
        }

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity_available = $request->quantity_available;
        $product->save();

        // set flash data with success message
        Session::flash('success', 'The product '. $product->name .' was successfully save!');

        return redirect()->route('inventory.show', $product->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inventory = Inventory::find($id);
        $name = $inventory->name;
        $inventory->delete();

        Session::flash('success', 'The product '. $name .' was successfully deleted.');
        return redirect()->route('inventory.index');
    }
}
