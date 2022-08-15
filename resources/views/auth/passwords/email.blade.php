@extends('layouts.home')

@section('content')
    <div class="container-fluid gradient-bg page-header">
        <h2 class="border-bottom fw-bold mb-3 mx-auto pb-2 w-25"> اعادة تعين كلمة المرور</h2>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a class="text-white" href="{{route('home')}}">الرئيسية</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    <a class="text-white" href="{{url()->full()}}"> اعادة تعين كلمة المرور </a>
                </li>
            </ol>
        </nav>
    </div>


    <section class="auth-form">
        <div class="container">
            <div class="col-12 col-md-8 shadow m-5 mx-auto p-5 text-center ">
                <h3 class="m-2">هل نسيت كلمة المرور؟</h3>
                <h5 class="mb-5">لا تقلق، سوف نعيد تعينها الأن...</h5>


                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        <p class="mb-0">{{ session('status') }}</p>
                    </div>
                @endif


                <p class="text-center">سيتم إرسال رسالة عبر البريد الإلكتروني، قم بالضغط على الرابط المرفق داخل الرسالة
                    لإعادة
                    تعيين كلمة المرور</p>

                <form class="d-inline text-center" method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="input-group w-50 mx-auto  mb-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                               placeholder="البريد الإلكتروني" name="email" value="{{ old('email') }}"
                               required autocomplete="email">
                        @error('email')
                        <span class="invalid-feedback text-start"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <button class="btn btn-outline-primary  rounded-0 border-end-0 border-start-0 px-4 py-2"
                            type="submit">ارسال رابط اعادة تعين كلمة المرور
                    </button>
                </form>

            </div>
        </div>
    </section>

@endsection
