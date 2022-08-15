@extends('layouts.admin')

@section('content')
    <div class="card shadow">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="right">
                    <h2>قائمة الايقونات </h2>
                </div>
                <div class="left">
                    <a href="{{route('icons.create')}}" class="btn btn-primary">اضافة ايقونة جديدة</a>
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
                        <th>الايقونة</th>
                        <th>اسم الايقونة</th>
                        <th>خيارات</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($icons as $icon)
                        <tr>
                            <td>
                                <img src="{{asset('/images/Icons/'.$icon->path)}}" width="100px" height="100px">
                            </td>
                            <td>{{$icon->name}}</td>
                            <td>

                                <button id="delete-item" data-item-path="{{route('icons.destroy',['icon'=>$icon->id])}}" type="button"
                                        class="btn btn-sm btn-danger">
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

