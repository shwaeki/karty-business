@extends('layouts.home')
@section('title','كرتي - المفضلة')

@section('content')
    <div class="container-fluid gradient-bg page-header  m-section">
        <h2 class="border-bottom fw-bold mb-3 mx-auto pb-2 w-25">المفضلة </h2>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a class="text-white" href="{{route('home')}}">الرئيسية</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    <a class="text-white" href="{{url()->full()}}"> المفضلة</a>
                </li>
            </ol>
        </nav>
    </div>



    <section class=" m-section pb-5">
        <div class="container">


            <div class="row g-5">
                <div class="col-12 col-md-6">
                    <div class="mb-5 text-center">
                        <h6 class="mb-3 fw-bold text-primary">صمم <i class="fas fa-heart"></i>&nbsp;الأن</h6>
                    </div>

                    @foreach($likes as $like)
                        <div class="d-flex mb-2 shadow">
                            <img src="{{ $like->Card->images()->first()->image_path }}" width="200" height="150"
                                 alt="."/>
                            <div class="w-100  align-self-center p-3">
                                <div class="row">
                                    <div class="col-12">
                                        #{{$like->Card->name}}
                                    </div>

                                    <div class="col-12 mb-3">
                                        {{$like->Card->description}}
                                    </div>

                                    <div class="col-12">
                                        <a href="{{route('product',['id'=>$like->Card->id])}}" class="btn btn-primary">
                                            <i class="fas fa-paint-brush"></i> صمم الأن
                                        </a>
                                    </div>
                                </div>

                            </div>
                            <button class="btn h-100 rounded-0" id="delete-item-design"
                                    data-item-id="{{$like->Card->id}}">
                                <i class="fas fa-trash"></i>
                            </button>

                        </div>
                    @endforeach


                </div>

                <div class="col-12 col-md-6">
                    <div class="mb-5 text-center">
                        <h6 class="mb-3 fw-bold text-primary">أكمل <i class="fas fa-heart"></i>&nbsp;التصميم</h6>
                    </div>
                    @foreach($designs as $design)
                        <div class="d-flex mb-2 shadow">
                            <img src="{{ $design->Card->images()->first()->image_path }}" width="200" height="150"
                                 alt="."/>
                            <div class="w-100  align-self-center p-3">
                                <div class="row">
                                    <div class="col-12">
                                        #{{$design->Card->name}}
                                    </div>

                                    <div class="col-12 mb-3">
                                        {{$design->Card->description}}
                                    </div>

                                    <div class="col-12">
                                        <a href="{{route('design',['id'=>$design->Card->id])}}" class="btn btn-primary">
                                            <i class="fas fa-paint-brush"></i>أكمل التصميم
                                        </a>
                                    </div>
                                </div>

                            </div>
                            <button class="btn h-100 rounded-0" id="delete-item-design"
                                    data-item-id="{{$design->Card->id}}">
                                <i class="fas fa-trash"></i>
                            </button>

                        </div>
                    @endforeach

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

            // حذف الاعجاب
            $(document).on('click', "#delete-item", function () {
                var id = $(this).data('item-id');
                var str = "{{route('card.destroyLike', -1 )}}";
                var url = str.replace("-1", id);
                $('#delete-form').attr('action', url);

                Swal.fire({
                    title: 'هل أنت متأكد ؟',
                    text: "بعد الحذف لا يمكن إستعادة التصميم، ويجب البدأ من جديد !",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'نعم، انا متأكد',
                    cancelButtonText: 'لا'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#delete-form').submit();
                    }
                });

            });

            // حذف التصميم
            $(document).on('click', "#delete-item-design", function () {
                var id = $(this).data('item-id');
                var str = "{{route('card.destroyLike', ['id'=>-1, 'type'=>'html'] )}}";
                var url = str.replace("-1", id);
                $('#delete-form').attr('action', url);

                Swal.fire({
                    title: 'هل أنت متأكد ؟',
                    text: "بعد الحذف لا يمكن إستعادة التصميم، ويجب البدأ من جديد !",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'نعم، انا متأكد',
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
