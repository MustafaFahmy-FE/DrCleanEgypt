@extends('layouts.master')
@push('models')
    <div class="modal fade" id="add_category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <button class="icon_link" data-dismiss="modal">
                        <i class="fa fa-times"></i>
                    </button>
                    <div class="modal_title">
                        <i class="fa fa-info"></i> إضافة قسم جديد
                    </div>
                    <form method="post" class="ajax-form" action="{{ route('categories.store') }}">
                        @csrf
                        @method('post')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label> إسم القسم </label>
                                    <input type="text" class="form-control" name="name" />
                                </div>
                            </div>
                            {{-- <div class="col-md-12">
                                <div class="form-group">
                                    <label> القسم الرئيسي </label>
                                    <select class="form-control" name="parent_id">
                                        @foreach ($categories as $index => $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
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
                            قائمة الاقسام
                            @if (auth()->user()->role == 'admin')
                                <button class="link green_bc widget_link" data-toggle="modal" data-target="#add_category">
                                    + إضافة قسم
                                </button>
                            @endif
                        </div>
                        <div class="widget_content">
                            <div class="table-responsive">
                                <table class="table table-bordered" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>رقم القسم</th>
                                            <th>إسم القسم</th>
                                            <th>عدد الأصناف</th>
                                            @if (auth()->user()->role == 'admin')
                                                <th></th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $index => $category)
                                            @if ($category->subs->count() == 0)
                                                <tr>
                                                    <td> {{ ++$index }}</td>
                                                    <td>{{ $category->name }}</td>
                                                    <td>{{ $category->counter }}</td>
                                                    @if (auth()->user()->role == 'admin')
                                                        <td>
                                                            <button class="fa fa-edit icon_link green_bc btn-modal-view"
                                                                data-url="{{ route('categories.edit', ['id' => $category->id]) }}">
                                                            </button>
                                                            <button class="fa fa-times icon_link red_bc delete-btn"
                                                                data-url="{{ route('categories.delete', ['id' => $category->id]) }}"></button>
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endif
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
