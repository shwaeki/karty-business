@extends('layouts.admin')

@section('content')

    <div class="card shadow">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="right">
                    <h2>قائمة الكروت </h2>
                </div>
                <div class="left">
                    <a href="{{route('cards.create')}}" class="btn btn-primary">اضافة كرت جديدة</a>
                </div>
            </div>
            <form>
                <div class="input-group w-25 mb-3">
                    <input class="form-control" type="search"
                           name="search" value="{{ request('search') }}" placeholder="بحث">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>
            <div class="table-responsive-md">
                <table class="table">
                    <thead>
                    <tr>
                        <th>الكرت</th>
                        <th>اسم الكرت</th>
                        <th>سعر الكرت</th>
                        <th>تصنيف الكرت</th>
                        <th>خيارات</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($cards as $card)
                        <tr>
                            <td>
                                <img src="{{$card->images()->first()->image_path}}" width="100px" height="100px">
                            </td>
                            <td>{{$card->name}}</td>
                            <td>₪{{$card->price}}</td>
                            <td>{{$card->Category->name ?? ''}}</td>
                            <td>

                                <a href="{{route('cards.edit',['card'=>$card->id])}}"
                                   class="btn btn-sm btn-warning">تعديل</a>

                                <button id="delete-item" data-item-path="{{route('cards.destroy',['card'=>$card->id])}}"
                                        type="button" class="btn btn-sm btn-danger">
                                    حذف
                                </button>
                                @if(!$card->published)
                                    <form action="{{ route('cards.update',['card'=>$card->id]) }}" class="d-inline" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="publish" value="1">
                                        <button class="btn btn-sm btn-primary" type="submit">نشر</button>
                                    </form>
                                @else
                                    <form action="{{ route('cards.update',['card'=>$card->id]) }}" class="d-inline" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="publish" value="0">
                                        <button class="btn btn-sm btn-primary" type="submit">الغاء النشر</button>
                                    </form>

                                @endif

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            {{ $cards->links() }}
        </div>
    </div>

@endsection
