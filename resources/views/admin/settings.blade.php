@extends('layouts.admin')

@section('content')
    <div class="card shadow">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="right">
                    <h2>اعدادات الحساب</h2>
                </div>
            </div>



                    <h3 class="text-center">تغير المعلومات الشخصية</h3>
                    <form method="POST" action="{{route('changeInfo')}}">
                        @method('PUT')
                        @csrf

                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label" for="name">الاسم الاكمل</label>
                                    <input type="text" class="form-control" name="name" value="{{auth('admin')->user()->name}}"
                                           id="name">
                                </div>

                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label" for="email">البريد الاكتروني</label>
                                    <input type="email" class="form-control" name="email"
                                           value="{{auth('admin')->user()->email}}"
                                           id="email">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label" for="username">اسم المستخدم </label>
                                    <input type="text" class="form-control" name="username" value="{{auth('admin')->user()->username}}"
                                           id="username">
                                </div>

                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label" for="phone">رقم الهاتف</label>
                                    <input type="text" class="form-control" name="phone"
                                           value="{{auth('admin')->user()->phone}}"
                                           id="phone">
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">تغير المعلومات</button>
                        </div>
                    </form>

                    <h3  class="text-center mt-5" >تغير كلمة المرور</h3>
                    <form method="POST" action="{{route('changePassword')}}">
                        @method('PUT')
                        @csrf

                        <div class="mb-3">
                            <label class="form-label" for="current_password">كلمة المرور الحالية</label>
                            <input type="password" class="form-control" name="current_password" id="current_password">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="password">كلمة المرورالجديدة</label>
                            <input type="password" class="form-control" name="password" id="password">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="password_confirmation">تاكيد كلمة المرورالجديدة</label>
                            <input type="password" class="form-control" name="password_confirmation"
                                   id="password_confirmation">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">تغير كلمة المرور</button>
                        </div>
                    </form>


        </div>
    </div>

@endsection

