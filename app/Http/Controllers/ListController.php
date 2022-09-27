<?php

namespace App\Http\Controllers;
use App\Models\Item;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function index(){
        $items = Item::all();
        return view('list', compact('items'));
    }

    public function create(Request $request){
        $item = new Item;
        $itme_data = $request->text;
        $itemcount = Item::where('item', $itme_data)->count();
        if($itemcount>0){
            return "this task is already exist";
        } else {
            $item->item = $itme_data;
            $item->save();
            return "Done";
        }
    }

    public function update(Request $request){
        $item = Item::find($request->id);
        $itme_data= $request->value;
        $itemcount = Item::where('item', $itme_data)->count();
        if($itemcount>0){
            return "this task is already exist";
        } else {
            $item->item = $itme_data;
            $item->save();
            return "Done";
        }
    }


    public function delete(Request $request){
        $item = Item::where('id', $request->id);
        $item->delete();
        return "item deleted";
    }
}