@extends('layouts.admin')

@section('content')
    <div class="card shadow">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="right">
                    <h2>معلومات المنتج {{$product->name}} </h2>
                </div>
                <div class="left">
                    <a href="{{route('cards.edit',['card'=>$product->id])}}"
                       class="btn btn-warning">تعديل</a>

                    <button id="delete-item" data-item-path="{{route('cards.destroy',['card'=>$product->id])}}"
                            type="button" class="btn btn-danger">
                        حذف
                    </button>
                    @if(!$product->published)
                        <form action="{{ route('cards.update',['card'=>$product->id]) }}" class="d-inline"
                              method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="publish" value="1">
                            <button class="btn btn-primary" type="submit">نشر</button>
                        </form>
                    @else
                        <form action="{{ route('cards.update',['card'=>$product->id]) }}" class="d-inline"
                              method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="publish" value="0">
                            <button class="btn btn-primary" type="submit">الغاء النشر</button>
                        </form>

                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="name" class="form-label">إسم المنتج </label>
                        <input type="text" class="form-control" id="name" value="{{$product->name}}" disabled>
                    </div>

                </div>
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="cardPrice" class="form-label">سعر المنتج </label>
                                <input type="text" class="form-control" id="cardPrice" value="{{ $product->price}}"
                                       disabled>
                            </div>

                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="cost" class="form-label">تكلفة المنتج </label>
                                <input type="text" class="form-control" id="cost" value="{{$product->cost}}" disabled>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="discount" class="form-label">نسبة الخصم</label>
                        <input type="text" class="form-control" id="discount" value="{{$product->discount}}" disabled>
                    </div>

                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="minimum" class="form-label">اقل كمية طلب </label>
                        <input type="text" class="form-control" id="minimum" value="{{$product->minimum}}" disabled>
                    </div>
                </div>

                <div class="col">
                    <div class="mb-3">
                        <label for="height" class="form-label">طول المنتج </label>
                        <input type="text" class="form-control" id="height" value="{{$product->height}}" disabled>
                    </div>

                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="width" class="form-label">عرض المنتج </label>
                        <input type="text" class="form-control" id="width" value="{{$product->width}}" disabled>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label"> الوصف </label>
                <textarea class="form-control" id="description" rows="3" disabled>{{$product->description}}</textarea>
            </div>

            <div class="mb-3">
                <label for="cardcat" class="form-label"> الفئة </label>
                <input type="text" class="form-control" id="cardcat" value="{{$product->Category->name ?? ''}}"
                       disabled>
            </div>
        </div>
    </div>

    <div class="card shadow mt-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="right">
                    <h2>تصاميم المنتج </h2>
                </div>
                <div class="left">
                    <a href="{{route('cards.styles.create',['card'=>$product->id])}}"
                       class="btn btn-primary">اضافة تصميم جديد</a>
                </div>
            </div>
            <div class="hstack gap-3">

                @foreach($product->styles as $image)
                    <div class=" shadow">
                        <div class="bg-primary  text-white  d-flex justify-content-center align-items-center"
                             style="height: 150px;width: 350px">
                            <span>  تصميم {{$loop->iteration}}</span>
                        </div>
                        <div class="d-flex justify-content-around p-2">
                            <button type="button"
                                    class="btn btn-warning btn-sm">
                                تعديل
                            </button>
                            <button id="delete-item" type="button"
                                    class="btn btn-danger btn-sm"
                                    data-item-path="{{route('cards.destroy.style',['cardStyle'=>$image->id])}}">
                                حذف
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="card shadow mt-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="right">
                    <h2>صور المنتج </h2>
                </div>
            </div>
            <div class="hstack gap-3">


                @foreach($product->images as $image)
                    <div class="position-relative ">
                     <span
                         class="position-absolute top-0 start-100 translate-middle badge border border-light rounded-circle bg-danger p-2">
                         <i class="fas fa-times"></i>
                     </span>

                        <img src="{{ $image->image_path }}" class="img-thumbnail" width="150px" height="150px" alt="">
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
