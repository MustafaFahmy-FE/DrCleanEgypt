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
@endpush
@section('content')
    <div class="dashboard_content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="widget">
                        <div class="widget_title">
                            <i class="far fa-user"></i> بيانات العميل
                        </div>
                        <div class="widget_content">
                            <div class="col-12 p-0">
                                <form class="small_search" method="post" action="{{ route('ajax.client') }}">
                                    @csrf
                                    @method('post')
                                    <div class="form-group">
                                        <label> إسم العميل</label>
                                        <select class="select" name="client_id" id="client-input">
                                            <option value="0" selected>إختر العميل</option>
                                            @foreach ($clients as $client)
                                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button class="link green_bc" type="button" data-toggle="modal"
                                        data-target="#add_client">
                                        + عميل جديد
                                    </button>
                                </form>
                            </div>
                            <div class="row mt-25" id="client-area">

                            </div>
                        </div>
                    </div>
                    <div class="widget">
                        <div class="widget_title">
                            <i class="fa fa-info"></i> تفاصيل الطلب
                        </div>
                        <div class="widget_content">
                            <form class="row" method="post" action="{{ route('ajax.submit_item') }}" id="order-form">
                                @csrf
                                @method('POST')
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label> إختر القسم </label>
                                        <select class="form-control" name="category_id" id="category-input">
                                            <option value="0"></option>
                                            @foreach ($categories as $category)
                                                @if ($category->subs->count() == 0)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!--End Col-->
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label> إختر الصنف </label>
                                        <select class="select" name="item_id" id="items-input">

                                        </select>
                                    </div>
                                </div>
                                <!--End Col-->
                                <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                                    <div class="form-group">
                                        <label> الحالة</label>
                                        <select class="form-control" name="status" id="status-input">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                                    <div class="form-group">
                                        <label> الكمية</label>
                                        <input type="number" class="form-control" name="qty" />
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                                    <div class="form-group">
                                        <label> الخصم</label>
                                        <input type="number" class="form-control" value="0" name="disc" />
                                    </div>
                                </div>
                                <!--End Col-->
                                <div class="col-12 mt-15">
                                    <button class="link" type="submit">
                                        <span> + إضافة الصنف </span>
                                    </button>
                                </div>
                            </form>
                            <!--End Row-->
                            <div class="row mt-15" id="order-area">
                            </div>
                            <form method="post" class="row mt-15 order-form" action="{{ route('orders.store') }}">
                                @csrf
                                @method('post')
                                <input type="hidden" name="client" class="client-input">
                                <input type="hidden" name="item_ids" class="item-input">
                                <input type="hidden" name="statuses" class="status-input">
                                <input type="hidden" name="prices" class="price-input">
                                <input type="hidden" name="quantities" class="quantity-input">
                                <input type="hidden" name="discounts" class="discount-input">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> إضافة خصم </label>
                                        <input type="number" class="form-control" value="0" name="discount" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> عدد ايام العمل </label>
                                        <input type="number" class="form-control" name="working_day" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>خدمات إضافية</label>
                                        <input type="number" class="form-control" value="0" name="service"
                                            min="0" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> خدمة التوصيل </label>
                                        <input type="number" class="form-control" name="delivery" value="0"
                                            min="0" />
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label> إضافة ملاحظات </label>
                                        <textarea class="form-control" name="notes"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 text-center mt-25">
                                    <button class="link green_bc" type="submit">
                                        <span> + إضافة الطلب </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        var item_ids = [],
            statuses = [],
            prices = [],
            quantities = [],
            discounts = [];
        $(document).on('change', '#client-input', function() {
            $('.small_search').submit();
        });
        $(document).on('submit', '.small_search', function() {
            var form = $(this);
            var url = form.attr('action');
            var formData = new FormData(form[0]);

            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'json',
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    $('#client-area').html(response);
                    $('.client-input').val($('#client-input').val());
                },
                error: function(jqXHR) {
                    var response = $.parseJSON(jqXHR.responseText);
                    notification("danger", response, "fas fa-times");
                }
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('input[name="_token"]').val()
                }
            });
            return false;
        });

        $(document).on('change', '#category-input', function() {
            var url = "{{ route('ajax.items') }}";
            var category_id = $(this).val();

            $.ajax({
                url: url,
                method: 'GET',
                dataType: 'json',
                data: {
                    category_id: category_id
                },
                success: function(response) {
                    $('#items-input').html(response);
                },
                error: function(jqXHR) {
                    var response = $.parseJSON(jqXHR.responseText);
                    notification("danger", response, "fas fa-times");
                }
            });
        })

        $(document).on('change', '#items-input', function() {
            var url = "{{ route('ajax.prices') }}";
            var item_id = $(this).val();

            $.ajax({
                url: url,
                method: 'GET',
                dataType: 'json',
                data: {
                    item_id: item_id
                },
                success: function(response) {
                    $('#status-input').html(response);
                },
                error: function(jqXHR) {
                    var response = $.parseJSON(jqXHR.responseText);
                    notification("danger", response, "fas fa-times");
                }
            });
        })

        $(document).on('submit', '#order-form', function() {
            var form = $(this);
            var url = form.attr('action');
            var formData = new FormData(form[0]);

            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'json',
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    form[0].reset();
                    $('#items-input').html("<option value='0'></option>");
                    $('#status-input').html("<option value='0'></option>");
                    $('#order-area').prepend(response.view);
                    item_ids.push(response.item);
                    statuses.push(response.status);
                    prices.push(response.price);
                    quantities.push(response.quantity);
                    discounts.push(response.discount);

                    $('.item-input').val(item_ids);
                    $('.status-input').val(statuses);
                    $('.price-input').val(prices);
                    $('.quantity-input').val(quantities);
                    $('.discount-input').val(discounts);
                },
                error: function(jqXHR) {
                    var response = $.parseJSON(jqXHR.responseText);
                    notification("danger", response, "fas fa-times");
                }
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('input[name="_token"]').val()
                }
            });
            return false;
        });

        $(document).on('submit', '.order-form', function() {
            var form = $(this);
            var url = form.attr('action');
            var formData = new FormData(form[0]);

            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'json',
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    notification("success", response, "fas fa-check");
                    setTimeout(function() {
                        window.location.href = "{{ route('orders.index') }}";
                    }, 2000);
                },
                error: function(jqXHR) {
                    var response = $.parseJSON(jqXHR.responseText);
                    notification("danger", response, "fas fa-times");
                }
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('input[name="_token"]').val()
                }
            });
            return false;
        });

        $(document).on('click', '.delete-button', function() {
            var id = $(this).data('id');

            var index = item_ids.indexOf(`${id}`);

            $(this).parent('.data_item').parent('#order-item').remove();

            statuses.splice(index, 1);
            prices.splice(index, 1);
            quantities.splice(index, 1);
            discounts.splice(index, 1);
            item_ids.splice(index, 1);

            $('.item-input').val(item_ids);
            $('.status-input').val(statuses);
            $('.price-input').val(prices);
            $('.quantity-input').val(quantities);
            $('.discount-input').val(discounts);
        });
    </script>
@endpush
