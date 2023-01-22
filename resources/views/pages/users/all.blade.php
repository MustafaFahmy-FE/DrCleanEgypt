@extends('layouts.master')
@push('models')
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
                                        <option value="cachier">كاشير</option>
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
                            قائمة المستخدمين

                            <button class="link green_bc widget_link" data-toggle="modal" data-target="#add_user">
                                + إضافة مستخدم
                            </button>
                        </div>
                        <div class="widget_content">
                            <div class="table-responsive">
                                <table class="table table-bordered datatable_full" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>رقم الموظف</th>
                                            <th>إسم الموظف</th>
                                            <th>البريد الألكترونى</th>
                                            <th>الوظيفة</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $index => $user)
                                            <tr>
                                                <td>{{ ++$index }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td><span class="en">{{ $user->email }}</span></td>
                                                <td>
                                                    @switch($user->role)
                                                        @case('admin')
                                                            مدير
                                                        @break
                                                        @case('cachier')
                                                            كاشير
                                                        @break

                                                        @default

                                                    @endswitch
                                                </td>
                                                <td>
                                                    @if (auth()->user()->role == 'admin')
                                                        <button class="fa fa-edit icon_link green_bc btn-modal-view"
                                                            data-url="{{ route('users.edit', ['id' => $user->id]) }}">
                                                        </button>
                                                        <button class="fa fa-times icon_link red_bc delete-btn"
                                                            data-url="{{ route('users.delete', ['id' => $user->id]) }}"></button>
                                                    @endif
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
@endsection
