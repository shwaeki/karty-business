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


</head>
<body>


<div class="container-fluid">
    <div class="row">
        <div id="side-bar-overlay" onclick="toggleSideBar()"></div>

        <div class="col-12 col-md-10 offset-md-2 p-0">
            <nav class="navbar navbar-expand-lg navbar-light bg-white">
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
                    <img src="{{ asset('images/cards/'.$card->path)  }}" id="design-background"
                         alt="background">
                    <div id="design-content">
                        {!! $card->html !!}

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

            <!-- Card Information -->
            <div class="accordion" id="accordionOptions">
                <div class="card bg-dark-blue">
                    <div class="card-header" id="headingInfo">
                        <a class="text-decoration-none d-block" role="button" data-bs-toggle="collapse"
                           data-bs-target="#collapseInfo" aria-expanded="false" aria-controls="collapseInfo">
                            <i class="fas fa-grip-horizontal"></i> معلومات الكرت
                        </a>
                    </div>
                    <div id="collapseInfo" class="collapse show" aria-labelledby="headingInfo"
                         data-parent="#accordionOptions">
                        <div class="card-body bg-dark text-white">
                            <div class="row">
                                <form action="{{ route('cards.update',['card'=>$card->id]) }}" method="POST" onsubmit="OnSubmit();"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" value="" id="HtmlContent" name="HtmlContent" required>


                                    <div class="mb-3">
                                        <label for="name" class="form-label">إسم الكرت </label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               placeholder="#11111" value="{{old('name',$card->name)}}" required>
                                    </div>


                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="cardPrice" class="form-label">>سعر الكرت </label>
                                                <input type="text" class="form-control" id="cardPrice" name="cardPrice"
                                                       value="{{old('cardPrice',$card->price)}}" step="any" required>
                                            </div>

                                        </div>
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="cost" class="form-label">>تكلفة الكرت </label>
                                                <input type="number" class="form-control" id="cost" name="cost"
                                                       value="{{old('cost',$card->cost)}}" step="any" required>
                                            </div>
                                        </div>
                                    </div>




                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="discount" class="form-label">نسبة الخصم</label>
                                                <input type="number" class="form-control" id="discount" name="discount"
                                                       value="{{old('discount',$card->discount)}}" step="any" required>
                                            </div>

                                        </div>
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="maxpar" class="form-label">عدد الفقرات  </label>
                                                <input type="number" class="form-control" id="maxpar" name="maxpar"
                                                       value="{{old('maxpar',$card->maxpar)}}">
                                            </div>
                                        </div>
                                    </div>



                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="height" class="form-label">طول الكرت </label>
                                                <input type="number" step="0.01" class="form-control" id="height" name="height"
                                                       value="{{old('height',$card->height)}}" placeholder="10" required>
                                            </div>

                                        </div>
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="width" class="form-label">عرض الكرت </label>
                                                <input type="number" step="0.01" class="form-control" id="width" name="width"
                                                       value="{{old('width',$card->width)}}" placeholder="20" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label"> الوصف </label>
                                        <textarea class="form-control" id="description" name="description"
                                                  rows="3" required>{{old('description',$card->description)}}</textarea>

                                    </div>

                                    <div class="mb-3">
                                        <label for="cardcat" class="form-label"> الفئة </label>
                                        <select class="form-select"  name="category" id="cardcat" required>
                                            <option selected disabled>اختار</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}"
                                                    {{old('category',$card->category) == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                            @endforeach
                                        </select>

                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="transparent"
                                               value="transparent" id="transparent"
                                            {{old('transparent',$card->transparent) != null ? 'checked' : '' }} >
                                        <label class="form-check-label" for="flexCheckDefault">
                                            كرت شفاف
                                        </label>
                                    </div>


                                    <div class="mb-3">
                                        <label for="cardBorder" class="form-label">شبلونة الطباعة</label>
                                        <input type="file" id="cardBorder"   class="form-control"
                                               onchange="ChangeCard(event)" accept="image/*" name="cardBorder">

                                    </div>


                                    <div class="mb-3">
                                        <input type="hidden" name="style" id="style_id" value="0">


                                        <button class="btn btn-secondary  mr-2" type="button" name="save"
                                                onclick="changeStyle(0);">الرئيسي</button>
                                        @foreach($card->styles as $style)
                                            <div class=" position-relative mr-2 d-inline-block">
                                                <button class="btn btn-secondary" type="button" onclick="changeStyle({{$style->id}});">
                                                    #{{$loop->iteration	}}
                                                </button>
                                                <button form="delete_style_{{$style->id}}" class="btn delete-style-button">X</button>

                                            </div>

                                        @endforeach
                                    </div>
                                    <div class="mb-3">
                                        <input type="submit" class="btn btn-primary" name="save" value="حفظ">
                                        <input type="submit" class="btn btn-secondary" name="new" value="حفظ كتصميم جديد">
                                    </div>




                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <!-- Add New Icon-->
            <div class="accordion" id="accordionOptions">
                <div class="card bg-dark-blue">
                    <div class="card-header" id="headingTwo">
                        <a class="text-decoration-none d-block" role="button" data-bs-toggle="collapse"
                           data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <i class="fas fa-grip-horizontal"></i> اضافة رمز
                        </a>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                         data-parent="#accordionOptions">
                        <div class="card-body bg-dark">
                            <div class="row">

                                @foreach($icons as $icon)
                                    <div class="col-6 p-1">
                                        <div class="icon-container img-thumbnail mb-2">
                                            <img src="{{ asset('images/Icons/'.$icon->path) }}" alt="icon" class="icon"
                                                 onclick="newIcon(this)">
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Change Card Style-->
            {{--
            <div class="accordion" id="accordionOptions">
                <div class="card bg-dark-blue">
                    <div class="card-header" id="headingThree">
                        <a class="text-decoration-none d-block" role="button" data-bs-toggle="collapse"
                           data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            <i class="fas fa-grip-horizontal"></i> تعديل التصميم
                        </a>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                         data-parent="#accordionOptions">
                        <div class="card-body bg-dark">
                            <div class="row">

                                <div class="col-6 p-1">
                                    <div class="style-container img-thumbnail mb-2" onclick="changeStyle(0);">
                                        التصميم الاساسي
                                    </div>
                                </div>
                                @foreach($card->styles as $style)
                                    <div class="col-6 p-1">
                                        <div class="style-container img-thumbnail mb-2"
                                             onclick="changeStyle({{$style->id}});">
                                            #{{$loop->iteration}} لتصميم الثانوي
                                        </div>
                                    </div>
                                @endforeach


                            </div>
                        </div>

                    </div>
                </div>
            </div>
--}}

            <span id="side-bar-close-button" class="d-block d-md-none" onclick="toggleSideBar()"></span>
        </div>
    </div>


    <div id="style_0_content" class="d-none">
        {!! $card->html !!}
    </div>

    @foreach($card->styles as $style)
        <form action="{{ route('cards.destroy.style',['cardStyle'=>$style]) }}" method="POST" class="d-none" id="delete_style_{{$style->id}}">
            @method('DELETE')
            @csrf
        </form>

        <div id="style_{{$style->id}}_content" class="d-none">
            {!! $style->html !!}
        </div>
    @endforeach


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
    $(function () {
        $('[data-toggle="tooltip"]').tooltip({placement: 'bottom'})
    })

    function changeStyle(id) {
        $("#design-content").html($("#style_" + id + "_content").html());
        $("#style_id").val(id);
    }

    function OnSubmit() {
        removeSelectElement();
        var html =  $('#design-content').html();
        $('#HtmlContent').val(html);
        return true;
    }

    function ChangeCard(event) {
        $('#design-background').attr('src',URL.createObjectURL(event.target.files[0]));
        doResize();
    }

</script>
</body>
</html>
