<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="utf-8"/>
    <title>Control Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Mohamad Shwaeki, shwaeki@gmail.com">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="content-type" content="text/html; charset=UTF8">


    <link rel="icon" type="image/x-icon" href="{{asset('images/site/logo.png')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/site/bootstrap-rtl.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/site/boostrap-style.css')}}">
    <script src=" {{ asset('js/designer/sweetalert2@11.js') }}"></script>
</head>


<body>


<div class="account-pages mt-5 mb-5">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="text-center mb-5">
                    <a href="#" class="logo">
                        <img src="{{asset('images/site/logo.png')}}" alt="" height="100" class="d-print-none mx-auto">
                    </a>
                </div>

                @yield('content')
            </div>
        </div>
    </div>
</div>

<script src="  {{ asset('js/admin/vendor.min.js') }}"></script>
<script src="  {{ asset('js/admin/app.min.js') }}"></script>

@yield('scripts')
</body>
</html>
