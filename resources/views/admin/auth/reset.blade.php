@extends('layouts.admin-login')

@section('content')

    <div class="card">
        <div class="card-body p-4">
            <div class="text-center mb-4">
                <h4 class="text-uppercase mt-0">تغير كلمة المرور</h4>
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

            <form method="POST" action="{{ route('admin.reset.post') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group mb-3">
                    <label for="email">البريد الإلكتروني</label>
                    <input id="email" type="email" class="form-control" name="email"
                           value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                </div>

                <div class="form-group mb-3">
                    <label for="password">كلمة المرور الجديدة</label>
                    <input id="password" type="email" class="form-control" name="password" required autocomplete="new-password">
                </div>


                <div class="form-group mb-3">
                    <label for="password-confirm">تاكيد كلمة المرور الجديدة </label>
                    <input id="password-confirm" type="email" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>

                <div class="form-group mb-0 text-center">
                    <button type="submit" class="btn btn-primary btn-block">
                        تغير كلمة المرور
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
