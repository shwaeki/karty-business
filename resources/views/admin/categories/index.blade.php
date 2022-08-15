@extends('layouts.admin',['title'=>''])

@section('content')
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{route('categories.store')}}" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> اضافة فئة جديدة</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name" class="col-form-label">اسم الفئة</label>
                            <input type="text" name="name" class="form-control" id="name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        <button type="submit" class="btn btn-primary">اضافة</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="card shadow">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="right">
                    <h2>قائمة الفئات </h2>
                </div>
                <div class="left">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        اضافة فئة جديدة
                    </button>
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
                        <th>إسم الفئة</th>
                        <th>خيارات</th>
                    </tr>
                    </thead>

                    <tbody>

                    @foreach($categories as $category)
                        <tr>
                            <td class="font-name">{{$category->name}}</td>
                            <td>
                                <button id="delete-item" data-item-path="{{route('categories.destroy',['category'=>$category->id])}}"
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
