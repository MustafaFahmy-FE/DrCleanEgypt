@extends('layouts.master')
@push('models')
    <div class="modal fade" id="add_expense" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <button class="icon_link" data-dismiss="modal">
                        <i class="fa fa-times"></i>
                    </button>
                    <div class="modal_title">
                        <i class="fa fa-info"></i> إضافة مصروف جديد
                    </div>
                    <form method="post" class="ajax-form" action="{{ route('expenses.store') }}">
                        @csrf
                        @method('post')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label> إسم المصروف </label>
                                    <input type="text" class="form-control" name="name" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label> نوع المصروف </label>
                                    <select class="form-control" name="type">
                                        <option value="0">إختر</option>
                                        <option value="مصروفات كهرباء">مصروفات كهرباء</option>
                                        <option value="مصروفات عمومية">مصروفات عمومية</option>
                                        <option value="صيانة أجهزه">صيانة أجهزه</option>
                                        <option value="أجور ومرتبات">أجور ومرتبات</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label> قيمه المصروف </label>
                                    <input type="number" class="form-control" name="price" />
                                </div>
                            </div>
                        </div>
                        <button class="link" type="submit"><span> حفظ المعلومات </span></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="common-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog " role="document" id="edit-area">

        </div>
    </div>
@endpush
@section('content')
    <div class="dashboard_content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="widget">
                        <div class="widget_title">تقارير المصاريف</div>
                        <div class="widget_content">
                            <form method="get" action="{{ url()->current() }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label> إسم المصروف </label>
                                            <input type="text" class="form-control" name="name" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label> من </label>

                                            <div class="inline_data">
                                                <i class="fa fa-calendar-alt"></i>

                                                <input type="text" class="form-control flatpickr-input" name="from" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
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
                            المصروفات

                            <button class="link green_bc widget_link" data-toggle="modal" data-target="#add_expense">
                                + إضافة مصروف
                            </button>
                        </div>
                        <div class="widget_content">
                            <div class="row">
                                <div class="col-lg-9 col-md-8">
                                    <div class="table-responsive">
                                        <table class="table table-bordered datatable_full" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>رقم المصروف</th>
                                                    <th>إسم المصروف</th>
                                                    <th>نوع المصروف</th>
                                                    <th>قيمه المصروف</th>
                                                    <th>أنشئت في</th>
                                                    @if (auth()->user()->role == 'admin')
                                                        <th></th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($expenses as $index => $expense)
                                                    <tr>
                                                        <td> {{ ++$index }}</td>
                                                        <td>{{ $expense->name }}</td>
                                                        <td>{{ $expense->type }}</td>
                                                        <td>{{ $expense->price }}</td>
                                                        <td>{{ $expense->created_at->format('d-m-Y H:i') }}</td>
                                                        @if (auth()->user()->role == 'admin')
                                                            <td>
                                                                <button class="fa fa-edit icon_link green_bc btn-modal-view"
                                                                    data-url="{{ route('expenses.edit', ['id' => $expense->id]) }}">
                                                                </button>
                                                                <button class="fa fa-times icon_link red_bc delete-btn"
                                                                    data-url="{{ route('expenses.delete', ['id' => $expense->id]) }}"></button>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4">
                                    @if ($sum != 0)
                                        <div class="daily_total" style="margin-bottom: 15px;">
                                            إجمالي نتيجة البحث
                                            <span>
                                                {{ $sum }} جنيه
                                            </span>
                                        </div>
                                    @endif

                                    <div class="daily_total" style="margin-bottom: 15px;">
                                        إجمالي مصروفات الكهرباء
                                        <span>
                                            {{ $expenses->where('type', 'مصروفات كهرباء')->sum('price') }} جنيه
                                        </span>
                                    </div>
                                    <div class="daily_total" style="margin-bottom: 15px;">
                                        إجمالي المصروفات العمومية
                                        <span>
                                            {{ $expenses->where('type', 'مصروفات عمومية')->sum('price') }} جنيه
                                        </span>
                                    </div>
                                    <div class="daily_total" style="margin-bottom: 15px;">
                                        إجمالي صيانة الأجهزه
                                        <span>
                                            {{ $expenses->where('type', 'صيانة أجهزه')->sum('price') }} جنيه
                                        </span>
                                    </div>
                                    <div class="daily_total" style="margin-bottom: 15px;">
                                        إجمالي الأجور والمرتبات
                                        <span>
                                            {{ $expenses->where('type', 'أجور ومرتبات')->sum('price') }} جنيه
                                        </span>
                                    </div>
                                    <div class="daily_total" style="margin-bottom: 15px;">
                                        إجمالي المصروفات
                                        <span>
                                            {{ $expenses->sum('price') }} جنيه
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
