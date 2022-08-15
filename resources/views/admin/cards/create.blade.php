@extends('layouts.admin')

@section('content')
    <div class="card shadow">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="right">
                    <h2>اضافة منتج جديد </h2>
                </div>
            </div>


            <form action="{{ route('cards.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
{{--                <input type="hidden" value="" id="HtmlContent" name="HtmlContent" required>--}}


                <div class="mb-3">
                    <label for="name" class="form-label">إسم المنتج </label>
                    <input type="text" class="form-control" id="name" name="name"
                           placeholder="#11111" value="{{old('name')}}" required>
                    @error('name')
                    <span class="invalid-feedback text-start"><strong>{{ $message }}</strong>
                    @enderror
                </div>


                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="cardPrice" class="form-label">سعر الكرت </label>
                            <input type="text" class="form-control" id="cardPrice" name="price"
                                   value="{{old('price')}}" step="any" required>
                            @error('cardPrice')
                            <span class="invalid-feedback text-start"><strong>{{ $message }}</strong>
                            @enderror
                        </div>

                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="cost" class="form-label">تكلفة الكرت </label>
                            <input type="number" class="form-control" id="cost" name="cost"
                                   value="{{old('cost',0)}}" step="any" required>
                            @error('cost')
                            <span class="invalid-feedback text-start"><strong>{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="discount" class="form-label">نسبة الخصم</label>
                            <input type="number" class="form-control" id="discount" name="discount"
                                   value="{{old('discount',0)}}" step="any" required>
                            @error('discount')
                            <span class="invalid-feedback text-start"><strong>{{ $message }}</strong>
                            @enderror
                        </div>

                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="minimum" class="form-label">اقل كمية طلب </label>
                            <input type="number" class="form-control" id="minimum" name="minimum"
                                   value="{{old('minimum',50)}}">
                            @error('minimum')
                            <span class="invalid-feedback text-start"><strong>{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="height" class="form-label">طول الكرت </label>
                            <input type="number" step="0.01" class="form-control" id="height"
                                   name="height"
                                   value="{{old('height')}}" placeholder="10" required>
                            @error('height')
                            <span class="invalid-feedback text-start"><strong>{{ $message }}</strong>
                            @enderror
                        </div>

                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="width" class="form-label">عرض الكرت </label>
                            <input type="number" step="0.01" class="form-control" id="width"
                                   name="width"
                                   value="{{old('width')}}" placeholder="20" required>
                            @error('width')
                            <span class="invalid-feedback text-start"><strong>{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label"> الوصف </label>
                    <textarea class="form-control" id="description" name="description"
                              rows="3" required>{{old('description')}}</textarea>
                    @error('description')
                    <span class="invalid-feedback text-start"><strong>{{ $message }}</strong>
                    @enderror

                </div>

                <div class="mb-3">
                    <label for="cardcat" class="form-label"> الفئة </label>
                    <select class="form-select" name="category" id="cardcat" required>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    @error('category')
                    <span class="invalid-feedback text-start"><strong>{{ $message }}</strong>
                    @enderror
                </div>


                <div class="mb-3">
                    <label for="cardBorder" class="form-label">شبلونة الطباعة</label>
                    <input type="file" id="cardBorder" class="form-control"
                           onchange="ChangeCard(event)" accept="image/*" name="cardBorder" required>
                    @error('cardBorder')
                    <span class="invalid-feedback text-start"><strong>{{ $message }}</strong>
                    @enderror

                </div>

                <div class="mb-3">
                    <label for="cardImages" class="form-label">صور للكرت</label>
                    <input type="file" id="cardImages" class="form-control"
                           accept="image/*" name="cardImages[]" required multiple>
                    @error('cardImages')
                    <span class="invalid-feedback text-start"><strong>{{ $message }}</strong>
                    @enderror
                </div>

                <div class="mb-3">
                    <input type="submit" class="btn btn-primary" name="save" value="حفظ">
                </div>

            </form>

        </div>
    </div>

@endsection
