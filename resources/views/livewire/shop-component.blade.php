<section class="m-section">
    <div class="container">
        <button class="btn btn-primary w-100 d-block d-md-none mb-3" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseFilter">
            <i class="fas fa-filter"></i> فلترة المنتجات
        </button>
        <div class="row">

            <div class="col-12 col-md-3 collapse d-md-block" id="collapseFilter">
                <div class="position-sticky bg-white shadow p-3 mt-3" style="top: 30px">
                    <div class="mb-5">
                        <input type="search" class="form-control" placeholder="إبحث هنا..." wire:model="filter.search"/>
                    </div>

                    <div class="mb-5">
                        <h5 class="border-bottom pb-2 border-primary"> فلترة السعر</h5>
                        <p class="text-center mb-2">₪<span id="max">{{ $filter['max']}}</span> <strong>-</strong> ₪<span
                                id="min">{{abs(((float)$filter['min']-($max_price/2)))}}</span></p>
                        <ul class="custom-range">
                            <input class="max" type="range" step="0.5" min="{{$max_price/2}}" max="{{$max_price}}"
                                   wire:model="filter.max"/>
                            <input class="min" type="range" step="0.5" min="{{$min_price}}" max="{{$max_price/2}}"
                                   wire:model="filter.min"/>
                        </ul>
                    </div>

                    <div class="mb-5">
                        <h5 class="border-bottom pb-2 border-primary">الترتيب حسب</h5>
                        <ul class="custom-radio ">
                            <li>
                                <input type="radio" id="default" wire:model="filter.sort" value="default" checked>
                                <label for="default">افتراضي</label>
                            </li>
                            <li>
                                <input type="radio" id="newest" wire:model="filter.sort" value="newest">
                                <label for="newest">الاحدث</label>
                            </li>
                            <li>
                                <input type="radio" id="htl" wire:model="filter.sort" value="DESC">
                                <label for="htl">السعر الاعلى</label>
                            </li>
                            <li>
                                <input type="radio" id="lth" wire:model="filter.sort" value="ASC">
                                <label for="lth">السعر الاقل</label>
                            </li>

                        </ul>
                    </div>

                    <div class="mb-5">
                        <h5 class="border-bottom pb-2 border-primary">انواع البطاقات</h5>
                        <ul class="custom-radio">
                            <li>
                                <input type="radio" wire:model="filter.category" value="default" id="filter_default">
                                <label for="filter_default">الجميع</label>
                            </li>

                            @foreach($categories as $category)
                                <li>
                                    <input type="radio" wire:model="filter.category" id="filter{{$category->id}}"
                                           value="{{$category->id}}">
                                    <label for="filter{{$category->id}}">{{$category->name}}</label>
                                </li>
                            @endforeach
                        </ul>
                    </div>


                </div>
            </div>


            <div class="col-12 col-md-9">
                <div class="row">
                    @foreach($cards as $card)
                        <div class="col-lg-4 col-sm-6">
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
                    @endforeach
                </div>
                <div class="text-center">
                    <div class="loader" wire:loading>جاري التحميل...</div>
                </div>

            </div>
        </div>
    </div>
</section>
