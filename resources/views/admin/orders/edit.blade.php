<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8"/>
    <title> تعديل التصميم</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Mohamad Shwaeki, shwaeki@gmail.com">
    <link rel="icon" type="image/x-icon" href="{{asset('images/logo.png')}}">

    <link rel="stylesheet" href="{{asset('css/site/bootstrap-rtl.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/designer/jquery-ui.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/designer/style.css') }}"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}"/>
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
            <nav class="navbar navbar-expand-lg navbar-light bg-white w-100">
                <ul class="navbar-nav  me-md-auto">
                    <li class="nav-item">
                        <select name="font-type" onchange="changeFontType(this)" id="font-type" class="btn btn-default"
                                data-toggle="tooltip" title="Font Type">
                            <option disabled selected value="none">Font Type</option>
                            <option value="arial, serif" style="font-family: arial, serif ">Arial</option>
                            @foreach($fonts as $font)
                                <option value="{{'new_font_'.$font->id}}"
                                        style="font-family: {{'new_font_'.$font->id}},serif ">
                                    {{$font->name}}
                                </option>
                            @endforeach

                        </select>
                    </li>
                    <li class="nav-item ">
                        <select onchange="changeFontSize(this)" class="btn btn-default" id="font-size"
                                data-toggle="tooltip" title="Font Size">
                            <option disabled selected value="16">Size</option>
                        </select>
                    </li>


                    <li class="nav-item ">
                        <button type="button" class="btn btn-default position-relative"
                                data-toggle="tooltip" title="Font Color">
                            <i id="color-icon" class="fas fa-paint-brush"></i>
                            <input type="color" id="color" onchange="changeTextColor(this)" value="#000000"
                                   aria-label="">
                        </button>
                    </li>

                    <li class="nav-item">
                        <button type="button" class="btn btn-default" onclick="textLeft()"
                                data-toggle="tooltip" title="Left Align Text" id="textLeft">
                            <i class="fas fa-align-left"></i>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="btn btn-default" onclick="textCenter()"
                                data-toggle="tooltip" title="Center Align Text" id="textCenter">
                            <i class="fas fa-align-justify"></i>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="btn btn-default" onclick="textRight()"
                                data-toggle="tooltip" title="Right Align Text" id="textRight">
                            <i class="fas fa-align-right"></i>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="btn btn-default" onclick="bold()"
                                data-toggle="tooltip" title="Bold" id="bold">
                            <i class="fas fa-bold"></i>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="btn btn-default" onclick="italic()"
                                data-toggle="tooltip" title="Italic" id="italic">
                            <i class="fas fa-italic"></i>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="btn btn-default" onclick="upperCase()"
                                data-toggle="tooltip" title="UpperCase" id="upperCase">
                            <span class="fw-bold">Aa</span>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="btn btn-default" onclick="flip()"
                                data-toggle="tooltip" title="Flip">
                            <i class="fas fa-retweet"></i>
                        </button>
                    </li>
                    <li class="nav-item d-md-none">
                        <button type="button" class="btn btn-default" onclick="editText()"
                                data-toggle="tooltip" title="Edit Text">
                            <i class="fas fa-edit"></i>
                        </button>
                    </li>
                    <li class="nav-item">
                        <input type="number" class="form-control" min="0" max="180" oninput="changeRotation(this)"
                               value="0" data-toggle="tooltip" title="Rotation" id="rotation"
                               style="min-width: 40px;    width: 70px;">
                    </li>
                </ul>

                <ul class="navbar-nav ms-md-auto">
                    <li class="nav-item">
                        <form action="{{ route('orders.update',['order'=>$order->id]) }}" method="POST"
                              onsubmit="OnSubmit();" class="d-inline-block">
                            @csrf
                            @method('PUT')

                            <input type="hidden" value="" id="HtmlContent" name="HtmlContent" required>
                            <input type="submit" class="btn btn-default" name="save" value="حفظ">
                        </form>

                    </li>

                    <li class="nav-item">
                        <button type="button" class="btn btn-default" onclick="newText()"
                                data-toggle="tooltip" title="New Text">
                            <i class="fas fa-plus"></i>
                        </button>
                    </li>

                    <li class="nav-item">
                        <button type="button" class="btn btn-default" onclick="cloneElement()"
                                data-toggle="tooltip" title="Clone">
                            <i class="far fa-clone"></i>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="btn btn-default" onclick="deleteElement()"
                                data-toggle="tooltip" title="Delete">
                            <i class="far fa-trash-alt"></i>
                        </button>


                    </li>
                </ul>
            </nav>
            <div id="design-responsive">
                <div id="design-area">
                    <img src="{{ asset('images/cards/'.$order->Card->path)  }}" id="design-background"
                         alt="background">
                    <div id="design-content">
                        {!! $order->html !!}
                    </div>
                </div>
            </div>
            <div id="scale_controller">
                <label for="sizeRange" id="sizeRangeLabel" class="me-3">100%</label>
                <input type="range" class="custom-range" min="0.5" max="1.5" step="0.1" onchange="changeSize(this)"
                       id="sizeRange">
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


            <span id="side-bar-close-button" class="d-block d-md-none" onclick="toggleSideBar()"></span>
        </div>
    </div>


    <button id="side-bar-open-button" type="button" onclick="toggleSideBar()" class="d-block d-md-none ">
        <i class="fas fa-plus"></i>
    </button>
</div>


<script src=" {{ asset('js/designer/jquery.js') }}"></script>
<script src=" {{ asset('js/site/bootstrap.bundle.js')}}"></script>
<script src=" {{ asset('js/designer/jquery-ui.min.js') }}"></script>
<script src=" {{ asset('js/designer/sweetalert2@11.js') }}"></script>
<script src=" {{ asset('js/designer/jquery.ui.rotatable.min.js') }}"></script>
<script src=" {{ asset('js/designer/jquery.ui.touch-punch.min.js') }}"></script>
<script src=" {{ asset('js/designer/script.js') }}"></script>
<script src=" {{ asset('js/designer/smart-guides.js') }}"></script>

<script>
    function OnSubmit() {
        removeSelectElement();
        var html = $('#design-content').html();
        $('#HtmlContent').val(html);
        return true;
    }

</script>
</body>
</html>


{{--
@extends('layouts.admin',['design' => true,'title'=>'تعديل الكرت'])

@section('content')

    @foreach($fonts as $font)
        <style>
            @font-face {
                font-family: {{'new_font_'.$font->id}};
                src: url({{asset('images/Fonts/'.$font->path)}});
            }
        </style>
    @endforeach
    <div class="content">

        <div class="container-fluid">
            <div class="row justify-content-center">
                <!-- designer -->
                <div class="col-xl-9 col-md-12">
                    <div class="row designer">


                        <div class="col-xl-12 col-md-12 tool-bar rounded-pill">

                            <li>
                                <button type="button" id="add_new_text">أضف نص جديد</button>
                            </li>

                            <!-- edit Text -->
                            <li>
                                <button type="button" id="edit_new_text">عدل النص</button>
                            </li>

                            <li>
                                <button type="button" id="add_new_par">أضف فقرة جديد</button>
                            </li>


                            <!-- Add New Icon -->
                            <li>

                                <div class="dropdown">
                                    <button class=" dropdown-toggle" type="button" id="dropdownMenuIcon"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        أضف أيقونة
                                    </button>
                                    <div class="dropdown-menu"
                                         style="height: auto;max-height: 200px;overflow-x: hidden;"
                                         aria-labelledby="dropdownMenuIcon">
                                        <button class="dropdown-item text-center icon text-dark h-100 w-100 "
                                                type="button">
                                            <img src="{{ asset('images/admin/gallery/1.jpg') }}" alt="icon1"
                                                 width=80px"/>
                                        </button>
                                        <button class="dropdown-item text-center icon text-dark h-100 w-100 "
                                                type="button">
                                            <img src="{{ asset('images/admin/gallery/2.jpg') }}" alt="icon2"
                                                 width=80px"/>
                                        </button>
                                        <button class="dropdown-item text-center icon text-dark h-100 w-100 "
                                                type="button">
                                            <img src="{{ asset('images/admin/gallery/3.jpg') }}" alt="icon3"
                                                 width=80px"/>
                                        </button>
                                        <button class="dropdown-item text-center icon text-dark h-100 w-100 "
                                                type="button">
                                            <img src="{{ asset('images/admin/gallery/4.jpg') }}" alt="icon4"
                                                 width=80px"/>
                                        </button>

                                        @foreach($icons as $icon)
                                            <button class="dropdown-item text-center icon text-dark h-100 w-100 "
                                                    type="button">
                                                <img src="{{ asset('images/Icons/'.$icon->path) }}" alt="icon"
                                                     width=80px"/>
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            </li>

                            <!-- Change Font Type -->
                            <li>

                                <div class="dropdown">
                                    <button class=" dropdown-toggle" type="button" id="dropdownMenuButton"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        نوع الخط
                                    </button>
                                    <div class="dropdown-menu"
                                         style="height: auto;max-height: 200px;overflow-x: hidden;"
                                         aria-labelledby="dropdownMenuButton">
                                        <button class="dropdown-item font text-dark w-100 " type="button"
                                                style="font-family: 'font1'">نص جديد
                                        </button>
                                        <button class="dropdown-item font text-dark w-100 " type="button"
                                                style="font-family: 'font2'">نص جديد
                                        </button>
                                        <button class="dropdown-item font text-dark w-100 " type="button"
                                                style="font-family: 'font3'">نص جديد
                                        </button>
                                        <button class="dropdown-item font text-dark w-100 " type="button"
                                                style="font-family: 'font4'">نص جديد
                                        </button>
                                        @foreach($fonts as $font)
                                            <style>
                                                @font-face {
                                                    font-family: {{'new_font_'.$font->id}};
                                                    src: url({{asset('/fonts/'.$font->path)}});
                                                }
                                            </style>
                                            <button class="dropdown-item font text-dark w-100 " type="button"
                                                    style="font-family: '{{'new_font_'.$font->id}}'">
                                                {{$font->name}}
                                            </button>

                                        @endforeach
                                    </div>
                                </div>
                            </li>


                            <li>
                                <label for="font-size">حجم الخط</label>
                                <input type="number" id="font-size-bar" name="font-size" value="14" disabled>
                            </li>

                        </div>

                        <div class="design-overlay mx-auto mt-2" id="CardMainDesign"
                             style="background: url({{ asset('images/cards/'.$order->Card->path) }}) #ffffff;">
                            <img class="card-borders" id="Main-Image" style="visibility: hidden;"
                                 src="{{ asset('images/cards/'.$order->Card->path) }}"/>
                            <div id="CardDesignHtml">
                                {!! $order->html !!}
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <form action="{{ route('orders.update',['order'=>$order->id]) }}" method="POST" onsubmit="OnSubmit();"
                  style="display: flex; justify-content: center;margin-top: 20px">
                @csrf
                @method('PUT')

                <input type="hidden" value="" id="HtmlContent" name="HtmlContent" required>
                <input type="submit" class="btn btn-primary" name="save" value="حفظ">
            </form>


        </div>
    </div>
@endsection




@section('scripts')
    <script>
        $(".text_holder").draggable();
        $(".par_holder").draggable();
        $(".icon_holder").draggable();


        function OnSubmit() {
            var html = document.getElementById("CardDesignHtml").innerHTML;
            document.getElementById("HtmlContent").value = html;
            return true;
        }

        $(function(){
            $('#Main-Image').bind('load', function(){
                $('.design-overlay').css("width", $("#Main-Image").css("width"));
                $('.design-overlay').css("height", $("#Main-Image").css("height"));
            });
        });

        $(document).ready(function () {
            $('.design-overlay').css("width", $("#Main-Image").css("width"));
            $('.design-overlay').css("height", $("#Main-Image").css("height"));
        });

    </script>
@endsection
--}}
