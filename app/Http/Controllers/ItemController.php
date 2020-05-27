<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use Session;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();
        return view('item.index')->withItems($items);
       
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

         $this->validate($request, array(
                'name'         => 'required|max:255|unique:items,name',
                'weight'          => 'required|min:0|numeric',
                'length'          => 'required|min:0|numeric',
                'width'          => 'required|min:0|numeric',
                'height'          => 'required|min:0|numeric',
        ));
        $item = new Item;
        $item->name = $request->name;
        $item->weight = $request->weight;
        $item->length = $request->length;
        $item->width = $request->width;
        $item->height = $request->height;
        $item->save();


         Session::flash('success', 'The item '. $item->name.' has been successfully created!');

        return redirect()->route('item.index');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        

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
        $item = Item::find($id);
        if($item->name == $request->name){
            $this->validate($request, array(
                'weight'          => 'required|min:0|numeric',
                'length'          => 'required|min:0|numeric',
                'width'          => 'required|min:0|numeric',
                'height'          => 'required|min:0|numeric'
            ));
        }
        else{
            $this->validate($request, array(
                'name'         => 'required|max:255|unique:items,name',
                'weight'          => 'required|min:0|numeric',
                'length'          => 'required|min:0|numeric',
                'width'          => 'required|min:0|numeric',
                'height'          => 'required|min:0|numeric'
            )); 
        }
        
        $item->name = $request->name;
        $item->weight = $request->weight;
        $item->length = $request->length;
        $item->width = $request->width;
        $item->height = $request->height;
        $item->save();

        // set flash data with success message
        Session::flash('success', 'The item '. $item->name.' has been successfully updated!');

        return redirect()->route('item.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        $name  = $item->name;
        $item->delete();
        Session::flash('success', 'The item  '. $name.'  has been successfully deleted.');
        return redirect()->route('item.index');
    }
}
