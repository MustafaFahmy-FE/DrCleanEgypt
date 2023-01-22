<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //

    public function index()
    {
        $all_orders = Order::whereDate('created_at' , Carbon::today())->orderBy('id' , 'desc')->get();
        $orders = Order::where('payment' , 1)->whereDate('payment_date' , Carbon::today())->orderBy('id' , 'desc')->get();
        $expenses = Expense::whereDate('created_at' , Carbon::today())->orderBy('id' , 'desc')->get();

        $total = 0;
        
        foreach($all_orders as $order){
            $total = $total + $order->total_price_after_discount();
        }
        
        $total_payed_all = 0;
        
        foreach($all_orders as $order){
            if($order->payment == 1){
                $total_payed_all = $total_payed_all + $order->total_price_after_discount();    
            }
        }
        
        $total_unpayed_all = $total - $total_payed_all;
        
        $total_payed = 0;
        
        foreach($orders as $single){
            $total_payed = $total_payed + $single->total_price_after_discount();
        }
        
        $expenses_total = $expenses->sum('price');

        $difference = $total_payed - $expenses_total;
        
        return view('pages.reports.index' , compact('total_unpayed_all' , 'total_payed_all' , 'total' , 'orders' , 'all_orders' , 'total_payed' , 'expenses' , 'expenses_total' , 'difference'));
    }

    public function search(Request $request)
    {
        $from = date($request->from);
        $to = date($request->to);
        if ($from == $to || $to == '') {
            
            $all_orders = Order::whereDate('created_at' , $from)->orderBy('id' , 'desc')->get();
            $orders = Order::where('payment' , 1)->whereDate('payment_date' , $from)->orderBy('id' , 'desc')->get();
            $expenses = Expense::whereDate('created_at' , $from)->orderBy('id' , 'desc')->get();
        
            
        }else{
            
            $all_orders = Order::whereBetween('created_at' , [$from , $to])->orWhereDate('created_at' , $to)->orderBy('id' , 'desc')->get();
            $orders = Order::where('payment' , 1)->whereBetween('payment_date' , [$from.' 00:00:00' , $to.' 23:59:59'])->orderBy('id' , 'desc')->get();
            $expenses = Expense::whereBetween('created_at' , [$from , $to])->orWhereDate('created_at' , $to)->orderBy('id' , 'desc')->get();
            
        }
        
        $total = 0;
        
        foreach($all_orders as $order){
            $total = $total + $order->total_price_after_discount();
        }
        
        $total_payed_all = 0;
        
        foreach($all_orders as $order){
            if($order->payment == 1){
                $total_payed_all = $total_payed_all + $order->total_price_after_discount();    
            }
        }
        
        $total_unpayed_all = $total - $total_payed_all;
        
        $total_payed = 0;
        
        foreach($orders as $single){
            $total_payed = $total_payed + $single->total_price_after_discount();
        }
        
        $expenses_total = $expenses->sum('price');

        $difference = $total_payed - $expenses_total;
        

        return view('pages.reports.search' ,compact('from' , 'to' , 'total_unpayed_all' , 'total_payed_all' , 'total' , 'orders' , 'all_orders' , 'total_payed' , 'expenses' , 'expenses_total' , 'difference'));
    }

    public function daily_report(Request $request)
    {
        $orders = Order::where('payment' , 1)->whereDate('payment_date' , Carbon::today())->orderBy('id' , 'desc')->get();
        $expenses = Expense::whereDate('created_at' , Carbon::today())->orderBy('id' , 'desc')->get();

        $orders_total = 0;
        
        foreach($orders as $order){
            $orders_total = $orders_total + $order->total_price_after_discount();
        }
        
        $expenses_total = $expenses->sum('price');

        $difference = $orders_total - $expenses_total;

        return view('pages.reports.daily' , compact('orders' , 'expenses' , 'orders_total' , 'expenses_total' , 'difference'));
    }

    public function report(Request $request)
    {
        $categories = Category::with('items')->get()->map(function ($query) {
            $query->ironing = 0;
            $query->laundry = 0;
            $query->sum = 0;

            return $query;
        });
        $ironing_sum = 0;
        $laundry_sum = 0;
        foreach ($categories as $category) {
            foreach ($category->items as $item) {
                if($request->from || $request->to){
                    $from = date($request->from);
                    $to = date($request->to);
                    foreach ($item->orders()->get() as $order) {
                        
                        if ($from == $to || $to == '') {
                            $parent = $order->parent_order()->first();
                            if(!$parent->trashed() &&
                                $parent->payment == 1 &&
                                Carbon::parse($parent->payment_date)->format('d-m-y') == Carbon::parse($from)->format('d-m-y')){
                                if ($order->status == 'كي') {
                                    $category->ironing = $category->ironing + $order->quantity;
                                    $ironing_sum += $order->price;
                                }else{
                                    $category->laundry = $category->laundry + $order->quantity;
                                    $laundry_sum += $order->price;
                                }   
                                $category->sum += $order->price;
                            }
                        }else{
                            $parent = $order->parent_order()->where('deleted_at' , null)->whereBetween('payment_date' , [$from.' 00:00:00' , $to.' 23:59:59'])->first();
                            
                            if(isset($parent)){
                                if ($order->status == 'كي') {
                                    $category->ironing = $category->ironing + $order->quantity;
                                    $ironing_sum += $order->price;
                                }else{
                                    $category->laundry = $category->laundry + $order->quantity;
                                    $laundry_sum += $order->price;
                                }   
                                $category->sum += $order->price;
                            }
                            
                        }
                    }
                }else{
                    foreach ($item->orders()->orderBy('id' , 'desc')->get() as $order) {
                        $parent = $order->parent_order()->first();
                        
                        if(!$parent->trashed() && $parent->payment == 1 &&Carbon::parse($parent->payment_date)->format('d-m-y') == Carbon::today()->format('d-m-y') ){
                            if ($order->status == 'كي') {
                                $category->ironing = $category->ironing + $order->quantity;
                                $ironing_sum += $order->price;
                            }else{
                                $category->laundry = $category->laundry + $order->quantity;
                                $laundry_sum += $order->price;
                            }   
                        
                            $category->sum += $order->price;
                        }
                        
                    }
                }
            }
        }

        return view('pages.reports.report' , compact('categories' , 'laundry_sum' , 'ironing_sum'));
    }
}
