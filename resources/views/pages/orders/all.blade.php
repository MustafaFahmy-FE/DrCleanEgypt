@extends('layouts.master')
@section('content')
    <div class="dashboard_content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="widget">
                        <div class="widget_title">
                            قائمة الطلبات

                            <a href="{{ route('orders.create') }}" class="link green_bc widget_link">
                                <span> + إضافة طلب جديد </span>
                            </a>
                        </div>
                        <div class="widget_content">
                            <div class="table-responsive">
                                <table class="table table-bordered datatable_full1" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
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
                                        @php
                                            $x = 1;
                                        @endphp
                                        @foreach ($orders as $index => $order)
                                            <tr
                                                class="{{ ((!\Carbon\Carbon::parse($order->created_at)->isToday()) && $order->status == 0) ? 'alert-danger' : '' }}">
                                                <th>{{ $x }}</th>
                                                <td><a href="{{ route('orders.show', ['id' => $order->id]) }}"
                                                        class="table_link">{{ $order->id }}</a>
                                                </td>
                                                <td>{{ $order->client->name }}</td>
                                                <td>{{ $order->created_at->format('(H:i) d-m-Y') }}</td>
                                                <td>{{ $order->working_days_count()->format('d-m-Y') }}</td>
                                                <td>{{ $order->total_price_after_discount() }}</td>
                                                <td>
                                                    @if($order->status == 0)
                                                    <span class="status yellow_bc"> جارى التنفيذ </span>
                                                    @else
                                                    <span class="status green_bc">تم التنفيذ</span>
                                                    @endif
                                                </td>
                                                <td>{!! $order->payment == 0
                                                    ? '<span class="status yellow_bc"> لم يتم السداد </span>'
                                                    : '<span class="status green_bc"> تم السداد </span>' !!}
                                                </td>
                                                <td>
                                                    <a class="fa fa-info icon_link" title="تفاصيل الطلب"
                                                        href="{{ route('orders.show', ['id' => $order->id]) }}"
                                                        style="margin-left:5px;"></a>
                                                    <a href="{{ route('orders.print', ['id' => $order->id]) }}"
                                                        style="margin-left:5px;" class="link green_bc"
                                                        target="_blank"><span> طباعة الفاتورة
                                                        </span></a>
                                                    @if (auth()->user()->role == 'admin')
                                                        <button
                                                            data-url="{{ route('orders.delete', ['id' => $order->id]) }}"
                                                            class="delete-btn icon_link red_bc fa fa-trash"></button>
                                                    @endif
                                                </td>
                                            </tr>
                                            @php
                                                $x++;
                                            @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
