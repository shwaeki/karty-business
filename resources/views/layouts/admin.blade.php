<!doctype html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="utf-8"/>
    <title>كرتي للاعمال - لوحة التحكم</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="author" content="Mohamad Shwaeki, shwaeki@gmail.com">

    <link rel="icon" type="image/x-icon" href="{{asset('images/site/logo.png')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/site/bootstrap-rtl.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/site/boostrap-style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/admin/app-rtl.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cairo&display=swap">
</head>

<body>
<div id="wrapper">
    <div class="navbar-custom d-block d-md-none">

        <ul class="list-unstyled topnav-menu topnav-menu-left mb-0">
            <li>
                <button class="button-menu-mobile disable-btn waves-effect">
                    <i class="fas fa-bars"></i>
                </button>
            </li>
        </ul>
    </div>


    <div class="left-side-menu shadow gradient-bg">

            <div class="slimscroll-menu">

            <div class="d-none d-md-block text-center">
                <img src="{{ asset('images/site/logo.png') }}" alt="logo" height="75">
            </div>
            <div class="text-center bg-primary py-2 my-2">

                <h5 class="m-2">مرحبا، {{ auth('admin')->user()->name }} </h5>

            </div>
            <div id="sidebar-menu">

                <ul class="metismenu" id="side-menu">

                    <li class="menu-title">لوحة التحكم</li>
                    @if( auth('admin')->user()->isAdmin())
                        <li>
                            <a href="{{route('admin')}}">
                                <i class="fas fa-home"></i>
                                <span> الرئيسية </span>
                            </a>
                        </li>
                    @endif
                    <li>
                        <a href="#">
                            <i class="mdi mdi-format-font"></i>
                            <span> قائمة الطلبات </span>
                            <span class="menu-arrow"></span>
                            <ul class="nav-second-level" aria-expanded="false">
                                @if( auth('admin')->user()->isAdmin())
                                    <li><a href="{{route('orders.index',['page'=>'Preparation'])}}">طلبات جديدة</a></li>
                                @endif
                                @if( auth('admin')->user()->isAdmin() || auth('admin')->user()->isPrinter())
                                    <li><a href="{{route('orders.index',['page'=>'Printing'])}}">قيد الطباعة</a></li>
                                @endif
                                @if( auth('admin')->user()->isAdmin() || auth('admin')->user()->isDelivery())
                                    <li><a href="{{route('orders.index',['page'=>'Delivering'])}}">قيد التوصيل</a></li>
                                @endif
                                @if( auth('admin')->user()->isAdmin() || auth('admin')->user()->isDelivery())
                                    <li><a href="{{route('orders.index',['page'=>'Delivered'])}}">تم التوصيل </a></li>
                                @endif
                                @if( auth('admin')->user()->isAdmin() || auth('admin')->user()->isDelivery())
                                    <li><a href="{{route('orders.index',['page'=>'NotReceived'])}}">لم يتم الاستلام </a>
                                    </li>
                                @endif
                            </ul>
                        </a>
                    </li>

                    @if( auth('admin')->user()->isAdmin())

                        <li>
                            <a href="{{route('cards.index')}}">
                                <i class="far fa-address-card"></i>
                                <span> قائمة الكروت </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{route('fonts.index')}}">
                                <i class="fas fa-font"></i>
                                <span> الخطوط </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{route('icons.index')}}">
                                <i class="fas fa-grip-horizontal"></i>
                                <span> الأيقونات </span>
                            </a>
                        </li>


                        <li>
                            <a href="{{route('accounts.index')}}">
                                <i class="fas fa-users"></i>
                                <span> إدارة الحسابات </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('categories.index')}}">
                                <i class="fas fa-tags"></i>
                                <span> قائمة الفئات </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('cities.index')}}">
                                <i class="fas fa-city"></i>
                                <span> قائمة المدن </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('coupons.index')}}">
                                <i class="fas fa-percent"></i>
                                <span> قائمة الكوبونات </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-images"></i>
                                <span> قائمة الصفحات</span>
                            </a>
                        </li>
                    @endif
                    <li class="menu-title"> حسابي</li>

                    <li>
                        <a href="{{route('settings')}}">
                            <i class="fas fa-user-cog"></i>
                            <span>  اعدادات الحساب </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="fas fa-power-off"></i>
                            <span>تسجيل خروج</span>
                        </a>

                    </li>

                </ul>

            </div>
            <!-- End Sidebar -->

            <div class="clearfix"></div>

        </div>
    </div>



    <div class="content-page ">

        @if(Session::has('massage'))
            <div class="alert alert-info rounded-0 my-3" role="alert">
                {{Session::get('massage')}}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger rounded-0 my-3">
                <ul class="mb-0 ml-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <div class="mt-4">
            @yield('content')
        </div>
    </div>
</div>


<div class="modal fade" id="delete-modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-right">
                    <button type="button" class="btn-close" data-dismiss="modal"></button>
                </div>
                <div class="text-center">
                    <h3>هل انت متاكد؟</h3>
                    <p>هل انت متاكد انك ترغب في حذف هذه العنصر؟!</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    اغلاق
                </button>
                <form action="" id="delete-form" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger">حذف</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="  {{ asset('js/admin/vendor.min.js') }}"></script>
<script src="  {{ asset('js/admin/app.min.js') }}"></script>

<script>
    //Delete
    $(document).on('click', "#delete-item", function () {
        $('#delete-modal').modal('show');
        var url = $(this).data('item-path');
        $('#delete-form').attr('action', url);
    });

    $('#delete-modal').on('hide.bs.modal', function () {
        $("#delete-form").trigger("reset");
    });

</script>
@yield('scripts')

</body>
</html>
