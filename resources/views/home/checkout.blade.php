@extends('layouts.home')


@push('styles')
    @livewireStyles
@endpush



@section('content')

    @if ($errors->any())
        <div style=" text-align: center; margin-bottom: 20px; color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    @if(Session::has('massage'))
        <div style=" text-align: center; margin-bottom: 20px; color: #6073ff;">
            {{Session::get('massage')}}
        </div>
    @endif



    <div wire:loading.delay class="z-50 static flex fixed left-0 top-0 bottom-0 w-full bg-gray-400 bg-opacity-50">
        <img src="https://paladins-draft.com/img/circle_loading.gif" width="64" height="64" class="m-auto mt-1/4">
    </div>

    <div class="container-fluid gradient-bg page-header  m-section">
        <h2 class="border-bottom fw-bold mb-3 mx-auto pb-2 w-25">إتمام الشراء </h2>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a class="text-white" href="{{route('home')}}">الرئيسية</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    <a class="text-white" href="{{url()->full()}}"> إتمام الشراء</a>
                </li>
            </ol>
        </nav>
    </div>



    <livewire:checkout-component :card="$card"/>


@endsection

@push('scripts')
    @livewireScripts
@endpush
