@extends('layouts.master')
@section('content')
    <div class="dashboard_content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="widget">
                        <div class="widget_title">
                            قائمة الطلبات

                        </div>
                        <div class="widget_content">
                            <div class="table-responsive">
                                <table class="table table-bordered orders_table" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>رقم الطلب</th>
                                            <th>إسم العميل</th>
                                            <th>تاريخ الأستلام</th>
                                            <th> تاريخ التسليم</th>
                                            <th>الأجمالى</th>
                                            <th>الحالة</th>
                                            <th>حاله السداد</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.orders_table').DataTable({
                processing: true,
                pageLength: 25,
                serverSide: true,
                ajax: "{{ route('orders.archive') }}",
                language: {
                    "decimal": "",
                    "emptyTable": "لا يوجد بيانات حتي الان.",
                    "info": "عرض _START_ الي _END_ من _TOTAL_ صفوف",
                    "infoEmpty": "عرض 0 الي 0 من 0 صفوف",
                    "infoFiltered": "(تصفية من _MAX_ الكل صفوف)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "عرض _MENU_ صفوف",
                    "loadingRecords": "تحميل...",
                    "processing": "معالجة...",
                    "search": "البحث:",
                    "zeroRecords": "لا يوجد بيانات تطابق البحث.",
                    "paginate": {
                        "first": "الاول",
                        "last": "الاخير",
                        "next": "التالي",
                        "previous": "السابق"
                    },
                    "aria": {
                        "sortAscending": ": اضغط للترتيب تصاعديا",
                        "sortDescending": ": اضغط للترتيب تنازليا"
                    }
                },
                dom: 'Bfrtip',
                buttons: ["excel"],
                columns: [{
                        data: 'id_url',
                        name: 'id_url'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'accept_date',
                        name: 'accept_date'
                    },
                    {
                        data: 'delivery',
                        name: 'delivery'
                    },
                    {
                        data: 'total',
                        name: 'total'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'payment',
                        name: 'payment'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                order: [
                    [0, 'desc']
                ]
            });

        });
    </script>
@endpush
