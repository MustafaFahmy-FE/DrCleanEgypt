<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <!-- Meta Tags
        ==============================-->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="keywords" content="" />
    <meta name="copyright" content="" />
    <title>DR Clean</title>

    <!-- Fave Icons
    ================================-->
    <link rel="shortcut icon" href="{{ asset('public/images/favicon.png') }}" />

    <!-- CSS Files
    ================================-->
    <link rel="stylesheet" href="{{ asset('public/vendor/bootstrap/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('public/vendor/select2/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/vendor/flatpicker/flatpickr.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/vendor/datatable/datatables.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/css/style.css') }}" />

</head>

<body>
    <!-- Preloader
    =============================-->
    <div class="preloader">
        <div class="load_cont">
            <img src="{{ asset('public/images/loader.gif') }}" />
        </div>
    </div>
    <!-- Modal
    ===============================-->
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <form class="remove_modal" id="delete-form" method="post">
                        @csrf
                        @method('delete')
                        <i class="fa fa-times icon_link"></i>
                        <h3>هل تريد حذف العنصر</h3>

                        <div class="w-100">
                            <button type="submit" class="link red_bc">
                                <span> نعم , تأكيد الحذف </span>
                            </button>
                            <button class="link green_bc" data-dismiss="modal" type="button">
                                <span> إغلاق </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @stack('models')
    @include('layouts.models')
    @include('layouts.sidebar')
    @include('layouts.header')
    @yield('content')
    <!-- JS & Vendor Files
    ==========================================-->
    <script src="{{ asset('public/vendor/jquery/jquery.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="{{ asset('public/vendor/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/vendor/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('public/vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('public/vendor/flatpicker/flatpickr.js') }}"></script>
    <script src="{{ asset('public/vendor/counterto.js') }}"></script>
    <script src="{{ asset('public/vendor/datatable/datatables.min.js') }}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.flash.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.print.min.js"></script>
    <script src="{{ asset('public/js/main.js') }}"></script>
    <script src="{{ asset('public/js/admin.js') }}"></script>
    @stack('js')
    @if (auth()->user()->role != 'admin')
        <style>
            .dt-buttons {
                display: none !important;
            }
        </style>
    @endif
</body>

</html>
