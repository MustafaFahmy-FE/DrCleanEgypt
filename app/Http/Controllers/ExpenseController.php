<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseRequest;
use App\Models\Expense;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        if($request->from || $request->to || $request->name){
            $expenses = Expense::select('*');
            if ($request->name) {
                $expenses = $expenses->where('name' , $request->name);
            }
            if ($request->to || $request->from) {
                $from = date($request->from);
                $to = date($request->to);
                if ($from == $to) {
                    $expenses = $expenses->whereDate('created_at' , $from);
                }else{
                    $expenses = $expenses->whereBetween('created_at' , [$from , $to])->orWhereDate('created_at' , $to);
                }
            }
            $expenses = $expenses->orderBy('id' , 'desc')->get();

        }else{
            $expenses = Expense::whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->orderBy('id' , 'desc')->get();
        }

        $sum = 0;
        if ($request->name) {
            foreach ($expenses as $expense) {
                $sum += $expense->price;
            }
        }

        return view('pages.expenses.all' ,compact('expenses' , 'sum'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ExpenseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExpenseRequest $request)
    {
        try {
            $request->store();

            return add_response("تم إضافه المصروف بنجاح");
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
        $expense = Expense::findOrFail($id);

        return view('pages.expenses.edit' ,compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ExpenseRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExpenseRequest $request, $id)
    {
        try {
            $request->update($id);

            return update_response("تم تعديل بيانات المصروف بنجاح");
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
        Expense::findOrFail($id)->delete();

        return redirect()->back();
    }
}
