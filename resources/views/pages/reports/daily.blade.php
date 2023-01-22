@extends('layouts.master')
@section('content')
    <div class="dashboard_content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="widget" style="padding: 25px">
                        <div class="row">
                            
                            <div class="col-lg-9 col-md-8">
                                 <table class="table table-bordered">
                                    <thead style="background-color:#dbefff">
                                        <tr>
                                            <th>رقم الطلب</th>
                                            <th>إسم العميل</th>
                                            <th> الأجمالى +</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $index => $order)
                                            <tr>
                                                <td>
                                                   {{ ++$index }}
                                                </td>
                                                <td>
                                                   {{ $order->client->name }}
                                                </td>
                                                <td>
                                                      {{ $order->total_price_after_discount() }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <thead style="background-color: #dbefff">
                                        <tr>
                                            <th>رقم االمصروف</th>
                                            <th>إسم المصروف</th>
                                            <th> الأجمالى - </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($expenses as $index => $expense)
                                            <tr>
                                                <td>
                                                    {{ ++$index }}
                                                </td>
                                                <td>
                                                    {{ $expense->name }}
                                                </td>
                                                <td>
                                                    {{ $expense->price }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-3 col-md-4">
                                <div class="daily_total">
                                    الإجمالى
                                    <span>
                                        {{ $difference }} جنيه
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
