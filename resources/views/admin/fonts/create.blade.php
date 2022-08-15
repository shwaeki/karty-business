@extends('layouts.admin')

@section('content')
    <div class="card shadow">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="right">
                    <h2>اضافة خط جديد </h2>
                </div>
            </div>


            <form action="{{ route('fonts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf


                <div class="mb-3">
                    <label for="name" class="form-label">إسم الخط</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                           placeholder="إسم الخط" name="name" id="name"
                           value="{{ old('name') }}" required>

                    @error('name')
                    <span class="invalid-feedback text-start"><strong>{{ $message }}</strong>
                    @enderror
                </div>


                <div class="mb-3">
                    <label for="font" class="form-label"> الخط</label>
                    <input type="file" class="form-control  @error('font') is-invalid @enderror"
                           name="font" accept=".tff,.ttf,.otf,.woff" required>
                    @error('font')
                    <span class="invalid-feedback text-start"><strong>{{ $message }}</strong>
                    @enderror
                </div>


                <button type="submit" class="btn btn-primary ">حفظ</button>


            </form>
        </div>
    </div>

@endsection

