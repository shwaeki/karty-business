<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <title>Control Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Mohamad Shwaeki, shwaeki@gmail.com">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="content-type" content="text/html; charset=UTF8">


    <link rel="icon" type="image/x-icon" href="{{asset('images/logo.png')}}">
    <link rel="stylesheet" href="{{asset('css/site/bootstrap-rtl.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/designer/jquery-ui.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/designer/style.css') }}"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}"/>
    <style>

        #design-area {
            left: 50%;
            right: 0;
        }

        @foreach($fonts as $font)
            @font-face {
            font-family: {{'new_font_'.$font->id}};
            src: url({{asset('/fonts/'.$font->path)}});
        }

        @endforeach
    </style>

</head>


<body>


<div class="account-pages mt-5 mb-5">

    <div class="container-fluid">
        <div class="text-center mb-5">
            <a href="#" class="logo">
                <img src="{{asset('images/logo.png')}}" alt="" height="100" class="d-print-none mx-auto">
            </a>
        </div>


        <div class="row ">
            <div class="col-12 col-md-4  align-self-md-center  text-start" id="InfoArea">
                <div class="form-group row ">
                    <label for="input1" class="col-5 col-form-label order-1">اسم الزبون</label>
                    <div class="col-5">
                        {{$order->User->name}}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="input1" class="col-5 col-form-label order-1">رقم الهاتف </label>
                    <div class="col-5">
                        {{$order->User->phone}}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="input1" class="col-5 col-form-label order-1">عنوان الزبون</label>
                    <div class="col-5 ">
                        {{$order->User->City->name ?? ''}} - {{$order->User->address}}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="input1" class="col-5 col-form-label order-1">اسم الكرت </label>
                    <div class="col-5 ">
                        #{{$order->Card->name}}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="input1" class="col-5 col-form-label order-1">تصنيف الكرت </label>
                    <div class="col-5 ">
                        {{$order->Card->Category->name}}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="input1" class="col-5 col-form-label order-1">عددالكروت</label>
                    <div class="col-5 ">
                        {{$order->quantity}}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="input1" class="col-5 col-form-label order-1">التكلفة
                        الاجمالية</label>
                    <div class="col-5 ">
                        ₪ {{$order->cost}}
                    </div>
                </div>                <div class="form-group row">
                    <label for="input1" class="col-5 col-form-label order-1">طريقة الدفع</label>
                    <div class="col-5 ">
                        {{$order->payment->payment_method}} - {{$order->payment->payment_status}}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="input13" class="col-5 col-form-label order-1">ملاحظات اضافية</label>
                    <div class="col-5 ">
                        {{$order->notes}}
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-8" id="CardArea">
                    <div id="design-area" id="CardMainDesign">
                        <img src="{{ asset('images/cards/'.$order->Card->path)  }}" id="design-background"
                             alt="background">
                        <div id="design-content" style="direction: rtl;">
                            {!! $order->html !!}
                        </div>
                    </div>
            </div>
        </div>
        <div class="text-center mt-5">
            <button class="btn btn-warning d-print-none" onclick="printInfo()">طباعة المعلومات</button>
            <button class="btn btn-success d-print-none" onclick="savecard()">حفظ الكرت</button>

        </div>


        <div class="modal fade" id="SaveModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">تحميل الكرت</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center" id="SaveImage">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        <a href="#" id="downloadImage" class="btn btn-success">تحميل</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script src=" {{ asset('js/designer/jquery.js') }}"></script>
<script src=" {{ asset('js/site/bootstrap.bundle.js')}}"></script>
<script src=" {{ asset('js/designer/jquery-ui.min.js') }}"></script>
<script src=" {{ asset('js/designer/sweetalert2@11.js') }}"></script>

<script>


    $(document).ready(function () {
        $('#CardMainDesign').css('background', '#ffffff').addClass('border border-danger');
    });


    function printInfo() {
        $('#InfoArea').removeClass('d-print-none');
        $('#CardArea').addClass('d-print-none');
        window.print();
    }

    function savecard() {
        $('#CardArea').removeClass('d-print-none');
        $('#InfoArea').addClass('d-print-none');
        window.print();


    }

</script>
</body>
</html>
