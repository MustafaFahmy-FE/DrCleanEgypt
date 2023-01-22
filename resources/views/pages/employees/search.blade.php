@extends('layouts.master')
@section('content')
    <div class="dashboard_content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="widget">
                        <div class="widget_title">تقارير الموظفين</div>
                        <div class="widget_content">
                            <form method="get" action="{{ route('employees.search' ,['id' => $employee->id]) }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> من </label>

                                            <div class="inline_data">
                                                <i class="fa fa-calendar-alt"></i>

                                                <input type="text" class="form-control flatpickr-input" name="from" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> إلى </label>

                                            <div class="inline_data">
                                                <i class="fa fa-calendar-alt"></i>

                                                <input type="text" class="form-control flatpickr-input" name="to" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="link green_bc" type="submit">
                                    <span> مشاهدة التقرير </span>
                                </button>
                            </form>

                        </div>
                    </div>
                    <div class="widget">
                        <div class="widget_title">
                            <i class="fa fa-info"></i> الطلبات
                        </div>
                        <div class="widget_content">
                            <div class="row">
                                <div class="col-lg-9 col-md-8">
                                    <div class="table-responsive">
                                        <table class="table table-bordered datatable_full" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>رقم الطلب</th>
                                                    <th>إسم العميل</th>
                                                    <th>تاريخ الأستلام</th>
                                                    <th> تاريخ التسليم</th>
                                                    <th>الأجمالى</th>
                                                    <th>الحالة</th>
                                                    <th>حاله السداد</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orders as $index => $order)
                                                    <tr>
                                                        <td>
                                                            <a href="{{ route('orders.show', ['id' => $order->id]) }}"
                                                                class="table_link">
                                                                {{ $order->id }}
                                                            </a>
                                                        </td>
                                                        <td>{{ $order->client->name }}</td>
                                                        <td>{{ $order->created_at->format('(H:i) d-m-Y ') }}</td>
                                                        <td>{{ $order->working_days_count()->format('d-m-Y') }}</td>
                                                        <td>{{ $order->total_price_after_discount() }}</td>
                                                        <td>
                                                            @if ($order->status == 0)
                                                                <span class="status yellow_bc"> جارى التنفيذ </span>
                                                            @elseif ($order->status == 1)
                                                                <span class="status green_bc"> تم التنفيذ </span>
                                                            @else
                                                                <span class="status red_bc"> خاطئ (Void)</span>
                                                            @endif

                                                        </td>
                                                        <td>
                                                            @if ($order->payment == 0)
                                                                <span class="status yellow_bc"> لم يتم السداد </span>
                                                            @else
                                                                <span class="status green_bc"> تم السداد </span>
                                                            @endif

                                                        </td>
                                                        <td>
                                                            <a class="fa fa-info icon_link" title="تفاصيل الطلب"
                                                                href="{{ route('orders.show', ['id' => $order->id]) }}"></a>
                                                            
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!--End Row-->
                                </div>
                                <div class="col-lg-3 col-md-4">
                                    <div class="daily_total" style="margin-bottom: 15px;">
                                        الإجمالي
                                        <span>
                                            {{ $sum }} جنيه
                                        </span>
                                    </div>
                                    <div class="daily_total" style="margin-bottom: 15px;">
                                         المدفوع
                                        <span>
                                            {{ $total_payed_all }} جنيه
                                        </span>
                                    </div>
                                    <div class="daily_total" style="margin-bottom: 15px;">
                                         غير المدفوع
                                        <span>
                                            {{ $total_unpayed_all }} جنيه
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
