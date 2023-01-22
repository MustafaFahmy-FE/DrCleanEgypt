@extends('layouts.master')
@push('models')
    <div class="modal fade" id="add_employee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <button class="icon_link" data-dismiss="modal">
                        <i class="fa fa-times"></i>
                    </button>
                    <div class="modal_title">
                        <i class="fa fa-info"></i> إضافة موظف جديد
                    </div>
                    <form method="post" class="ajax-form" action="{{ route('employees.store') }}">
                        @csrf
                        @method('post')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label> إسم الموظف </label>
                                    <input type="text" class="form-control" name="name" />
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
                            الموظفين

                            <button class="link green_bc widget_link" data-toggle="modal" data-target="#add_employee">
                                + إضافة موظف
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
                                                    <th>أنشئ في</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($employees as $index => $employee)
                                                    <tr>
                                                        <td> {{ ++$index }}</td>
                                                        <td>{{ $employee->name }}</td>
                                                        <td>{{ $employee->created_at->format('d-m-Y H:i') }}</td>
                                                        <td>
                                                            <a class="fas fa-clipboard icon_link yellow_bc" title="الأذونات"
                                                                href="{{ route('attendance.show', ['id' => $employee->id]) }}">
                                                            </a>
                                                            <a class="fa fa-eye icon_link blue_bc" title="عرض البيانات"
                                                                href="{{ route('employees.show', ['id' => $employee->id]) }}">
                                                            </a>
                                                            <button class="fa fa-edit icon_link green_bc btn-modal-view"
                                                                title="تعديل"
                                                                data-url="{{ route('employees.edit', ['id' => $employee->id]) }}">
                                                            </button>
                                                            <button class="fa fa-times icon_link red_bc delete-btn"
                                                                title="حذف"
                                                                data-url="{{ route('employees.delete', ['id' => $employee->id]) }}"></button>
                                                        </td>
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
