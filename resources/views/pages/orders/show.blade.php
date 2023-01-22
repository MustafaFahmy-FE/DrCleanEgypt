@extends('layouts.master')
@section('content')
    <div class="dashboard_content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="widget order_head">
                        <h3>طلب رقم #{{ $order->id }}</h3>
                        <div class="btns">

                            @if ($order->status == 0)
                                <span class="status yellow_bc">
                                    <i class="fa fa-spinner fa-spin"></i>
                                    جارى التنفيذ
                                </span>
                            @elseif ($order->status == 1)
                                <span class="status green_bc">
                                    <i class="fa fa-check"></i>
                                    تم التفيذ
                                </span>
                            @else
                                <span class="status red_bc">
                                    <i class="fa fa-times"></i>
                                    خاطئ (Void)
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
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
                                        <span> {{ $order->client->name }} </span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="data_item">
                                        <i class="fa fa-phone"></i>
                                        رقم الهاتف
                                        <span class="en"> {{ $order->client->phone }} </span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="data_item">
                                        <i class="fa fa-map-marker-alt"></i>
                                        العنوان
                                        <span>
                                            {{ $order->client->address }}
                                        </span>
                                        <span> بلوك {{ $order->client->building }} - الدور {{ $order->client->floor }} -
                                            شقة
                                            {{ $order->client->apartment }} </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="widget">
                        <div class="widget_title">
                            <i class="fa fa-info"></i> تفاصيل الطلب
                        </div>
                        <div class="widget_content">
                            <div class="row">
                                @foreach ($order->details as $detail)
                                    <div class="col-md-4 col-sm-6">
                                        <div class="data_item cust">
                                            {{ $detail->item->name }}
                                            <span> العدد : {{ $detail->quantity }} </span>
                                            <span> السعر  :
                                                {{ $detail->status == 'غسيل' ? $detail->item()->firstOrFail()->laundry_price : $detail->item()->firstOrFail()->ironing_price }}
                                            </span>
                                            <span> الحاله : {{ $detail->status }} </span>
                                            <span> القسم : {{ $detail->item->category->name }} </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <!--End Row-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="widget">
                                <div class="widget_title">
                                    <i class="fas fa-dollar-sign"></i>
                                    خدمات إضافية
                                </div>
                                <div class="widget_content">
                                    {{ $order->service }} جنيه
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="widget">
                                <div class="widget_title">
                                    <i class="fas fa-dollar-sign"></i>
                                    خدمة التوصيل
                                </div>
                                <div class="widget_content">
                                    {{ $order->delivery }} جنيه
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="widget">
                        <div class="widget_title">
                            <i class="fas fa-exclamation-triangle"></i>
                            ملاحظات
                        </div>
                        <div class="widget_content">
                            @foreach (explode("\n", $order->notes) as $note)
                                <p>- {{ $note }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="widget ">
                        <div class="widget_title">تغيير حالة الطلب</div>
                        <form class="widget_content bill_total ajax-form" method="post"
                            action="{{ route('orders.change_status', ['id' => $order->id]) }}">
                            @csrf
                            <li>
                                <select name="status" class="form-control">
                                    <option value="0" {{ $order->status == 0 ? 'selected' : '' }}>قيد التنفيذ
                                    </option>
                                    <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>تم التنفيذ
                                    </option>
                                    <option value="-1" {{ $order->status == -1 ? 'selected' : '' }}>خاطئ
                                    </option>
                                </select>
                            </li>
                            <li>
                                <select name="employee" class="form-control">
                                    <option value="0">إختر الموظف</option>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->name }}"
                                            {{ $order->employee_name == $employee->name ? 'selected' : '' }}>
                                            {{ $employee->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </li>
                            <div class="col-12">
                                <button class="link green_bc">
                                    <span>
                                        <i class="fa fa-info"></i>
                                        تغيير الحاله
                                    </span>
                                </button>
                            </div>
                        </form>

                    </div>
                    <div class="widget ">
                        <div class="widget_title">تغيير حالة الدفع</div>
                        <form class="widget_content bill_total" method="get"
                            action="{{ route('orders.change_payment', ['id' => $order->id]) }}">
                            @csrf
                            <li>
                                <select name="payment" class="form-control">
                                    <option value="0" {{ $order->payment == 0 ? 'selected' : '' }}>لم يتم السداد
                                    </option>
                                    <option value="1" {{ $order->payment == 1 ? 'selected' : '' }}>تم السداد
                                    </option>
                                </select>
                            </li>
                            <div class="col-12">
                                <button class="link green_bc">
                                    <span>
                                        <i class="fa fa-info"></i>
                                        تغيير الحاله
                                    </span>
                                </button>
                            </div>
                        </form>

                    </div>
                    <div class="widget ">
                        <div class="widget_title en_font">Asset</div>
                        <div class="bill" id="bill-asset">
                            <div class="info">
                                <ul>
                                    <li class="w-100">
                                        رقم الفاتورة
                                        <span> # {{ $order->id }} </span>
                                    </li>
                                    <li class="w-100">
                                        تاريخ الأستلام
                                        <span> {{ $order->created_at->format('d-m-Y') }}</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="user">
                                <div class="title">العميل</div>
                                <ul>
                                    <li class="w-100">
                                        الأسم
                                        <span> {{ $order->client->name }} </span>
                                    </li>
                                    <li class="w-100">
                                        تليفون
                                        <span> {{ $order->client->phone }} </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="w-100 text-center mt-25">

                            <a class="link green_bc" href="{{ route('orders.asset', ['id' => $order->id]) }}">
                                <span>
                                    <i class="fa fa-print"></i>
                                    طباعة
                                    <div class="en_font"> Asset</div>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="widget ">
                        <div class="widget_title">السعر الأجمالى</div>
                        <div class="widget_content bill_total">
                            <li>
                                خدمات إضافية
                                <span>
                                    {{ $order->service }}
                                    جنيه </span>
                            </li>
                            <li>
                                خدمة التوصيل
                                <span>
                                    {{ $order->delivery }}
                                    جنيه </span>
                            </li>
                            <li>
                                قيمة الطلب
                                <span> {{ $order->total_before_item_discount() }} جنيه </span>
                            </li>
                            <li>
                                خصم
                                <span>
                                    {{ $order->total_discount() }}
                                    جنيه </span>
                            </li>

                            <li>إجمالى الفاتورة
                                <span> {{ $order->total_price_after_discount() }} جنيه</span>
                            </li>
                        </div>
                        <div class="col-12">
                            <a class="link green_bc" href="{{ route('orders.print', ['id' => $order->id]) }}">
                                <span>
                                    <i class="fa fa-print"></i>
                                    طباعة الفاتورة
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
