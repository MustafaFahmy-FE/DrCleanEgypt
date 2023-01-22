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
    <div class="login text-center">
        <form method="POST" action="{{ route('login') }}" class="login-form">

            <div class="steps_title">
                <span class="fa fa-lock"> </span> تسجيل دخول
            </div>
            <div class="form-group">
                <label> البريد الإلكتروني </label>
                <i class="fa fa-user-alt"></i>
                <input id="email" type="email" class="form-control" name="email">
            </div>
            <div class="form-group password_input">
                <label for="password"> كلمة المرور </label>
                <i class="fa fa-lock"></i>
                <input type="password" name="password" class="form-control" id="password" />
                <button class="fa fa-eye" id="show_pass" onclick="toggle()" type="button"></button>
            </div>
            <button class="link" type="submit">
                <span>
                    تسجيل دخول
                    <i class="fa fa-angle-left"></i>
                </span>
            </button>
            @csrf
        </form>
    </div>

    <!-- JS & Vendor Files
    ==========================================-->
    <script src="{{ asset('public/vendor/jquery/jquery.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="{{ asset('public/vendor/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/vendor/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('public/js/main.js') }}"></script>
    <script src="{{ asset('public/js/admin.js') }}"></script>
    {{-- @if ($errors->any())
        <script>
            notification("danger", "{{ $errors->first() }}", "fas fa-times");
        </script>
    @endif --}}
    <script>
        //submit form using ajax
        $(document).on('submit', '.login-form', function() {
            var form = $(this);
            var url = form.attr('action');
            var formData = new FormData(form[0]);
            form.find(":submit").attr('disabled', true).html(
                '<span> برجاء الإنتظار<i class="fa fa-angle-left"></i></span>');

            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'json',
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    notification("success", "تم تسجيل الدخول بنجاح", "fas fa-check");
                    setTimeout(function() {
                        window.location.reload();
                    }, 2000);
                },
                error: function(jqXHR) {
                    var response = $.parseJSON(jqXHR.responseText);
                    var errors = [];
                    $.each(response.errors, function(index, value) {
                        errors.push(value);
                    });
                    notification("danger", errors[0], "fas fa-times");
                    form.find(":submit").attr('disabled', false).html(
                        '<span> تسجيل دخول<i class="fa fa-angle-left"></i></span>');
                }
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('input[name="_token"]').val()
                }
            });
            return false;
        });
    </script>
</body>

</html>
