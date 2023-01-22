@extends('layouts.master')
@push('models')
    <div class="modal fade" id="add_item" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <button class="icon_link" data-dismiss="modal">
                        <i class="fa fa-times"></i>
                    </button>
                    <div class="modal_title">
                        <i class="far fa-bookmark"></i> إضافة صنف جديد
                    </div>
                    <form method="post" action="{{ route('items.store') }}" class="ajax-form">
                        @csrf
                        @method('post')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> القسم </label>
                                    <select class="form-control" name="category_id">
                                        <option value="0">إختر القسم</option>
                                        @foreach ($categories as $category)
                                            @if ($category->subs->count() == 0)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> إسم الصنف </label>
                                    <input type="text" class="form-control" name="name" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> سعر الغسيل </label>
                                    <input type="text" class="form-control" name="laundry_price" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> سعر الكي </label>
                                    <input type="text" class="form-control" name="ironing_price" />
                                </div>
                            </div>
                        </div>
                        <button class="link"><span> حفظ المعلومات </span></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="add_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <button class="icon_link" data-dismiss="modal">
                        <i class="fa fa-times"></i>
                    </button>
                    <div class="modal_title">
                        <i class="far fa-user"></i> إضافة مستخدم جديد
                    </div>
                    <form method="post" class="ajax-form" action="{{ route('users.store') }}">
                        @csrf
                        @method('post')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> إسم المستخدم </label>
                                    <input type="text" class="form-control" name="name" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> البريد الألكترونى </label>
                                    <input type="email" class="form-control en" name="email" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> كلمة المرور </label>
                                    <input type="password" class="form-control" name="password" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> الوظيفة </label>
                                    <select class="form-control" name="role">
                                        <option value="admin">مدير</option>
                                        <option value="supervisor">مشرف</option>
                                        <option value="data-entry">مدخل بيانات</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button class="link" type="submit"><span> حفظ المعلومات </span></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="add_client" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <button class="icon_link" data-dismiss="modal">
                        <i class="fa fa-times"></i>
                    </button>
                    <div class="modal_title">
                        <i class="far fa-client"></i> إضافة عميل جديد
                    </div>
                    <form method="post" action="{{ route('clients.store') }}" class="ajax-form">
                        @csrf
                        @method('post')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label> إسم العميل </label>
                                    <input type="text" class="form-control" name="name" />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label> العنوان </label>
                                    <input type="text" class="form-control" name="address" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> رقم التليفون </label>
                                    <input type="text" class="form-control" name="phone" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> رقم المبنى </label>
                                    <input type="text" class="form-control" name="building" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> الدور </label>
                                    <input type="text" class="form-control" name="floor" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> رقم الشقة </label>
                                    <input type="text" class="form-control" name="apartment" />
                                </div>
                            </div>
                        </div>
                        <button class="link" type="submit"><span> حفظ المعلومات </span></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endpush
@section('content')
    <div class="dashboard_content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <a href="{{ route('clients.index') }}" class="counter shadow">
                        <h3>
                            عدد العملاء
                            <span class="timer_count" data-to="{{ $client_counter }}" data-speed="2000">0</span>
                        </h3>
                        <i class="fa fa-users"></i>
                    </a>
                </div>
                <div class="col-md-6 col-sm-6">
                    <a href="{{ route('items.index') }}" class="counter shadow">
                        <h3>
                            عدد الأصناف
                            <span class="timer_count" data-to="{{ $item_counter }}" data-speed="2000">0</span>
                        </h3>
                        <i class="far fa-bookmark"></i>
                    </a>
                </div>
                <div class="col-md-6 col-sm-12">
                    <a href="{{ route('orders.index') }}" class="counter shadow">
                        <h3>
                            عدد الطلبات غير المنتهيه
                            <span class="timer_count" data-to="{{ $order_undone_counter }}" data-speed="2000">0</span>
                        </h3>
                        <i class="fa fa-list"></i>
                    </a>
                </div>
                <div class="col-md-6 col-sm-12">
                    <a href="{{ route('orders.archive') }}" class="counter shadow">
                        <h3>
                            عدد الطلبات المنتهيه
                            <span class="timer_count" data-to="{{ $order_done_counter }}" data-speed="2000">0</span>
                        </h3>
                        <i class="fa fa-list"></i>
                    </a>
                </div>
            </div>
            <!--End Row-->
            <div class="row">
                <div class="col-lg-7">
                    <div class="widget">
                        <div class="widget_title"> لينكات سريعة </div>
                        <div class="widget_content quick_links">
                            <a href="{{ route('orders.create') }}" class="link">
                                <i class="fa fa-list"></i>
                                طلب جديد
                            </a>
                            <button class="link" data-toggle="modal" data-target="#add_item">
                                <i class="far fa-bookmark"></i>
                                إضافة صنف
                            </button>
                            <button class="link" data-toggle="modal" data-target="#add_client">
                                <i class="far fa-user"></i>
                                إضافة عميل
                            </button>
                            @if (auth()->user()->role == 'admin')
                                <button class="link" data-toggle="modal" data-target="#add_user">
                                    <i class="fa fa-cog"></i>
                                    إضافة مستخدم
                                </button>
                            @endif

                        </div>
                    </div>
                </div>
                @if (auth()->user()->role == 'admin')
                    <div class="col-lg-5">
                        <div class="widget">
                            <div class="widget_title">تقارير المبيعات</div>
                            <div class="widget_content ptb-0">
                                <form class="report_form p-0" method="get" action="{{ route('search') }}">
                                    @csrf
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label> من </label>

                                                    <div class="inline_data">
                                                        <i class="fa fa-calendar-alt"></i>

                                                        <input type="text" class="form-control flatpickr-input"
                                                            name="from" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
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
                    </div>
                @endif
            </div>
            <!--End Row-->
        </div>
    </div>
@endsection
