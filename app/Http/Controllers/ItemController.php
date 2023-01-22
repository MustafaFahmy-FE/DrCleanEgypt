<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Exports\ItemExport;

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
        $categories = Category::all();

        return view('pages.items.all' ,compact('items' , 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request)
    {
        try {
            $request->store();

            return add_response("تم إضافه الصنف بنجاح");
        } catch (\Throwable $th) {
            return error_response();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $categories = Category::all();

        return view('pages.items.edit' ,compact('item' , 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ItemRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ItemRequest $request, $id)
    {
        try {
            $request->update($id);

            return update_response("تم تعديل بيانات الصنف بنجاح");
        } catch (\Throwable $th) {
            return error_response();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Item::findOrFail($id)->delete();

        return redirect()->back();
    }
    
    public function export() 
    {
        return \Excel::download(new ItemExport, 'items.xlsx');
    }
}
