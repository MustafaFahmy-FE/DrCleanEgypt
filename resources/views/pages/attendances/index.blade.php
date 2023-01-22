@extends('layouts.master')
@push('models')
    <div class="modal fade" id="add_attendance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <button class="icon_link" data-dismiss="modal">
                        <i class="fa fa-times"></i>
                    </button>
                    <div class="modal_title">
                        <i class="fa fa-info"></i> إضافة إذن جديد
                    </div>
                    <form method="post" class="ajax-form" action="{{ route('attendance.store') }}">
                        @csrf
                        @method('post')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label> الموظف </label>
                                    <select class="form-control" name="employee_id">
                                        <option value="0">إختر الموظف</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label> نوع الإذن </label>
                                    <select class="form-control" name="type">
                                        <option value="-1">إختر النوع</option>
                                        <option value="1">حضور</option>
                                        <option value="0">إنصراف</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label> الموعد </label>
                                    <input class="form-control" name="time" type="time">
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
                        <div class="widget_title">
                            الأذونات

                            <button class="link green_bc widget_link" data-toggle="modal" data-target="#add_attendance">
                                + إضافة إذن
                            </button>
                        </div>
                        <div class="widget_content">
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered datatable_full" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>إسم الموظف</th>
                                                    <th>النوع</th>
                                                    <th>أنشئ في</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($attendances as $index => $attendance)
                                                    <tr>
                                                        <td> {{ ++$index }}</td>
                                                        <td>{{ $attendance->employee->name }}</td>
                                                        <td>{{ $attendance->type == 0 ? 'إنصراف' : 'حضور' }}</td>
                                                        <td>{{ $attendance->time }}</td>
                                                    </tr>
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
        </div>
    </div>
@endsection
