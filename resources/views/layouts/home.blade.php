<!doctype html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'كرتي للاعمال')</title>
    <meta name="description" content="@yield('description')">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Mohamad Shwaeki, shwaeki@gmail.com">
    <meta name="keywords" content="كرتي، دعوة زفاف، أعراس، كروت أعراس، تنظيم أعراس، تنسيق أعراس، تصميم كروت">

    <link rel="icon" type="image/x-icon" href="{{asset('images/site/logo.png')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/site/bootstrap-rtl.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/site/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/site/boostrap-style.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cairo&display=swap">

    @stack('styles')
</head>

<body>
<nav class="navbar navbar-light navbar-expand-md shadow py-4">
    <div class="container">

        <a class="navbar-brand d-flex align-items-center" href="{{route('home')}}">
            <img src="{{asset('images/site/logo.png')}}" width="120" height="120" alt="logo">
        </a>

        <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-4">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse flex-grow-0 order-md-first" id="navcol-4">
            <ul class="navbar-nav me-auto mt-3 mt-md-0">
                <li class="nav-item">
                    @guest
                        <a class="nav-link" href="{{route('login')}}">
                            <i class="fas fa-user me-1 d-none d-md-inline-block"></i>تسجيل الدخول
                        </a>
                    @else

                        <div class="dropdown">
                            <a href="#" role="button" class="nav-link" id="dropdownMenuLink" data-bs-toggle="dropdown">
                                <i class="fas fa-user me-1 d-none d-md-inline-block"></i>{{ auth()->user()->name }}
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="{{route('profile')}}">حسابي</a></li>
                                <li><a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">تسجيل خروج</a>
                                </li>

                            </ul>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  class="d-none">
                                @csrf
                            </form>
                        </div>
                    @endguest

                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('favorite') }}">
                        <i class="fas fa-heart me-1 d-none d-md-inline-block"></i> المفضلة
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('shop') }}">
                        <i class="fas fa-store me-1 d-none d-md-inline-block"></i> المتجر
                    </a>
                </li>

                <li class="nav-item d-block d-md-none">
                    <a class="nav-link" href="#">
                        دليل الاستخدام
                    </a>
                </li>
                <li class="nav-item d-block d-md-none">
                    <a class="nav-link" href="#">
                        من نحن
                    </a>
                </li>
                <li class="nav-item d-block d-md-none">
                    <a class="nav-link" href="#">
                        الاسئلة الشائعة
                    </a>
                </li>
            </ul>
        </div>
        <div class="d-none d-md-block">
            <ul class="navbar-nav me-auto">

                <li class="nav-item">
                    <a class="nav-link" href="#">
                       دليل الاستخدام
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                         من نحن
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                       الاسئلة الشائعة
                    </a>
                </li>

            </ul>


        </div>
    </div>
</nav>


<main>
    @yield('content')
</main>


<footer class="text-center">
    <!--    <ul class="list-inline text-white">
            <li class="list-inline-item"><a class="text-white" href="#"> سياسة الخصوصية</a></li>|
            <li class="list-inline-item"><a class="text-white" href="#">تواصل معنا </a></li>|
            <li class="list-inline-item"><a class="text-white" href="#"> من نحن</a></li>|
            <li class="list-inline-item"><a class="text-white" href="#">الاسئلة شائعة </a></li>
        </ul>-->

    <ul class="list-inline opacity-75 p-3 m-0">
        <li class="list-inline-item btn border-primary me-4">
            <a class="text-primary" href="https://wa.me/00970593505290">
                <i class="fab fa-whatsapp fs-5"></i>
            </a>
        </li>
        <li class="list-inline-item btn border-primary me-4">
            <a class="text-primary" href="https://instagram.com/karty.ps">
                <i class="fab fa-instagram fs-5"></i>
            </a>
        </li>
        <li class="list-inline-item btn border-primary">
            <a class="text-primary" href="https://www.facebook.com/KartyOfficial">
                <i class="fab fa-facebook-f fs-5"></i>
            </a>
        </li>
    </ul>
    <div class="bg-primary p-3">
        <p class="text-white m-0">جميع الحقوق محفوظة لموقع كرتي © 2020 </p>

    </div>
</footer>


<script src="{{ asset('js/designer/jquery.js') }}"></script>
<script src="{{asset('js/site/bootstrap.bundle.js')}}"></script>
<script src="{{ asset('js/designer/sweetalert2@11.js') }}"></script>
<script src="{{asset('js/site/custom.js')}}"></script>

<script>

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    function addToFavorite(id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "{{route('card.ajaxLike')}}",
            data: {
                "_token": "{{ csrf_token() }}",
                "id": id
            },
            success: function (data) {
                $('#favorite_count').html(data.FCOunt);
                if (data.Pstatus == "add") {
                    $("#favorite_p_" + id + " i").css("color", "#ec9dab");
                    Toast.fire({
                        icon: 'success',
                        title: 'تم اضافة الكرت الى المفضلة'
                    });
                    console.log('تم اضافة الكرت الى المفضلة');
                } else {
                    $("#favorite_p_" + id + " i").css("color", "#999");
                    Toast.fire({
                        icon: 'success',
                        title: 'تم حذف الكرت من المفضلة'
                    });
                    console.log('تم حذف الكرت من المفضلة');
                }
            },
            error: function (xhr) {
                if (xhr.status == 401) {
                    window.location.href = '{{route('login')}}';
                }
            }
        });

    }

</script>


@stack('scripts')


</body>
</html>
