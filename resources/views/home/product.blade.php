@extends('layouts.home')
@section('title','كرتي - كرت  #'.$card->name)
@section('description', $card->description)

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css">

@endpush
@section('content')
    <div class="container-fluid gradient-bg page-header  m-section">
        <h2 class="border-bottom fw-bold mb-3 mx-auto pb-2 w-25">المتجر </h2>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a class="text-white" href="{{route('home')}}">الرئيسية</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="{{route('shop')}}">المتجر</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    <a class="text-white" href="{{url()->full()}}"> كرت #{{$card->name}}</a>
                </li>
            </ol>
        </nav>
    </div>

    <section class="border-bottom m-section pb-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-3 order-1 order-md-0">
                    <div class="text-center mb-5">
                        <h6 class="border-bottom border-primary fw-bold pb-2">اسم العنصر</h6>
                        <span> كرت #{{$card->name}}</span>
                    </div>
                    <div class="text-center mb-5">
                        <h6 class="border-bottom border-primary fw-bold pb-2">السعر</h6>
                        <span>{{$card->discount_price}}₪</span>
                    </div>

                    <div class="text-center mb-5">
                        <h6 class="border-bottom border-primary fw-bold pb-2">الوصف</h6>
                        <span>{{$card->description}}</span>
                    </div>


                    <div class="text-center mb-5">
                        <h6 class="border-bottom border-primary fw-bold pb-2">ابعاد التصميم</h6>
                        <div class="d-flex justify-content-around">
                            <span>{{$card->width}} <span>سم</span></span>
                            <span class="fw-bold">X</span>
                            <span>{{$card->height}} <span>سم</span></span>
                        </div>
                    </div>
                    <div class="text-center mb-5 d-flex">
                        <a href="{{route('design',['id'=>$card->id])}}" class="btn btn-primary btn-lg w-100 me-2">
                            صمم كرتك
                        </a>
                        <button class="btn btn-primary btn-lg"
                                onclick="addToFavorite({{$card->id}})" id="favorite_p_{{$card->id}}">
                            <i class="fas fa-heart"
                               style="{{$card->isLiked ?  'color: #ec9dab': 'color: #fff' }}"></i>

                        </button>
                    </div>
                </div>
                <div class="col-12 col-md-8 ">
                    <div class="row">
                        <div class="col-12 col-md-3  order-1 order-md-0">
                            <div class="images-container">
                                @foreach($card->images as $image)
                                    <div class="image">
                                        <img src="{{ $image->image_path }}" alt=""/>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-12 col-md-9">
                            <div class="main-image">
                                <a class="image-popup" href="{{ $card->images->first()->image_path}}">
                                    <img src="{{ $card->images->first()->image_path}}" alt=""/>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="m-section">
        <div class="container p-4">
            <div class="mb-5 text-center">
                <h6 class="mb-3 fw-bold text-primary">قــــــد <i class="fas fa-heart"></i>&nbsp;يعجبك</h6>
                <h2 class="fw-bold text-secondary"> شاهد أيضاًً</h2>
            </div>

            <div class="row">

                @foreach($seemore as $card)

                    <div class="col-md-3 col-sm-6">
                        <div class="product-item">
                            <div class="product">
                                <a href="{{route('product',['id'=>$card->id])}}">
                                    <img src="{{$card->images()->first()->image_path}}" alt="">
                                </a>
                            </div>
                            @if($card->discount > 0)
                                <div class="tag gradient text-white">خصم {{$card->discount}}%</div>
                            @endif
                            <div class="row w-100 px-4">
                                <div class="col-10">
                                    <div class="title pt-4 pb-1">{{$card->name}}#</div>
                                    <div class="price">₪{{$card->discount_price}}</div>
                                </div>
                                <div class="col-2 align-self-center">
                                    <div class="icon shadow" id="favorite_p_{{$card->id}}"
                                         onclick="addToFavorite({{$card->id}})">
                                    <span class="far fa-heart"
                                          style="{{$card->isLiked ?  'color: #ec9dab': 'color: #999' }}"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach

            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js"></script>

    <script>
        $('.images-container .image img').click(function () {
            var src = $(this).attr('src');
            $(".main-image img").fadeOut(200, function () {
                $('.main-image img').attr('src', src);
                $('.image-popup').attr('href', src);
            }).fadeIn(400);
        })


        $('.image-popup').magnificPopup({
            type: 'image',
            closeOnContentClick: true,
            closeBtnInside: false,
            fixedContentPos: true,
            mainClass: 'mfp-no-margins  mfp-with-zoom',
            image: {
                verticalFit: true
            },
            zoom: {
                enabled: true,
                duration: 300
            }
        });
    </script>
@endpush

