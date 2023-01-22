<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use App\Models\Order;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::orderBy('id' , 'desc')->get();
        
        return view('pages.employees.all' ,compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  EmployeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        try {
            $request->store();

            return add_response("تم إضافه الموظف بنجاح");
        } catch (\Throwable $th) {
            return error_response();
        }
    }
    
    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        $orders = Order::where('employee_name' , $employee->name)->get();
        $sum = 0 ;

        foreach ($orders as $order) {
            $sum+= $order->total_price_after_discount();
        }
        
        $total = 0;
        
        foreach($orders as $order){
            $total = $total + $order->total_price_after_discount();
        }
        
        $total_payed_all = 0;
        
        foreach($orders as $order){
            if($order->payment == 1){
                $total_payed_all = $total_payed_all + $order->total_price_after_discount();    
            }
        }
        
        $total_unpayed_all = $total - $total_payed_all;
        
        return view('pages.employees.show' , compact('employee' , 'orders' , 'sum' , 'total_payed_all', 'total_unpayed_all'));
    }
    
    public function search(Request $request , $id)
    {
        $from = date($request->from);
        $to = date($request->to);
        $employee = Employee::findOrFail($id);
        
        if ($from == $to || $to == '') {
            $orders = Order::where('employee_name' , $employee->name)->whereDate('created_at' , $from)->get();   
        }else{
            $orders = Order::where('employee_name' , $employee->name)->WhereDate('created_at' ,'<=', $to)->WhereDate('created_at' ,'>=', $from)->get();    
        }
        $sum = 0 ;

        foreach ($orders as $order) {
            $sum+= $order->total_price_after_discount();
        }
        
        $total = 0;
        
        foreach($orders as $order){
            $total = $total + $order->total_price_after_discount();
        }
        
        $total_payed_all = 0;
        
        foreach($orders as $order){
            if($order->payment == 1){
                $total_payed_all = $total_payed_all + $order->total_price_after_discount();    
            }
        }
        
        $total_unpayed_all = $total - $total_payed_all;
        
        return view('pages.employees.search' , compact('employee' , 'orders' , 'sum', 'total_payed_all', 'total_unpayed_all'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);

        return view('pages.employees.edit' ,compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EmployeeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, $id)
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
        Employee::findOrFail($id)->delete();

        return redirect()->back();
    }
}
