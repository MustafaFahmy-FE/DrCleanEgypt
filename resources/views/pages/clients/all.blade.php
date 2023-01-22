@extends('layouts.master')
@push('models')
    <div class="modal fade" id="add_client" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            قائمة العملاء

                            <button class="link green_bc widget_link" data-toggle="modal" data-target="#add_client">
                                + إضافة عميل
                            </button>
                        </div>
                        <div class="widget_content">
                            <div class="table-responsive">
                                <table class="table table-bordered datatable_full" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>رقم العميل</th>
                                            <th>إسم العميل</th>
                                            <th>رقم الهاتف</th>
                                            <th>العنوان</th>
                                            <th>رقم المبني</th>
                                            <th>الدور</th>
                                            <th>رقم الشقة</th>
                                            @if (auth()->user()->role == 'admin')
                                                <th></th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $x = 1;
                                        @endphp
                                        @foreach ($clients as $index => $client)
                                            <tr>
                                                <td> {{ $x }}</td>
                                                <td>{{ $client->name }}</td>
                                                <td>{{ $client->phone }}</td>
                                                <td>{{ $client->address }}</td>
                                                <td>{{ $client->building }}</td>
                                                <td>{{ $client->floor }}</td>
                                                <td>{{ $client->apartment }}</td>
                                                @if (auth()->user()->role == 'admin')
                                                    <td>
                                                        <a class="fa fa-eye icon_link blue_bc"
                                                            href="{{ route('clients.show', ['id' => $client->id]) }}">
                                                        </a>
                                                        <button class="fa fa-edit icon_link green_bc btn-modal-view"
                                                            data-url="{{ route('clients.edit', ['id' => $client->id]) }}">
                                                        </button>
                                                        <button class="fa fa-times icon_link red_bc delete-btn"
                                                            data-url="{{ route('clients.delete', ['id' => $client->id]) }}"></button>
                                                    </td>
                                                @endif
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
