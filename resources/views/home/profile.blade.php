@extends('layouts.home',['wrapper'=>'product-page _padding-top'])
@section('title','كرتي - المعلومات الشخصية')

@php
    $payments = [
    'Paypal' => 'باي بال',
    'JawwalPay' => 'جوال باي',
    'Cash' => 'الدفع عند الاستلام',
   ];
@endphp

@section('content')
    <div class="container-fluid gradient-bg page-header  m-section">
        <h2 class="border-bottom fw-bold mb-3 mx-auto pb-2 w-25">حسابي </h2>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a class="text-white" href="{{route('home')}}">الرئيسية</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    <a class="text-white" href="{{url()->full()}}"> حسابي</a>
                </li>
            </ol>
        </nav>
    </div>


    <section class=" m-section pb-5">
        <div class="container">


            <div class="row g-5">
                <div class="col-12 col-md-9">
                    <div class="mb-5 text-center">
                        <h6 class="mb-3 fw-bold text-primary">تتبع <i class="fas fa-heart"></i>&nbsp;طلبك</h6>
                        <h2 class="fw-bold text-secondary">طلباتي</h2>
                    </div>

                    @foreach($orders as $order)

                        <div class="d-flex mb-2 shadow">
                            <img src="{{$order->Card->images()->first()->image_path}}" width="200" height="150"/>
                            <div class="w-100  align-self-center p-3">
                                <div class="row mb-2">
                                    <div class="col-4">
                                        #{{$order->Card->name}}
                                    </div>
                                    <div class="col-4">
                                        العدد: <span>{{$order->quantity}}
                                    </div>
                                    <div class="col-4">
                                        تاريخ الطلب: <span>{{$order->created_at->toDateString() }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        @if($order->status === "Delivering")
                                           حالة الطلب:  قيد التوصيل
                                        @elseif($order->status === "Printing")
                                           حالة الطلب:  قيد الطباعة
                                        @elseif($order->status === "Preparation")
                                           حالة الطلب:  قيد الإنتظار
                                        @elseif($order->status === "Delivered")
                                           حالة الطلب:  تم التوصيل
                                        @elseif($order->status === "NotReceived")
                                           حالة الطلب:  لم يتم التوصيل
                                        @endif
                                    </div>
                                    <div class="col-4">
                                        المجموع:  {{$order->cost}}₪
                                    </div>
                                    <div class="col-4">
                                        طريقة الدفع:   {{$order->payment->payment_method ?? ''}}
                                    </div>
                                </div>
                            </div>

                            @if($order->payment && $order->payment->payment_status !== "Paid")
                                @if ($order->status === 'Pending' || $order->status === 'Preparation')
                                    <button class="btn h-100 rounded-0" id="delete-item" data-item-id="{{$order->id}}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                @endif
                            @endif

                        </div>
                    @endforeach

                </div>

                <div class="col-12 col-md-3 border-start">
                    <div class="mb-5 text-center">
                        <h6 class="mb-3 fw-bold text-primary">معلومات <i class="fas fa-heart"></i>&nbsp;حسابك</h6>
                        <h2 class="fw-bold text-secondary">حسابي</h2>
                    </div>


                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="input-group  mb-3">
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   placeholder="البريد الإلكتروني" name="email"
                                   value="{{ old('email', auth()->user()->name) }}" required>
                            @error('email')
                            <span class="invalid-feedback text-start"><strong>{{ $message }}</strong>
                            @enderror
                        </div>

                        <div class="input-group  mb-3">
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   placeholder="الإسم الرباعي" name="name"
                                   value="{{ old('name', auth()->user()->name) }}" required>

                            @error('name')
                            <span class="invalid-feedback text-start"><strong>{{ $message }}</strong>
                            @enderror
                        </div>


                        <div class="input-group  mb-3">
                            <input type="text" class="form-control  @error('phone') is-invalid @enderror"
                                   placeholder="رقم الهاتف" name="phone"
                                   value="{{ old('phone', auth()->user()->phone) }}" required>
                            @error('phone')
                            <span class="invalid-feedback text-start"><strong>{{ $message }}</strong>
                            @enderror
                        </div>


                        <div class="input-group  mb-3">
                            <select class="form-control form-select @error('city') is-invalid @enderror"
                                    name="city" data-default="المحافظة"
                                    required>
                                <option value="none" selected disabled hidden>المحافظة</option>
                                @foreach($cities as $city)
                                    <option
                                        {{old('city', auth()->user()->city )== $city->id ? 'selected' : '' }}
                                        value="{{$city->id}}">{{$city->name}}
                                    </option>
                                @endforeach
                            </select>

                            @error('city')
                            <span class="invalid-feedback text-start"><strong>{{ $message }}</strong>
                            @enderror
                        </div>


                        <div class="input-group  mb-3">
                            <input type="text" class="form-control @error('password') is-invalid @enderror"
                                   placeholder="العنوان" name="address"
                                   value="{{ old('address', auth()->user()->address) }}" required>
                            @error('address')
                            <span class="invalid-feedback text-start"><strong>{{ $message }}</strong>
                            @enderror
                        </div>


                        <div class="input-group  mb-3">
                            <input type="password"
                                   class="form-control  @error('password') is-invalid @enderror"
                                   placeholder="كلمة المرور" name="password" required>
                            @error('password')
                            <span class="invalid-feedback text-start"><strong>{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="input-group  mb-3">
                            <input type="password" class="form-control mb-3"
                                   placeholder="تأكيد كلمة المرور" name="password_confirmation" required>
                        </div>

                        <div class="text-center">
                            <button class="btn btn-primary" type="submit">تحديث المعلومات</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </section>


    <form method="POST" id="delete-form" action="">
        @method('DELETE')
        @csrf
    </form>

@endsection

@section('scripts')
    <script>
        $(document).ready(function () {

            @if(Session::has('massage'))
            @if (Session::has('error'))
            Swal.fire(
                'خطا!',
                '{{Session::get('massage')}}',
                'error'
            )
            @else
            Swal.fire(
                'تهانينا',
                '{{Session::get('massage')}}',
                'success'
            )
            @endif
            @endif

            $(document).on('click', "#delete-item", function () {
                var id = $(this).data('item-id');
                var str = "{{route('order.destroy', -1 )}}";
                var url = str.replace("-1", id);
                $('#delete-form').attr('action', url);

                Swal.fire({
                    title: 'هل أنت متأكد ؟',
                    text: "! سوف يتم إلغاء طلبك، لا يمكنك التراجع عند الحذف",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '! نعم، إلغي الطلب',
                    cancelButtonText: 'لا'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#delete-form').submit();
                    }
                });

            });
        })

    </script>
@endsection



