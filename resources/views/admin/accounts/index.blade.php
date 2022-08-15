@extends('layouts.admin')

@section('content')
    <div class="card shadow">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="right">
                    <h2 class="mt-0 header-title">إدارة الحسابات</h2>
                </div>
                <div class="left">
                    <a href="{{route('accounts.create')}}" class="btn btn-primary">انشاء حساب جديد</a>
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
                <table class="table table-centered mb-0" id="btn-editable">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>إسم المستخدم</th>
                        <th>الاسم</th>
                        <th>التصنيف</th>
                        <th>رقم الهاتف</th>
                        <th>البريد الإلكتروني</th>
                        <th>خيارات</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($admins as $admin)
                        <tr>
                            <td>{{$admin->id}}</td>
                            <td>{{$admin->name}}</td>
                            <td>{{$admin->username}}</td>
                            <td>{{$admin->type}}</td>
                            <td>{{$admin->phone}}</td>
                            <td>{{$admin->email}}</td>
                            <td>
                                <a href="{{route('accounts.edit',['account'=>$admin->id])}}"
                                   class="btn btn-warning btn-sm">تعديل</a>

                                <button id="delete-item" data-item-path="{{route('accounts.destroy',['account'=>$admin->id])}}"
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

