@extends('layouts.admin')

@section('content')

    <div class="card shadow">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="right">
                    <h2>قائمة الكوبونات </h2>
                </div>
                <div class="left">
                    <a href="{{route('coupons.create')}}" class="btn btn-primary">اضافة كوبون جديدة</a>
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
                        <th>الكوبون</th>
                        <th>عدد مرات الاستخدام</th>
                        <th>نسبة الخصم</th>
                        <th>خيارات</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($coupons as $coupon)
                        <tr>
                            <td>{{$coupon->code}}</td>
                            <td>{{$coupon->count}}</td>
                            <td>{{$coupon->percentage}}</td>
                            <td>
                                <button id="delete-item" data-item-path="{{route('coupons.destroy',['coupon'=>$coupon->id])}}"
                                        type="button" class="btn btn-sm btn-danger">
                                    حذف
                                </button>
                            </td>
                        </tr>
                    @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
