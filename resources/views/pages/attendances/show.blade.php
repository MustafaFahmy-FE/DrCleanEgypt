@extends('layouts.master')
@section('content')
    <div class="dashboard_content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="widget">
                        <div class="widget_title">
                            <i class="fa fa-info"></i> الأذونات
                        </div>
                        <div class="widget_content">
                            <div class="table-responsive">
                                <table class="table table-bordered datatable_full" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>النوع</th>
                                            <th>أنشئ في</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($employee->attendances as $index => $attendance)
                                            <tr>
                                                <td> {{ ++$index }}</td>
                                                <td>{{ $attendance->type == 0 ? 'إنصراف' : 'حضور' }}</td>
                                                <td>( {{ $attendance->time }} ) {{ $attendance->created_at->format('d-m-Y') }} </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!--End Row-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
