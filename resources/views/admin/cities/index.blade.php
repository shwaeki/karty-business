@extends('layouts.admin')



@section('content')
    <div class="card shadow">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="right">
                    <h2>قائمة المدن </h2>
                </div>
                <div class="left">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        اضافة مدينة جديدة
                    </button>
                </div>
            </div>
            <form>
                <div class="input-group w-25 mb-3">
                    <input class="form-control" type="search"
                           name="search" value="{{ request('search') }}" placeholder="بحث">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>
            <div class="table-responsive-md">
                <table class="table">
                    <!--title-->
                    <thead>
                    <tr>
                        <th>إسم المدينة</th>
                        <th>سعر خدمة التوصيل</th>
                        <th>خيارات</th>
                    </tr>
                    </thead>

                    <tbody>

                    @foreach($cities as $city)
                        <tr>
                            <td class="font-name">{{$city->name}}</td>
                            <td class="font-name">{{$city->price}}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-warning"
                                        id="edit-item" data-item-id="{{$city->id}}" data-item-name="{{$city->name}}" data-item-price="{{$city->price}}">
                                    تعديل
                                </button>

                                <button id="delete-item" data-item-path="{{route('cities.destroy',['city'=>$city->id])}}"
                                        type="button" class="btn btn-sm btn-danger">
                                    حذف
                                </button>

                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{route('cities.store')}}" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> اضافة مدينة جديدة</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name" class="col-form-label">اسم المدينة</label>
                            <input type="text" name="name" class="form-control" id="name">
                        </div>

                        <div class="form-group">
                            <label for="price" class="col-form-label">سعر خدمة التوصيل</label>
                            <input type="text" name="price" class="form-control" id="price">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        <button type="submit" class="btn btn-primary">اضافة</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="modal fade" id="edit-modal"  role="dialog">
        <div class="modal-dialog">
            <form action="" id="edit-form" method="post">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> تعديل مدينة </h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit-city-name" class="col-form-label">اسم المدينة</label>
                            <input type="text" name="name" class="form-control" id="edit-city-name" required>
                        </div>

                        <div class="form-group">
                            <label for="edit-city-price" class="col-form-label">سعر خدمة التوصيل</label>
                            <input type="number" name="price" class="form-control" id="edit-city-price" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        <button type="submit" class="btn btn-primary">تعديل</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        //Edit

        $(document).on('click', "#edit-item", function () {
            $('#edit-modal').modal('show');
            var id = $(this).data('item-id');
            var name = $(this).data('item-name');
            var price = $(this).data('item-price');
            $('#edit-city-name').val(name);
            $('#edit-city-price').val(price);


            var str = "{{route('cities.update',['city'=> -1 ])}}";
            var url = str.replace("-1", id);
            $('#edit-form').attr('action', url);
            $('#edit-form  option[value="'+id+'"]').hide();

        });


        $('#edit-modal').on('hide.bs.modal', function () {
            $("#edit-form").trigger("reset");
        });




    </script>
@endsection
