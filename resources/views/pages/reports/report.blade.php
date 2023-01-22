@extends('layouts.master')
@section('content')
    <div class="dashboard_content">
        <div class="container-fluid">
            <div class="widget">
                <div class="widget_title">تقارير الكي والغسيل</div>
                <div class="widget_content">
                    <form method="get" action="{{ url()->current() }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> من </label>

                                    <div class="inline_data">
                                        <i class="fa fa-calendar-alt"></i>

                                        <input type="text" class="form-control flatpickr-input" name="from" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
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
                <div class="widget_title"> تقرير الكي والغسيل </div>
                <div class="widget_content">
                    <div class="col-lg-12 col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered datatable_full1" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>القسم</th>
                                        <th>عدد الكي</th>
                                        <th>عدد الغسيل</th>
                                        <th>مجموع القسم(جنيه) </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $index => $category)
                                        <tr>
                                            <td>{{ $index+1 }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->ironing }}</td>
                                            <td>{{ $category->laundry }}</td>
                                            <td>{{ $category->sum }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td>6</td>
                                        <td><b>المبلغ الناتج(جنيه)</b></td>
                                        <td><b>{{ $ironing_sum }}</b></td>
                                        <td><b>{{ $laundry_sum }}</b></td>
                                        <td><b>{{ $laundry_sum + $ironing_sum }}</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--</div>-->
        </div>
    </div>
@endsection
