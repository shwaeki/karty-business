<section class="m-section">
    <div class="container">

        <form wire:submit.prevent="checkout">
            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="mb-5 text-center">
                        <h6 class="mb-3 fw-bold text-primary">المعلومات <i class="fas fa-user"></i>&nbsp;الشخصية</h6>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <input type="text" class="form-control"
                                           placeholder="الإسم الرباعي" value="{{ auth()->user()->name }}" readonly
                                           required>
                                </div>

                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <input type="email" class="form-control"
                                           placeholder="البريد الإلكتروني" value="{{ auth()->user()->name }}" readonly
                                           required>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <input type="text" class="form-control "
                                           placeholder="رقم الهاتف" value="{{ auth()->user()->phone }}" readonly
                                           required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-5 text-center">
                        <h6 class="mb-3 fw-bold text-primary">المعلومات <i class="fas fa-truck"></i>&nbsp;التوصيل</h6>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <select class="form-control form-select" data-default="المحافظة" required
                                            {{auth()->user()->City ? 'readonly' : ''}}  wire:model="city">
                                        <option selected value="">إختار مدينتك</option>
                                        @foreach($cities as $city)
                                            <option
                                                {{auth()->user()->city == $city->id ? 'selected' : '' }} data-cost="{{$city->price}}"
                                                value="{{$city->id}}">{{$city->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="العنوان"
                                           value="{{ old('address', auth()->user()->address) }}" wire:model="address"
                                           {{auth()->user()->address ? 'readonly' : ''}} required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-5 text-center">
                        <h6 class="mb-3 fw-bold text-primary">المعلومات <i class="fas fa-heart"></i>&nbsp;الطلب</h6>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="quantity" class="form-label">عدد البطاقات:</label>
                                    <input type="number" class="form-control" step="50" value="50" id="quantity"
                                           wire:model="quantity" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 align-self-end">
                                <div class="mb-3 text-start">
                                    <div class="input-group">
                                        <input type="text" class="form-control mb-0" placeholder="كوبون الخصم"
                                               wire:model="coupon">
                                        <button wire:click="applyCode" class="btn btn-primary" type="button">تطبيق
                                        </button>
                                    </div>
                                    @if ($coupon_error)
                                        <p class="small mb-0 text-danger">
                                            الكود المستخدم غير صالح
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-5 text-center">
                        <h6 class="mb-3 fw-bold text-primary">ملاحظات <i class="fas fa-comment-alt"></i>&nbsp;اضافية
                        </h6>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <input type="text" class="form-control login-inputs" wire:model="notes"
                                           placeholder="شفاف، عادي، تأجيل الطباعة ...">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12  col-md-4 ps-0 ps-md-5 ">
                    <div class="mb-5 text-center">
                        <h6 class="mb-3 fw-bold text-primary">ملخص <i class="fas fa-cart-plus"></i>&nbsp;الطلبية</h6>

                        <div class="row mb-3 pb-3 border-bottom border-primary">
                            <div class="col-6 text-start">
                                <img src="{{ $card->image_path }}" height="100px" width="100px"/>
                            </div>
                            <div class="col-6 align-self-center ">
                                <h5>#{{$card->name}}</h5>
                                <h5>{{$card->discount_price}}₪</h5>
                            </div>
                        </div>

                    <div class="row mb-3 pb-3 border-bottom border-primary">
                        <div class="col-6">
                            <h5 class="text-start">سعر البطاقات:</h5>
                        </div>
                        <div class="col-6">
                            <h5>₪{{$subtotal}}</h5>
                        </div>
                    </div>

                    @if ($coupon_error === false && $coupon_discount > 0)
                        <div class="row mb-3 pb-3 border-bottom border-primary">
                            <div class="col-6">
                                <h5 class="text-start">كوبون الخصم:</h5>
                            </div>
                            <div class="col-6">
                                <h5>₪{{($coupon_discount/100) * $subtotal }}</h5>
                            </div>
                        </div>
                    @endif

                    @isset($deliveryCost)
                        <div class="row mb-3 pb-3 border-bottom border-primary">
                            <div class="col-6">
                                <h5 class="text-start">تكلفة التوصيل:</h5>
                            </div>
                            <div class="col-6">
                                <h5>₪{{$deliveryCost}}</h5>
                            </div>
                        </div>
                    @endisset

                    <div class="row mb-3 pb-3 border-bottom border-primary">
                        <div class="col-6">
                            <h5 class="text-start">المجموع:</h5>
                        </div>
                        <div class="col-6">
                            <h5>₪{{$total}}</h5>
                        </div>
                    </div>

                    <div class="row mb-3 pb-3 border-bottom border-primary">
                        <div class="col-6">
                            <h5 class="text-start">طريقة الدفع:</h5>
                        </div>
                        <div class="col-6">
                            <select class="form-control form-select" wire:model="payment" required>
                                <option value="cash" selected>الدفع عند الإستلام</option>
                                <option value="jawwalpay">جوال باي | Jawwal Pay</option>
                                <option value="paypal">باي بال | paypal</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3 pb-3">
                        <div class="col-12 mb-3  pb-3 border-bottom border-primary text-start">
                            <input class="form-check-input" type="checkbox" id="accept" required>
                            <label class="form-check-label" for="accept">
                                أوافق على <a href="#"> شروط الإستخدام </a> و <a href="#">سياسة الخصوصية</a>
                            </label>

                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary w-100" type="submit">شراء</button>
                        </div>
                    </div>

                </div>
            </div>

    </div>
    </form>
    </div>
</section>
