<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attendances = Attendance::whereDate('created_at', Carbon::today())->get();
        $employees = Employee::all();

        return view('pages.attendances.index' ,compact('attendances' , 'employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = validator($request->all() , [
            'employee_id' => ['not_in:0'],
            'type' => ['not_in:-1'] 
        ] , [] , [
            'employee_id' => 'الموظف',
            'type' => 'النوع'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->first(), 400);
        }

        try {
            Attendance::create($request->all());

            return add_response("تم إضافه الإذن بنجاح");
        } catch (\Throwable $th) {

            dd($th->getMessage());
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
        $employee = Employee::findOrFail($id);

        return view('pages.attendances.show' , compact('employee'));
    }
}
