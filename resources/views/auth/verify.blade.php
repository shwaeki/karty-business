@extends('layouts.home')
@section('content')
    <div class="container-fluid gradient-bg page-header">
        <h2 class="border-bottom fw-bold mb-3 mx-auto pb-2 w-25"> تاكيد الحساب</h2>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a class="text-white" href="{{route('home')}}">الرئيسية</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    <a class="text-white" href="{{url()->full()}}"> تاكيد الحساب </a>
                </li>
            </ol>
        </nav>
    </div>


    <section class="auth-form">
        <div class="container">
            <div class="col-12 col-md-8 shadow m-5 mx-auto p-5 text-center ">
                <h3 class="m-2 border-bottom pb-3">نشكرك على إنضمامك لعائلة كرتي</h3>

                <h2 class="mb-5">تاكيد الحساب</h2>

                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        <p class="mb-0">تم إرسال رابط تحقق جديد إلى عنوان بريدك الإلكتروني.</p>
                    </div>
                @endif

                <p class="text-center"> قبل المتابعة ، يرجى التحقق من بريدك الإلكتروني للحصول على رابط التحقق. إذا لم تتلق البريد الإلكتروني ،
                    <br>إذا لم تستلم البريد الإلكتروني,</p>

                <form class="d-inline text-center" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button class="btn btn-outline-primary  rounded-0 border-end-0 border-start-0 px-4 py-2"
                            type="submit"> انقر هنا لطلب آخر
                    </button>
                </form>

            </div>
        </div>
    </section>

@endsection


