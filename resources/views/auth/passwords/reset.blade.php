@extends('layouts.home',['wrapper'=>'product-page _padding-top'])

@section('content')
    <section class="hero _parallax">
        <div class="hero__decor layer" data-depth="0.15">
            <img src="{{asset('images/site/effects/flowers2.png')}}" alt="flowers">
        </div>
        <div class="hero__img ibg">
            <img class="lazy" data-src="{{asset('images/site/backgrounds/store-background.jpg')}}"
                 src="{{asset('images/site/backgrounds/store-background.jpg')}}" alt="img">
        </div>
        <div class="hero__body container">
            <h1 class="hero__title title-2">
                إستعادة كلمة المرور
            </h1>
            <nav class="breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb__list">
                    <a href="{{route('home')}}">
                        <h5 class="breadcrumb">الرئيسية</h5>
                    </a>
                    <a href="{{url()->full()}}">
                        <h5 class="breadcrumb__item active">إستعادة كلمة المرور</h5>
                    </a>
                </ol>
            </nav>
        </div>
    </section>

    <div class="registr__content _parallax">
        <div class="registr__decor layer" data-depth="0.15">
            <img src="{{asset('images/site/effects/flowers4.png')}}" alt="flowers">
        </div>

        <style>
            .custom-login {
                width: 40%;
                height: 400px;
                margin: 0 auto;
                padding: 30px;
                background: #fff;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            }

            .custom-login .reg-Login {
                width: 100%;
                height: fit-content;
                float: right;
                padding-bottom: 60px;
                border-left: 0px;
            }

            .custom-login .social-Login {
                width: 100%;
                height: fit-content;
                float: left;
                position: relative;
                margin: 35px 0 0 0;
            }

            .custom-login h2 {
                width: 100%;
                margin: 0 0 30px 0;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .custom-login .create-user {
                width: 100%;
                padding: 20px 0 0px 0;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .custom-login input {
                width: 80%;
                height: 30px;
                display: block;
                border-radius: 0px;
                border-bottom: 1px solid #aeaeae;
                text-align: center;
                background-color: transparent;
                margin: 0 auto;
            }

            .custom-login label {
                display: block;
                text-align: center;
                margin: 10px 0 10px 0;
            }

            .custom-login .social-Login ul {
                padding: 5px 10px 0 40px;
            }

            .custom-login .social-Login ul li {
                width: 80%;
                height: 40px;
                margin: 0 auto 10px auto;
            }

            .custom-login .social-Login ul li a {
                color: #fff;
            }

            .custom-login .social-Login ul li i {
                width: 20%;
                height: 100%;
                text-align: center;
                vertical-align: middle;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .custom-login .social-Login ul li a span {
                width: 100%;
                float: right;
                text-align: center;
                margin: -29px 0 0 0;
                font-size: 1vw;
            }

            .custom-login .social-Login .facebook {
                background: #4267B2;
            }

            .custom-login .social-Login .instagram {
                background: #d6249f;
            }

            .custom-login .social-Login .gmail {
                background: #4285F4;
            }

            .custom-login .social-Login:after {
                content: "أو";
                position: absolute;
                right: 48%;
                top: -35%;
                background: #fff;
                border: 1px solid;
                width: 40px;
                text-align: center;
                height: 39px;
                padding: 11px 0 0 0;
                border-radius: 20px;
            }

            .custom-login .reg-Login div:not(:last-child) {
                width: 100%;
                float: right;
                margin-top: 20px;
            }
        </style>

        <div class="custom-login">
            <h2>تعيين كلمة السر</h2>

            @if ($errors->any())
                <div style=" text-align: center; margin-bottom: 20px; color: red;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <div class="reg-Login">

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div>
                        <label>البريد الاكتروني</label>
                        <input type="email" name="email"
                               value="{{ $email ?? old('email') }}" required autocomplete="email"
                               autofocus/>
                    </div>
                    <div>
                        <label>كلمة المرور الجديدة</label>
                        <input type="password" placeholder="أدخل كلمة المرور الجديدة" name="password" required
                               autocomplete="new-password"/>
                    </div>

                    <div>
                        <label>تأكيد كلمة المرور</label>
                        <input type="password" placeholder="أدخل كلمة المرور مرة أخرى"
                               name="password_confirmation" required autocomplete="new-password"/>
                    </div>


                    <div style="
                     width: 100px;
                     display: flex;
                     align-items: center;
                     justify-content: center;
                     margin: 0 auto 0 auto;
                     padding: 30px 0 0 0;
                 ">
                        <input
                            style="width: 100%;cursor: pointer;text-align: center;border: none;background: #ec9dab;color: #fff;"
                            type="submit" value="إستعادة"/>
                    </div>

                </div>
            </form>
        </div>

    </div>

@endsection
