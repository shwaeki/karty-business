@extends('layouts.admin-login')

@section('content')

    <div class="card shadow">

        <div class="card-body p-4">

            <div class="text-center mb-4">
                <h4 class="text-uppercase mt-0">تسجيل الدخول</h4>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0 ml-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="form-horizontal" method="POST" action="{{ route('admin.login.post') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">البريد الإلكتروني</label>
                    <input id="email" type="email" class="form-control" name="email"
                           value="{{ old('email') }}" placeholder="أدخل البريد الإلكتروني أو إسم المستخدم"
                           required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">كلمة المرور</label>
                    <input id="password" type="password" class="form-control" name="password" required
                           placeholder="أدخل كلمة المرور">

                </div>

                <div class="mb-3">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="checkbox-signin"
                               name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="custom-control-label" for="checkbox-signin">تذكرني</label>
                    </div>
                </div>

                <div class="form-group mb-0 text-center">
                    <button type="submit" class="btn btn-primary btn-block">
                        تسجيل الدخول
                    </button>
                </div>
            </form>
        </div>
    </div>
        <div class="row mt-3">
            <div class="col-12 text-center">
                <p><a href="{{route('admin.forgot')}}" class="text-muted ml-1"><i class="fa fa-lock mr-1"></i>هل نسيت كلمة
                        المرور؟</a></p>
            </div>
        </div>

@endsection
