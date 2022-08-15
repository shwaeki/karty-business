@extends('layouts.home')
@section('title','')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
@endpush


@section('content')
    <section class="border-bottom search-section m-section d-flex align-items-center">
        <div class="container">
            <div class="mb-5 text-center">
                <h6 class="mb-3 fw-bold text-white">ابحث <i class="fas fa-search"></i> هنا </h6>
                <h2 class="fw-bold text-white">وستجد لدينا طلبك بالتأكيد...</h2>
            </div>

            <div class="row  d-flex justify-content-center align-items-center">
                <div class="col-md-8">
                    <form action="{{route('search')}}">
                        <div class="search">
                            <i class="fa fa-search"></i>
                            <input type="text" class="form-control" name="search"
                                   placeholder="بإمكانك استخدام الكلمات المفتاحية او رمز المنتج...">
                            <button class="btn btn-primary" type="submit">بحث</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>



    <section class="border-bottom m-section">
        <div class="container p-4">
            <div class="mb-5 text-center">
                <h6 class="mb-3 fw-bold text-primary">تصنيفاتنا <i class="fas fa-heart"></i>&nbsp;المميزة</h6>
                <h2 class="fw-bold text-secondary"> المنتجات حسب التصنيف</h2>
            </div>
            <div class="swiper mySwiper">
                <div class="swiper-wrapper py-5">
                    @foreach($categories as $category)
                        <div class="swiper-slide">
                            <div class="card border-0 shadow p-1">
                                <div class="d-flex justify-content-between align-items-center p-2">
                                    <div><p class="fs-5 mb-0"> {{$category->name}}</p></div>
                                    <div class="gradient p-2 rounded">
                                        <img src="{{asset('images/site/icons/card.png')}}" width="90" class="img-fluid"
                                             alt="icon"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                @endforeach
                <!--                    <div class="swiper-slide">
                        <div class="card border-0 shadow p-1">
                            <div class="d-flex justify-content-between align-items-center p-2">
                                <div><p class="fs-5 mb-0"> برشور</p></div>
                                <div class="gradient p-2 rounded">
                                    <img src="{{asset('images/site/icons/brochure.png')}}" width="90" class="img-fluid"
                                         alt="icon"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card border-0 shadow p-1">
                            <div class="d-flex justify-content-between align-items-center p-2">
                                <div><p class="fs-5 mb-0"> قوائم طعام</p></div>
                                <div class="gradient p-2 rounded">
                                    <img src="{{asset('images/site/icons/menu.png')}}" width="90" class="img-fluid"
                                         alt="icon"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card border-0 shadow p-1">
                            <div class="d-flex justify-content-between align-items-center p-2">
                                <div><p class="fs-5 mb-0"> بلايز</p></div>
                                <div class="gradient p-2 rounded">
                                    <img src="{{asset('images/site/icons/t-shrit.png')}}" width="90" class="img-fluid"
                                         alt="icon"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card border-0 shadow p-1">
                            <div class="d-flex justify-content-between align-items-center p-2">
                                <div><p class="fs-5 mb-0"> أختام</p></div>
                                <div class="gradient p-2 rounded">
                                    <img src="{{asset('images/site/icons/stamp.png')}}" width="90" class="img-fluid"
                                         alt="icon"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card border-0 shadow p-1">
                            <div class="d-flex justify-content-between align-items-center p-2">
                                <div><p class="fs-5 mb-0">دفاتر مروسة</p></div>
                                <div class="gradient p-2 rounded">
                                    <img src="{{asset('images/site/icons/header.png')}}" width="90" class="img-fluid"
                                         alt="icon"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card border-0 shadow p-1">
                            <div class="d-flex justify-content-between align-items-center p-2">
                                <div><p class="fs-5 mb-0"> تقويم</p></div>
                                <div class="gradient p-2 rounded">
                                    <img src="{{asset('images/site/icons/calendar.png')}}" width="90" class="img-fluid"
                                         alt="icon"/>
                                </div>
                            </div>
                        </div>
                    </div>-->

                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>
    </section>


    <!--    Products    -->
    <section class="border-bottom m-section">
        <div class="container py-4 py-xl-5">
            <div class="mb-5 text-center">
                <h6 class="mb-3 fw-bold text-primary">منتجاتنا <i class="fas fa-heart"></i>&nbsp;المميزة</h6>
                <h2 class="fw-bold text-secondary">أحدث التصاميم</h2>
            </div>

            <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
                @foreach($categories as $category)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{$loop->index === 0 ? 'active' : '' }}"
                                id="category_{{$category->id}}_tab" data-bs-toggle="pill"
                                data-bs-target="#category_{{$category->id}}" type="button" role="tab">
                            {{$category->name}}
                        </button>
                    </li>
                @endforeach


            </ul>
            <div class="tab-content" id="pills-tabContent">
                @foreach($categories as $category)
                    <div class="tab-pane fade {{$loop->index === 0 ? ' show active' : '' }}"
                         id="category_{{$category->id}}" role="tabpanel"
                         aria-labelledby="category_{{$category->id}}_tab"
                         tabindex="0">.

                        <div class="row">

                            @foreach($category->cards as $card)

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

                                @if ($loop->index == 5)
                                    @break
                                @endif

                            @endforeach


                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-5">
                <a href="{{route('shop')}}"
                   class="btn btn-outline-primary btn-lg rounded-0 border-end-0 border-start-0 px-4 py-3">
                    تصفح المزيد
                </a>

            </div>
        </div>
    </section>

    <section class="border-bottom m-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 pb-5">
                    <img src="https://bootstrapmade.com/demo/templates/FlexStart/assets/img/hero-img.png"
                         class="img-fluid" alt="">
                </div>
                <div class="col-lg-6 d-flex flex-column justify-content-center">
                    <h1 class="mb-2">هنا سوف يكون عنوان رئيسي </h1>
                    <div style="height: 5px;width: 150px" class="bg-primary rounded-pill mb-3"></div>
                    <h3>لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص
                        بالتصاميم سواء كانت تصاميم مطبوعه ... بروشور او فلاير على سبيل المثال ... او نماذج مواقع
                        انترنت</h3>
                </div>
            </div>
        </div>
    </section>

    <!--    Info    -->
    <section class="text-center m-section">
        <div class="container">
            <div class="mb-5">
                <h6 class="mb-3 fw-bold text-primary">لــمـــاذا <i class="fas fa-business-time"></i>&nbsp;كــرتــي</h6>
                <h2 class="fw-bold text-secondary">خــدمــاتــــنـــا...</h2>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="card special-skill-item border-0">
                        <div class="card-header bg-transparent border-0">
                            <i class="fas fa-clone fa-3x text-primary"></i>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">خيارات متنوعة<br></h4>
                            <p class="card-text text-secondary">مجموعة كبيرة من التصاميم الحصرية</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card special-skill-item border-0">
                        <div class="card-header bg-transparent border-0">
                            <i class="fas fa-shipping-fast fa-3x text-primary"></i>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">خدمة التوصيل<br></h4>
                            <p class="card-text text-secondary">خدمة توصيل سريعة ومميزة</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card special-skill-item border-0">
                        <div class="card-header bg-transparent border-0">
                            <i class="fas fa-paint-brush fa-3x text-primary"></i>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">صمم بنفسك<br></h4>
                            <p class="card-text text-secondary">تجربة مميزة للتصميم</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card special-skill-item border-0">
                        <div class="card-header bg-transparent border-0">
                            <i class="fas fa-money-bill-wave fa-3x text-primary"></i>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">طرق الدفع<br></h4>
                            <p class="card-text text-secondary">طرق متعددة ومختلفة للدفع</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection


@push('scripts')
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 4,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                //    delay: 1000,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });
    </script>

@endpush
