@extends('layouts.home')

@section('content')
    <div class="container-fluid gradient-bg page-header">
        <h2 class="border-bottom fw-bold mb-3 mx-auto pb-2 w-25">تسجيل الدخول</h2>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a class="text-white" href="{{route('home')}}">الرئيسية</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    <a class="text-white" href="{{url()->full()}}"> تسجيل الدخول</a>
                </li>
            </ol>
        </nav>
    </div>


    <section class="auth-form">
        <div class="container">
            <div class="col-12 col-md-8 shadow m-5 mx-auto">
                <div id="login-section" class="row">
                    <div class="col-12 col-md-4 align-self-center p-3 border-end">
                        <div class="text-center">
                            <h3>أهلاً وسهلاً بك</h3>
                            <p>إنضم لعائلة كرتي واحصل على تجربة ليس لها مثيل</p>
                            <button class="btn btn-primary" onClick="signUp()">انشاء حساب</button>
                        </div>
                        <hr class="d-block d-md-none gradient">
                    </div>
                    <div class="col-12 col-md-8 text-center p-3">
                        <h2 class="my-4">سجل دخول</h2>
                        <div class="d-flex px-4">


                            <a href="{{ route('social.oauth', 'facebook') }}"
                               class="btn btn-facebook rounded-0 btn-sm p-2 w-100 me-1">
                                <i class="fab fa-facebook-f me-1"></i> الاستمرار باستخدام فيسبوك
                            </a>

                            <a href="{{ route('social.oauth', 'google') }}"
                               class="btn btn-google btn-sm rounded-0 p-2 w-100 ms-1">
                                <i class="fab fa-google me-1"></i>الاستمرار باستخدام جوجل
                            </a>
                        </div>

                        <form method="POST" action="{{ route('login') }}" class="p-4">
                            @csrf
                            <input type="hidden" name="type" value="login">


                            <div class="input-group  mb-3">
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                       placeholder="البريد الإلكتروني" name="email" value="{{ old('email') }}"
                                       required autocomplete="email">
                                @error('email')
                                <span class="invalid-feedback text-start"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="input-group  mb-3">
                                <input type="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       placeholder=" كلمة المرور" name="password" required>
                                @error('password')
                                <span class="invalid-feedback text-start"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <a class="text-center d-block mb-4 text-black-50"
                               href="{{route('password.request')}}">هل نسيت كلمة المرور ؟</a>


                            <button class="btn btn-outline-primary  rounded-0 border-end-0 border-start-0 px-4 py-2"
                                    type="submit">تسجيل الدخول
                            </button>
                        </form>
                    </div>
                </div>
                <div id="register-section" class="row" style="display: none;">
                    <div class="col-12 col-md-4 align-self-center p-3 border-end">
                        <div class="text-center">
                            <h3>أهلاً وسهلاً بك</h3>
                            <p>سجل دخول بإستخدام معلومات حسابك الشخصية</p>
                            <button class="btn btn-primary" onClick="logIn()">تسجيل دخول</button>
                        </div>
                        <hr class="d-block d-md-none gradient">
                    </div>
                    <div class="col-12 col-md-8 text-center p-3">
                        <h2 class="my-4">انشاء حساب</h2>
                        <div class="d-flex px-4">
                            <a href="{{ route('social.oauth', 'facebook') }}"
                               class="btn btn-facebook rounded-0 btn-sm p-2 w-100 me-1">
                                <i class="fab fa-facebook-f me-1"></i>الاستمرار باستخدام فيسبوك
                            </a>

                            <a href="{{ route('social.oauth', 'google') }}"
                               class="btn btn-google btn-sm rounded-0 p-2 w-100 ms-1">
                                <i class="fab fa-google me-1"></i>الاستمرار باستخدام جوجل
                            </a>
                        </div>

                        <form method="POST" action="{{ route('register') }}" class="p-4">
                            @csrf
                            <input type="hidden" name="type" value="register">

                            <div class="input-group  mb-3">
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                       placeholder="البريد الإلكتروني" name="email" value="{{ old('email') }}"
                                       required autocomplete="email">
                                @error('email')
                                <span class="invalid-feedback text-start"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="input-group  mb-3">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               placeholder="الإسم الرباعي" name="name" value="{{ old('name') }}"
                                               required>

                                        @error('name')
                                        <span class="invalid-feedback text-start"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="input-group  mb-3">
                                        <input type="text" class="form-control  @error('phone') is-invalid @enderror"
                                               placeholder="رقم الهاتف" name="phone" value="{{ old('phone') }}"
                                               required>
                                        @error('phone')
                                        <span class="invalid-feedback text-start"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="input-group  mb-3">
                                        <select class="form-control form-select @error('city') is-invalid @enderror"
                                                name="city" data-default="المحافظة"
                                                required>
                                            <option value="none" selected disabled hidden>المحافظة</option>
                                            @foreach($cities as $city)
                                                <option
                                                    {{old('city')== $city->id ? 'selected' : '' }} value="{{$city->id}}">{{$city->name}}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('city')
                                        <span class="invalid-feedback text-start"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="input-group  mb-3">
                                        <input type="text" class="form-control @error('password') is-invalid @enderror"
                                               placeholder="العنوان" name="address" value="{{ old('address') }}"
                                               required>
                                        @error('address')
                                        <span class="invalid-feedback text-start"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="input-group  mb-3">
                                        <input type="password"
                                               class="form-control  @error('password') is-invalid @enderror"
                                               placeholder="كلمة المرور" name="password" required>
                                        @error('password')
                                        <span class="invalid-feedback text-start"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="password" class="form-control mb-3"
                                           placeholder="تأكيد كلمة المرور" name="password_confirmation" required>
                                </div>
                            </div>


                            <button class="btn btn-outline-primary  rounded-0 border-end-0 border-start-0 px-4 py-2"
                                    type="submit">إنشاء حساب
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection


@push('scripts')
    <script>
        function signUp() {

            $('#login-section').fadeOut(400, function () {
                $('#register-section').fadeIn(400);
            });
        }

        function logIn() {

            $('#register-section').fadeOut(400, function () {
                $('#login-section').fadeIn(400);
            });
        }


        @if(isset($register) || old('type','login') === 'register')
        signUp();
        @endif
    </script>
@endpush
