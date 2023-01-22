<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('status' , '!=', 1)->orWhere('payment' ,'!=', 1)->orderBy('id', 'desc')->get();

        return view('pages.orders.all' ,compact('orders'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function archive()
    {
        if (request()->ajax()) {
            $data = Order::where('status' , 1)->where('payment' , 1)->orderBy('id' , 'desc')->get()->map(function ($query){
                if ($query->status == 0) {
                     $query->update_status = '<span class="status yellow_bc"> جارى التنفيذ </span>';
                }elseif ($query->status == 1) {
                     $query->update_status = '<span class="status green_bc"> تم التنفيذ </span>';
                }else{
                     $query->update_status = '<span class="status red_bc"> خاطئ  (Void)</span>';
                }

                $query->payment = $query->payment == 0 ? '<span class="status yellow_bc"> لم يتم السداد </span>' : '<span class="status green_bc"> تم السداد </span>';
                $query->id_url = '<a href="'.route('orders.show', ['id' => $query->id]) .'"class="table_link">'. $query->id.'</a>';
                $query->color = ((!Carbon::parse($query->created_at)->isToday()) && $query->status == 0) ? 1 : 0;

                return [
                    'id' => $query->id,
                    'id_url' => $query->id_url,
                    'name' => $query->client['name'],
                    'accept_date' => $query->created_at->format('(H:i) d-m-Y'),
                    'delivery' => $query->working_days_count()->format('d-m-Y'),
                    'total' => $query->total_price_after_discount(),
                    'status' => $query->update_status,
                    'status_num' => $query->status,
                    'payment' => $query->payment,
                    'color' => $query->color
                ];
            });

            // dd($data);
            return datatables()->of($data)
                ->addColumn('action', function($row) {
                    $btn = '';
                    $btn = '<a class="fa fa-info icon_link" title="تفاصيل الطلب" href="'.route('orders.show', ['id' => $row['id']]).'" style="margin-left:5px;"></a>';
                    $btn = $btn.'<a href="'.route('orders.print', ['id' => $row['id']]).' " style="margin-left:5px;" class="link green_bc" target="_blank"><span> طباعة الفاتورة </span></a>';
                    if (auth()->user()->role == 'admin') {
                        $btn = $btn.'<button data-url="'.route('orders.delete', ['id' => $row['id']]) .'" class="delete-btn icon_link red_bc fa fa-trash"></button>';
                    }
                    return $btn;
                })
                ->setRowClass(function ($row) {
                    return $row['color'] == 1 ? 'alert-danger' : '';
                })
                ->rawColumns(['action' , 'status' , 'payment' , 'id_url'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('pages.orders.archive');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::all();
        $categories = Category::all();

        return view('pages.orders.create' ,compact('clients' , 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  OrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        try {
            $request->store();

            return add_response("تم إضافه الطلب بنجاح");
        } catch (\Throwable $th) {
            return error_response();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);
        $employees = Employee::all()->sortByDesc('id');

        return view('pages.orders.show' ,compact('order' , 'employees'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $clients = Client::all();
        $categories = Category::all();
        $order = Order::findOrFail($id);

        return view('pages.orders.edit' ,compact('clients' , 'categories' , 'order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  OrderRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrderRequest $request, $id)
    {
        try {
            $request->update($id);

            return update_response('تم تعديل بيانات الطلب بنجاح');
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
        Order::findOrFail($id)->delete();

        return redirect()->back();
    }

    /**
     * change order status
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function change_status(Request $request ,  $id)
    {
        $validation = validator($request->all() , [
            'employee' => 'not_in:0'
        ] ,[] ,[
            'employee' => 'الموظف'
        ]);
        
        if($validation->fails())
            return response()->json( $validation->errors()->first(), 400);
            
        $order = Order::findOrFail($id);

        $order->status = $request->status;
        $order->employee_name = $request->employee;

        $order->save();

        return response()->json('تم تغيير حاله الطلب بنجاح' , 200);
    }

    /**
     * change order payment status
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function change_payment($id)
    {
        $order = Order::findOrFail($id);

        $order->change_payment();

        $order->save();

        return redirect()->back();
    }

    /**
     * return print order page
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function print($id)
    {
        $order = Order::findOrFail($id);

        return view('pages.orders.print' , compact('order'));
    }

    /**
     * return print asset page
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function asset($id)
    {
        $order = Order::findOrFail($id);

        return view('pages.orders.asset' , compact('order'));
    }
}
