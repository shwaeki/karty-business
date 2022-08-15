@extends('layouts.admin')

@section('content')
    <div class="card shadow">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="right">
                    <h2>اضافة حساب جديد </h2>
                </div>
            </div>


            <form action="{{ route('accounts.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="username" class="form-label">إسم المستخدم </label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                   placeholder="إسم المستخدم" name="username" id="username"
                                   value="{{ old('username') }}" required>

                            @error('username')
                            <span class="invalid-feedback text-start"><strong>{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="name" class="form-label">الأسم الرباعي </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   placeholder="الأسم الرباعي" name="name" id="name"
                                   value="{{ old('name') }}" required>

                            @error('name')
                            <span class="invalid-feedback text-start"><strong>{{ $message }}</strong>
                            @enderror
                        </div>

                    </div>
                </div>


                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="email" class="form-label">البريد الإلكتروني</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   placeholder="البريد الإلكتروني" name="email" id="email"
                                   value="{{ old('email') }}" required>

                            @error('email')
                            <span class="invalid-feedback text-start"><strong>{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="phone" class="form-label">رقم الهاتف</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                   placeholder="رقم الهاتف" name="phone" id="phone"
                                   value="{{ old('phone') }}" required>

                            @error('phone')
                            <span class="invalid-feedback text-start"><strong>{{ $message }}</strong>
                            @enderror
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class=" mb-3">
                            <label for="password" class="form-label">كلمة المرور </label>
                            <input type="password" id="password"
                                   class="form-control  @error('password') is-invalid @enderror"
                                   placeholder="كلمة المرور" name="password" required>
                            @error('password')
                            <span class="invalid-feedback text-start"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class=mb-3">
                            <label for="password-con" class="form-label">تأكيد كلمة المرو </label>
                            <input type="password" class="form-control" id="password-con"
                                   placeholder="تأكيد كلمة المرور" name="password_confirmation" required>
                        </div>
                    </div>
                </div>

                <div class=" mb-3">
                    <label for="usertype" class="form-label">التصنيف </label>
                    <select name="usertype" id="usertype" class="form-select" required>
                        <option value="Admin">مدير</option>
                        <option value="Delivery">توصيل</option>
                        <option value="Printer">طباعة</option>
                    </select>

                    @error('usertype')
                    <span class="invalid-feedback text-start"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>



                <button type="submit" class="btn btn-primary ">حفظ</button>


            </form>
        </div>
    </div>

@endsection


