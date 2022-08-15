@extends('layouts.home')
@section('title','كرتي - المتجر')

@push('styles')
    @livewireStyles
@endpush



@section('content')
    <div class="container-fluid gradient-bg page-header  m-section">
        <h2 class="border-bottom fw-bold mb-3 mx-auto pb-2 w-25">المتجر </h2>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a class="text-white" href="{{route('home')}}">الرئيسية</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    <a class="text-white" href="{{url()->full()}}"> المتجر</a>
                </li>
            </ol>
        </nav>
    </div>

    <livewire:shop-component :min="$min_price" :max="$max_price"/>


@endsection

@push('scripts')
    @livewireScripts

    <script type="text/javascript">
        var currentScrollHeight = 0;

        $(window).on("scroll", function () {
            const scrollHeight = $(document).height();
            const scrollPos = Math.floor($(window).height() + $(window).scrollTop());
            const isBottom = scrollHeight - 100 < scrollPos;
            if (isBottom && currentScrollHeight < scrollHeight) {
                Livewire.emit('load-more');
                currentScrollHeight = scrollHeight;
            }
        });

    </script>


@endpush
