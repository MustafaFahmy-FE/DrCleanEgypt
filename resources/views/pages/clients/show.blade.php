@extends('layouts.master')
@section('content')
    <div class="dashboard_content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="widget">
                        <div class="widget_title">
                            <i class="far fa-user"></i> بيانات العميل
                        </div>
                        <div class="widget_content">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="data_item">
                                        <i class="fa fa-info"></i>
                                        إسم العميل
                                        <span> {{ $client->name }} </span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="data_item">
                                        <i class="fa fa-phone"></i>
                                        رقم الهاتف
                                        <span class="en"> {{ $client->phone }} </span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="data_item">
                                        <i class="fa fa-map-marker-alt"></i>
                                        العنوان
                                        <span>
                                            {{ $client->address }}
                                        </span>
                                        <span> بلوك {{ $client->building }} - الدور {{ $client->floor }} -
                                            شقة
                                            {{ $client->apartment }} </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="widget ">
                        <div class="widget_title">إحصائيات</div>
                        <div class="widget_content bill_total">
                            <li>
                                عدد الطلبات
                                <span>
                                    {{ $client->orders->count() }}</span>
                            </li>
                            <li>
                                إجمالي الطلبات
                                <span>
                                    {{ $client->orders->sum('total') }}</span>
                            </li>
                            <li>
                                إجمالي المسدد
                                <span>
                                    {{ $client->orders->where('payment', 1)->sum('total') }}</span>
                            </li>
                            <li>
                                غير المسدد
                                <span>
                                    {{ $client->orders->where('payment', 0)->sum('total') }}</span>
                            </li>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="widget">
                    <div class="widget_title">
                        <i class="fa fa-info"></i> الطلبات
                    </div>
                    <div class="widget_content">
                        <div class="table-responsive">
                            <table class="table table-bordered datatable_full" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>رقم الطلب</th>
                                        <th>تاريخ الأستلام</th>
                                        <th> تاريخ التسليم</th>
                                        <th>الأجمالى</th>
                                        <th>الحالة</th>
                                        <th>حاله السداد</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($client->orders as $index => $order)
                                        <tr>
                                            <td>
                                                <a href="{{ route('orders.show', ['id' => $order->id]) }}"
                                                    class="table_link">
                                                    {{ $order->id }}
                                                </a>
                                            </td>
                                            <td>{{ $order->created_at->format('d-m-Y') }}</td>
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
                                                @if ($order->status == 1)
                                                    <a href="{{ route('orders.print', ['id' => $order->id]) }}"
                                                        class="link green_bc">
                                                        <span> طباعة الفاتورة </span>
                                                    </a>
                                                @endif
                                                @if (auth()->user()->role == 'admin')
                                                    <button data-url="{{ route('orders.delete', ['id' => $order->id]) }}"
                                                        class="delete-btn icon_link red_bc fa fa-trash"></button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!--End Row-->
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
