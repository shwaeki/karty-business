<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8"/>
    <title>صمم كرتك</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Mohamad Shwaeki, shwaeki@gmail.com">
    <link rel="icon" type="image/x-icon" href="{{asset('images/logo.png')}}">

    <link rel="stylesheet" href="{{asset('css/site/bootstrap-rtl.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/designer/jquery-ui.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/designer/style.css') }}"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}"/>

    <!-- cairo font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cairo&display=swap">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-YB9QTDKPNN"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'G-YB9QTDKPNN');
    </script>

    <style>
        @foreach($fonts as $font)
            @font-face {
            font-family: {{'new_font_'.$font->id}};
            src: url({{asset('/fonts/'.$font->path)}});
        }
        @endforeach
    </style>


</head>
<body>


<div class="container-fluid">
    <div class="row">
        <div id="side-bar-overlay" onclick="toggleSideBar()"></div>

        <div class="col-12 col-md-10 offset-md-2 p-0">
            <nav class="navbar navbar-expand-lg navbar-light bg-white col-12 col-md-10 justify-content-between">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <select name="font-type" onchange="changeFontType(this)" id="font-type" class="btn btn-default"
                                data-toggle="tooltip" title="نوع الخط" style="font-family:'cairo' !important;">
                            <option disabled selected value="none" style="font-family:'cairo';">نوع الخط</option>
                            <option value="arial, serif" style="font-family: arial, serif ">Arial</option>
                            @foreach($fonts as $font)
                                <option value="{{'new_font_'.$font->id}}"
                                        style="font-family: {{'new_font_'.$font->id}},serif ">
                                    {{$font->name}}
                                </option>
                            @endforeach

                        </select>
                    </li>

                    <li class="nav-item">
                        <select onchange="changeFontSize(this)" class="btn btn-default" id="font-size"
                                data-toggle="tooltip" title="حجم الخط " style="font-family: 'cairo' !important;">
                            <option disabled selected value="16" style="font-family: 'cairo' !important;">حجم الخط
                            </option>
                        </select>
                    </li>

                    {{--
                                        <li class="nav-item ">
                                            <button type="button" class="btn btn-default position-relative"
                                                    data-toggle="tooltip" title="Font Color">
                                                <i id="color-icon" class="fas fa-paint-brush"></i>
                                                <input type="color" id="color" onchange="changeTextColor(this)" value="#000000"
                                                       aria-label="">
                                            </button>
                                        </li>
                    --}}
                    <li class="nav-item">
                        <button type="button" class="btn btn-default" onclick="textLeft()"
                                data-toggle="tooltip" title="محاذاة لليسار" id="textLeft">
                            <i class="fas fa-align-left"></i>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="btn btn-default" onclick="textCenter()"
                                data-toggle="tooltip" title="محاذة للوسط" id="textCenter">
                            <i class="fas fa-align-justify"></i>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="btn btn-default" onclick="textRight()"
                                data-toggle="tooltip" title="محاذاة لليمين" id="textRight">
                            <i class="fas fa-align-right"></i>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="btn btn-default" onclick="bold()"
                                data-toggle="tooltip" title="خط عريض" id="bold">
                            <i class="fas fa-bold"></i>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="btn btn-default" onclick="italic()"
                                data-toggle="tooltip" title="خط مائل" id="italic">
                            <i class="fas fa-italic"></i>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="btn btn-default" onclick="upperCase()"
                                data-toggle="tooltip" title="الأحرف الكبيرة" id="upperCase">
                            <span class="fw-bold">Aa</span>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="btn btn-default" onclick="flip()"
                                data-toggle="tooltip" title="قلب الايفونة">
                            <i class="fas fa-retweet"></i>
                        </button>
                    </li>
                    <li class="nav-item ">
                        <button type="button" class="btn btn-default" onclick="editText()"
                                data-toggle="tooltip" title="تعديل النص">
                            <i class="fas fa-edit"></i>
                        </button>
                    </li>
                    <li class="nav-item">
                        <input type="number" class="form-control" min="0" max="180" oninput="changeRotation(this)"
                               value="0" data-toggle="tooltip" title="دوران" id="rotation"
                               style="min-width: 40px;    width: 70px;">
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <button type="button" class="btn btn-default" onclick="reset()"
                                data-toggle="tooltip" title="البدأ من جديد">
                            <i class="fas fa-redo"></i>
                        </button>
                    </li>

                    <li class="nav-item">
                        <button type="button" class="btn btn-default" onclick="help()"
                                data-toggle="tooltip" title="تعليمات الاستخدام">
                            <i class="fas fa-question"></i>
                        </button>
                    </li>

                    <li class="nav-item">
                        <button type="button" class="btn btn-default" onclick="newText()"
                                data-toggle="tooltip" title="نص جديد">
                            <i class="fas fa-plus"></i>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="btn btn-default" onclick="cloneElement()"
                                data-toggle="tooltip" title="تكرار العنصر">
                            <i class="far fa-clone"></i>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="btn btn-default" onclick="deleteElement()"
                                data-toggle="tooltip" title="حذف العنصر">
                            <i class="far fa-trash-alt"></i>
                        </button>


                    </li>
                </ul>
            </nav>
            <div id="design-responsive">
                <div id="design-area" style="transform: translate(50%, -50%) scale(1);">
                    <img src="{{ asset('images/cards/'.$card->path) }}" id="design-background"
                         alt="background">
                    <div id="design-content">
                        @if( isset($like)&& isset($like->html))
                            {!! $like->html !!}
                        @else
                            {!! $card->html !!}
                        @endif

                    </div>
                </div>
            </div>
            <div id="scale_controller" class="d-none d-md-block">
                <label for="sizeRange" id="sizeRangeLabel" class="me-3">100%</label>
                <input type="range" class="custom-range" min="0.5" max="1.5" step="0.1"
                       onchange="changeSize(this)" id="sizeRange">
            </div>
        </div>
        <div id="side-bar" class="col-12 col-md-2">

            <style>
                @media only screen and (max-width: 770px) {
                    .logo {
                        display: none !important;
                    }
                }
            </style>

            <div class="logo pt-3 pb-3 d-block text-center">
                <a href="{{route('home')}}"><img src="{{asset('images/logo.png')}}" width="100" alt="logo"></a>
            </div>

            <div class="accordion" id="accordionOptions">
                <div class="card ">
                    <div class="card-header" id="headingTwo">
                        <a class="text-decoration-none d-block" role="button" data-bs-toggle="collapse"
                           data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <i class="fas fa-grip-horizontal"></i> تعديل الرموز
                        </a>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                         data-parent="#accordionOptions">
                        <div class="card-body ">
                            <div class="row">


                                @foreach($icons as $icon)
                                    <div class="col-6 p-1">
                                        <div class="icon-container img-thumbnail mb-2">
                                            <img src="{{ asset('images/Icons/'.$icon->path) }}" alt="icon" class="icon"
                                                 onclick="changeIcon(this)">
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="accordion" id="accordionOptions">
                <div class="card ">
                    <div class="card-header" id="headingThree">
                        <a class="text-decoration-none d-block" role="button" data-bs-toggle="collapse"
                           data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            <i class="fas fa-grip-horizontal"></i> تعديل التصميم
                        </a>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                         data-parent="#accordionOptions">
                        <div class="card-body ">
                            <div class="row">

                                <div class="col-6">
                                    <div class="style-container img-thumbnail mb-2" onclick="changeStyle(0);">
                                        التصميم الاساسي
                                    </div>
                                </div>
                                @foreach($card->styles as $style)
                                    <div class="col-6">
                                        <div class="style-container img-thumbnail mb-2"
                                             onclick="changeStyle({{$style->id}});">
                                            #{{$loop->iteration}} التصميم الثانوي
                                        </div>
                                    </div>
                                @endforeach


                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="buttons-holder">
                <div class="bottom-0 w-100">
                    <form action="{{ route('design.save',['id'=>$card->id]) }}" method="POST"
                          onsubmit="OnSubmit();"
                          style="display: flex; justify-content: center;margin-top: 20px">
                        @csrf
                        @method('PUT')

                        <input type="hidden" value="" id="HtmlContent" name="HtmlContent" required>
                        <div class="d-flex justify-content-center w-100">
                            <input type="submit" class="btn karty rounded-0 w-100 py-3" name="buy" value="شراء الان">
                            <input type="submit" class="btn karty2 rounded-0 w-100 py-3" name="save" value="حفظ">
                        </div>
                    </form>
                </div>
            </div>

            <span id="side-bar-close-button" class="d-block d-md-none" onclick="toggleSideBar()"></span>
        </div>
    </div>


    <div id="style_0_content" class="d-none">
        {!! $card->html !!}
    </div>

    @foreach($card->styles as $style)
        <div id="style_{{$style->id}}_content" class="d-none">
            {!! $style->html !!}
        </div>
    @endforeach

    <div id="resetcontent" style="display:none;">

        @if( isset($like)&& isset($like->html))
            {!! $like->html !!}
        @else
            {!! $card->html !!}
        @endif

    </div>


    <button id="side-bar-open-button" type="button" onclick="toggleSideBar()" class="d-block d-md-none ">
        <i class="fas fa-bars"></i>
    </button>
</div>


<script src="{{ asset('js/designer/jquery.js') }}"></script>
<script src="{{ asset('js/site/bootstrap.bundle.js')}}"></script>
<script src="{{ asset('js/designer/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/designer/sweetalert2@11.js') }}"></script>
<script src="{{ asset('js/designer/jquery.ui.rotatable.min.js') }}"></script>
<script src="{{ asset('js/designer/jquery.ui.touch-punch.min.js') }}"></script>
<script src="{{ asset('js/designer/script.js') }}"></script>
<script src="{{ asset('js/designer/smart-guides.js') }}"></script>

<script>

    function OnSubmit() {
        removeSelectElement();
        var html = $('#design-content').html();
        $('#HtmlContent').val(html);
        localStorage.setItem("HtmlContent", html);
        localStorage.setItem("HtmlContent_ID", {{$card->id}});
        return true;
    }


    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip({placement: 'bottom'})

        if (localStorage.getItem("HtmlContent")
            && localStorage.getItem("HtmlContent_ID") == {{$card->id}}) {
            $('#design-content').html(localStorage.getItem("HtmlContent"));
            initializeElements();
            localStorage.removeItem("HtmlContent");
            localStorage.removeItem("HtmlContent_ID");
        }


        @guest
            Swal.fire({
                title: 'لم تقم بتسجيل الدخول',
                text: "لحفظ التصميم او لاتمام عملية الشراء يجب عليك ان تقوم بتسجيل الدخول أولاً",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'تسجيل الدخول',
                cancelButtonText: 'متابعة'
            }).then((result) => {
                if (result.isConfirmed) {

                    window.location = '{{route('login')}}';

                }
            })
        @endguest
    });

</script>
</body>
</html>
