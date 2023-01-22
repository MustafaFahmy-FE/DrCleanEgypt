<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Js;

class AjaxController extends Controller
{
    //

    public function client(Request $request)
    {
        $validator = validator($request->all() , [
            'client_id' => 'not_in:0'
        ] , [] , [
            'client_id' => 'إسم العميل'
        ]);

        if ($validator->fails()) {
            return failed_validation($validator->errors()->first());
        }

        $id = $request->client_id;

        $client = Client::findOrFail($id);

        return response()->json(view('pages.orders.templates.client' ,compact('client'))->render() , 200);
    }

    public function items(Request $request)
    {
        $validator = validator($request->all() , [
            'category_id' => 'not_in:0'
        ] , [] , [
            'category_id' => 'القسم'
        ]);

        if ($validator->fails()) {
            return failed_validation($validator->errors()->first());
        }

        $category_id = $request->category_id;
        $items = Item::all()->where('category_id' , $request->category_id);

        return response()->json(view('pages.orders.templates.items' ,compact('items'))->render() , 200);
    }

    public function prices(Request $request)
    {
        $item = Item::findOrFail($request->item_id);

        return response()->json(view('pages.orders.templates.status' ,compact('item'))->render() , 200);
    }

    public function submit_item(Request $request)
    {
        // dd($request->all());
        $validator = validator($request->all() , [
            'category_id' => 'not_in:0',
            'item_id' => 'not_in:0',
            'qty' => ['required' , 'numeric']
        ] , [] , [
            'category_id' => 'القسم',
            'item_id' => 'الصنف',
            'qty' => 'الكمية'
        ]);

        if ($validator->fails()) {
            return failed_validation($validator->errors()->first());
        }

        $item = Item::findOrFail($request->item_id);
        $discount = $request->disc;
        $quantity = $request->qty;
        $status = $request->status;
        
        if($status == 'غسيل'){
            $price = $item->laundry_price;
        }else{
            $price = $item->ironing_price;
        }

        return response()->json([
            'view' => view('pages.orders.templates.order' , compact('item' , 'discount' , 'quantity' , 'status' , 'price'))->render(),
            'discount' => $request->disc,
            'quantity' => $request->qty,
            'status' => $request->status,
            'item' => $request->item_id,
            'price' => $request->status == 'غسيل' ? $item->laundry_price : $item->ironing_price
        ] , 200);
    }
}
