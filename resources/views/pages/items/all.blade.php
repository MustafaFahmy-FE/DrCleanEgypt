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
                            قائمة الأصناف
                            @if (auth()->user()->role == 'admin')
                                <button class="link green_bc widget_link" data-toggle="modal" data-target="#add_item">
                                    + إضافة صنف
                                </button>
                                <a href="{{ route('items.export') }}" class="link blue_bc widget_link" style="margin-left: 120px;">
                                    إستيراد الأصناف
                                </a>
                            @endif
                        </div>
                        <div class="widget_content">
                            <div class="row">
                                <div class="col-12">
                                    <ul class="nav nav-tabs">
                                        @foreach ($categories as $index => $category)
                                            @if ($category->items()->count() > 0)
                                                <li>
                                                    <a data-toggle="tab" href="#t{{ $index }}"
                                                        class="{{ $index == 0 ? 'active' : '' }}">
                                                        {{ $category->name }}
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                    <div class="tab-content">
                                        @foreach ($categories as $index => $category)
                                            @if ($category->items()->count() > 0)
                                                <div id="t{{ $index }}"
                                                    class="tab-pane fade {{ $index == 0 ? 'active show' : '' }} in">
                                                    <div class="row">
                                                        @foreach ($category->items as $item)
                                                            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                                                                <div class="item">
                                                                    <h3>{{ $item->name }}</h3>
                                                                    <p>سعر الغسيل : {{ $item->laundry_price }} جنيه</p>
                                                                    <p>سعر الكي : {{ $item->ironing_price }} جنيه</p>
                                                                    @if (auth()->user()->role == 'admin')
                                                                        <div class="btns">
                                                                            <button
                                                                                data-url="{{ route('items.delete', ['id' => $item->id]) }}"
                                                                                class="delete-btn icon_link red_bc fa fa-times"></button>
                                                                            <button
                                                                                class="icon_link green_bc far fa-edit btn-modal-view"
                                                                                data-url="{{ route('items.edit', ['id' => $item->id]) }}">
                                                                            </button>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!--End Row-->
                        </div>
                        <!--End Widget Content-->
                    </div>
                    <!--End Widget-->
                </div>
            </div>
        </div>
    </div>
@endsection
