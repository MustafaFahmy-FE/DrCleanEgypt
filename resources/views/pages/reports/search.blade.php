@extends('layouts.master')
@section('content')
    <div class="dashboard_content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="widget">
                        <div class="widget_title">تقارير المبيعات</div>
                        <div class="widget_content">
                            <form class="report_form" method="get" action="{{ route('search') }}">
                                @csrf
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label> من </label>

                                                <div class="inline_data">
                                                    <i class="fa fa-calendar-alt"></i>

                                                    <input type="text" class="form-control flatpickr-input"
                                                        name="from" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label> إلى </label>

                                                <div class="inline_data">
                                                    <i class="fa fa-calendar-alt"></i>

                                                    <input type="text" class="form-control flatpickr-input"
                                                        name="to" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="link green_bc" type="submit">
                                        <span> مشاهدة التقرير </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
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
                                        @foreach ($all_orders as $index => $order)
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
                                </table>
                            </div>
                            <div class="col-lg-3 col-md-4">
                                <div class="daily_total" style="margin-bottom: 15px;">
                                    إجمالي الطلبات
                                    <span>
                                        {{ $total }} جنيه
                                    </span>
                                </div>
                                <div class="daily_total" style="margin-bottom: 15px;">
                                    إجمالي الخدمات والتوصيل
                                    <span>
                                        {{ $all_orders->sum('service') + $all_orders->sum('delivery') }} جنيه
                                    </span>
                                </div>
                                <div class="daily_total" style="margin-bottom: 15px;">
                                    إجمالي المسدد
                                    <span>
                                        {{ $total_payed_all }} جنيه
                                    </span>
                                </div>
                                <div class="daily_total">
                                    إجمالي الغير مسدد
                                    <span>
                                        {{ $total_unpayed_all }} جنيه
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                <div class="daily_total" style="margin-bottom: 15px;">
                                    إجمالي الخزينة
                                    <span>
                                        {{ $total_payed }} جنيه
                                    </span>
                                </div>
                                <div class="daily_total" style="margin-bottom: 15px;">
                                    إجمالي المصروفات
                                    <span>
                                        {{ $expenses_total }} جنيه
                                    </span>
                                </div>
                                <div class="daily_total">
                                    الإجمالى بعد خصم المصروفات
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
