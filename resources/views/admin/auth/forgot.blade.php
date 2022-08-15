@extends('layouts.admin-login')

@section('content')

    <div class="card shadow">
        <div class="card-body p-4">
            <div class="text-center mb-4">
                <h4 class="text-uppercase mt-0">استعادة كلمة المرور</h4>
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

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.forgot.post') }}">
                @csrf

                <div class="form-group mb-3">
                    <label for="email" class="form-label">البريد الإلكتروني</label>
                    <input id="email" type="email" class="form-control" name="email"
                           value="{{ old('email') }}" placeholder="أدخل البريد الإلكتروني"
                           required>
                </div>

                <div class="form-group mb-0 text-center">
                    <button type="submit" class="btn btn-primary btn-block">
                        استعادة
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12 text-center">
            <p><a href="{{route('admin.login')}}" class="text-muted ml-1">العودة الى تسجيل الدخول</a></p>
        </div>
    </div>
@endsection
