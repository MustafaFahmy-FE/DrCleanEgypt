<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id' , 'desc')->get()->map(function ($query) {
            $query->counter = 0;

            return $query;
        });

        foreach ($categories as $key => $category) {
            $category->counter = $category->items()->count();
            if($category->subs()->count() > 0){
                foreach ($category->subs() as $key => $sub) {
                    $category->counter = $category->counter + $sub->items()->count();
                }
            }
        }

        return view('pages.categories.all' ,compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        try {
            $request->store();

            return add_response("تم إضافه القسم بنجاح");
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
        $category = Category::findOrFail($id);

        return view('pages.categories.edit' ,compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  categoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        try {
            $request->update($id);

            return update_response("تم تعديل بيانات القسم بنجاح");
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
        Category::findOrFail($id)->delete();

        return redirect()->back();
    }
}
