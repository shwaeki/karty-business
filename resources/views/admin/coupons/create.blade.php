@extends('layouts.admin')

@section('content')
    <div class="card shadow">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="right">
                    <h2>اضافة كوبون جديد </h2>
                </div>
            </div>


            <form action="{{ route('coupons.store') }}" method="POST" enctype="multipart/form-data">
                @csrf


                <div class="mb-3">
                    <label for="code" class="form-label">كود الخصم </label>
                    <input type="text" class="form-control @error('code') is-invalid @enderror"
                           placeholder="كود الخصم" name="code" id="code"
                           value="{{ old('code') }}" required>

                    @error('code')
                    <span class="invalid-feedback text-start"><strong>{{ $message }}</strong>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="count" class="form-label">عدد مرات الاستخدام </label>
                    <input type="text" class="form-control @error('count') is-invalid @enderror"
                           placeholder="عدد مرات الاستخدام" name="count" id="count"
                           value="{{ old('count') }}" required>

                    @error('count')
                    <span class="invalid-feedback text-start"><strong>{{ $message }}</strong>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="percentage" class="form-label">نسبة الخصم </label>
                    <input type="number" class="form-control @error('percentage') is-invalid @enderror"
                           placeholder="نسبة الخصم" name="percentage" id="percentage"
                           value="{{ old('percentage') }}" required>

                    @error('percentage')
                    <span class="invalid-feedback text-start"><strong>{{ $message }}</strong>
                    @enderror
                </div>



                <button type="submit" class="btn btn-primary ">حفظ</button>


            </form>
        </div>
    </div>

@endsection

