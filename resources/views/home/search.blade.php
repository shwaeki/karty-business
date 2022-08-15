@extends('layouts.home')
@section('title','كرتي - المتجر')

@section('content')
    <div class="container-fluid gradient-bg page-header  m-section">
        <h2 class="border-bottom fw-bold mb-3 mx-auto pb-2 w-25">المتجر </h2>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a class="text-white" href="{{route('home')}}">الرئيسية</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="{{route('shop')}}">المتجر</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    <a class="text-white" href="{{url()->full()}}"> البحث</a>
                </li>
            </ol>
        </nav>
    </div>



    <section class="m-section">
        <div class="container">
                <h2 class="mt-3">نتائج البحث عن : {{request('search')}}</h2>
            <div class="row">
                @forelse($cards as $card)
                    <div class="col-lg-3 col-sm-6">
                        <div class="product-item">
                            <div class="product">
                                <a href="{{route('product',['id'=>$card->id])}}">
                                    <img src="{{$card->images()->first()->image_path}}" class="lazy" alt="">
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
                @empty
                    <div class="col-12 text-center my-5">
                        <h3>لم يتم العثور على اي نتائج</h3>
                    </div>
                @endforelse
            </div>

        </div>
    </section>


@endsection
