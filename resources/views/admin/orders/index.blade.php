@extends('layouts.admin',['title'=>'قائمة الطلبات'])

@section('content')


    <div class="row">
        <div class="col-xl-12">
            <div class="card-box">

                <h4 class="header-title mt-0 mb-3">الطلبات</h4>

                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <!--title-->
                        <thead>
                        <tr>
                            <th>#</th> <!-- رقم الطلب -->
                            <th>إسم الزبون</th>
                            <th>تاريخ الطلب</th>
                            <th>عدد الكروت</th>
                            <th>التكلفة الاجمالية</th>
                            <th>حالة الطلب</th>
                            <th>طريقة الدفع</th>
                            <th></th>
                        </tr>
                        </thead>

                        @php
                            $status =[
                            'Preparation' => ['badge-warning','قيد الإنتظار'],
                            'Printing' => ['badge-success','قيد الطباعة'],
                            'Delivering' => ['badge-primary','قيد التوصيل'],
                            'Delivered' => ['badge-success','تم التوصيل'],
                            'NotReceived' => ['badge-danger','لم يتم الاستلام'],
                        ];

                        $payment_status =[
                            'Unpaid' => ['badge-danger','غير مدفوع'],
                            'JawwalPay' => ['badge-success','جوال باي'],
                            'Paypal' => ['badge-success','باي بال'],
                            'CreditCard' => ['badge-success','بطاقة اعتماد'],
                        ];
                        @endphp
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>#{{$order->id}}</td>
                                <td>{{$order->User->name}}</td>
                                <td>{{$order->created_at->toDateString()}}</td>
                                <td>{{$order->quantity}}</td>

                                <td>₪{{$order->cost}}</td>
                                <td>
                                    <span class="badge {{$status[$order->status][0]}}">
                                        {{$status[$order->status][1]}}
                                    </span>
                                </td>

                                {{--                                <td>--}}
                                {{--                                    <span class="badge {{$payment_status[$order->payment_status][0]}}">--}}
                                {{--                                        {{$payment_status[$order->payment_status][1]}}--}}
                                {{--                                    </span>--}}
                                {{--                                </td>--}}
                                <th>

                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                            data-target="#EditModal{{$order->id}}">
                                        تعديل
                                    </button>


                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                            data-target="#InfoModal{{$order->id}}">
                                        التفاصيل
                                    </button>

                                    <a target="_blank" href="{{route('orders.show',['order'=>$order->id])}}"
                                       class="btn btn-sm btn-warning">
                                        طباعة
                                    </a>
                                </th>
                            </tr>

                            <div class="modal fade" id="EditModal{{$order->id}}" tabindex="-1" role="dialog"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <form action="{{ route('orders.update',['order'=>$order->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="{{$order->status}}">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalScrollableTitle">تعديل حالة
                                                    الطلب</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>الرجاء اختيار حالة الطلب الجديدة</p>
                                                <select name="status" class="custom-select" required>
                                                    <option
                                                        value="Preparation" {{ $order->status == 'Preparation' ? 'selected' : '' }}>
                                                        قيد التحضير
                                                    </option>
                                                    <option
                                                        value="Printing" {{ $order->status == 'Printing' ? 'selected' : '' }}>
                                                        قيد الطباعة
                                                    </option>
                                                    <option
                                                        value="Delivering" {{ $order->status == 'Delivering' ? 'selected' : '' }}>
                                                        قيد التوصيل
                                                    </option>
                                                    <option
                                                        value="Delivered" {{ $order->status == 'Delivered' ? 'selected' : '' }}>
                                                        تم التوصيل
                                                    </option>
                                                    <option
                                                        value="NotReceived" {{ $order->status == 'NotReceived' ? 'selected' : '' }}>
                                                        لم يتم الاستلام
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">
                                                    اغلاق
                                                </button>

                                                <button type="submit" class="btn btn-danger">
                                                    تاكيد
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="modal fade" id="InfoModal{{$order->id}}" tabindex="-1" role="dialog"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalScrollableTitle">معلومات الطلب</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group row">
                                                <label for="input1" class="col-sm-3 col-form-label">اسم الزبون</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control form-control-sm"
                                                           value="{{$order->User->name}}" id="input1" disabled>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="input1" class="col-sm-3 col-form-label">رقم الهاتف </label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control form-control-sm"
                                                           value="{{$order->User->phone}}" id="input1" disabled>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label for="input1" class="col-sm-3 col-form-label">عنوان الزبون</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control form-control-sm"
                                                           value="{{$order->User->City->name ?? ''}} - {{$order->User->address}}"
                                                           id="input1" disabled>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label for="input1" class="col-sm-3 col-form-label">اسم الكرت </label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control form-control-sm"
                                                           value="#{{$order->Card->name}}" id="input1" disabled>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="input1" class="col-sm-3 col-form-label">تصنيف الكرت </label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control form-control-sm"
                                                           value="{{$order->Card->Category->name}}" id="input1"
                                                           disabled>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label for="input1" class="col-sm-3 col-form-label">عددالكروت</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control form-control-sm"
                                                           value="{{$order->quantity}}" id="input1" disabled>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label for="input1" class="col-sm-3 col-form-label">التكلفة
                                                    الاجمالية</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control form-control-sm"
                                                           value="{{$order->cost}}" id="input1" disabled>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="input21" class="col-sm-3 col-form-label">طريقة الدفع</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control form-control-sm"
                                                           value="{{$order->payment->payment_method}} - {{$order->payment->payment_status}}"
                                                           id="input21" disabled>
                                                </div>
                                            </div>

                                            @if ($order->transparent)
                                                <div class="form-group row">
                                                    <label for="input13" class="col-sm-3 col-form-label">نوع
                                                        الكرت</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control form-control-sm"
                                                               value="كرت شفاف" id="input1" disabled>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="form-group row">
                                                <label for="input13" class="col-sm-3 col-form-label">ملاحظات
                                                    اضافية</label>
                                                <div class="col-sm-8">
                                                    {{$order->notes}}
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق
                                            </button>
                                            <a href="{{route('orders.edit',['order'=>$order->id])}}"
                                               class="btn btn-primary">تعديل التصميم</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <div class="pagination justify-content-center">
        {{ $orders->links() }}
    </div>

@endsection

