@extends('layouts.admin',['title'=>'لوحة التحكم'])

@section('content')
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card-box">
                <h4 class="header-title mt-0 mb-4">عدد المستخدمين الجدد</h4>
                <div class="widget-chart-1">
                    <div class="widget-chart-box-1 float-left" dir="ltr">
                        <i class="fas fa-user-plus fa-4x" style="color: #dc9fbc"></i>
                    </div>

                    <div class="widget-detail-1 text-right">
                        <h2 class="font-weight-normal pt-2 mb-1"> {{$today_users_count}} </h2>
                        <p class="text-muted mb-1">المستخدمين الجدد اليوم</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card-box">
                <h4 class="header-title mt-0 mb-4">عدد الطلبات الجدد</h4>
                <div class="widget-chart-1">
                    <div class="widget-chart-box-1 float-left" dir="ltr">
                        <i class="fas fa-plus-square fa-4x" style="color: #dc9fbc"></i>
                    </div>

                    <div class="widget-detail-1 text-right">
                        <h2 class="font-weight-normal pt-2 mb-1"> {{$today_orders_count}} </h2>
                        <p class="text-muted mb-1">الطلبات الجدد اليوم</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card-box">
                <h4 class="header-title mt-0 mb-4">مقدار الدخل الجدد</h4>
                <div class="widget-chart-1">
                    <div class="widget-chart-box-1 float-left" dir="ltr">
                        <i class="fas fa-shekel-sign fa-4x" style="color: #dc9fbc"></i>
                    </div>

                    <div class="widget-detail-1 text-right">
                        <h2 class="font-weight-normal pt-2 mb-1"> ₪{{$today_profits}} </h2>
                        <p class="text-muted mb-1">مقدار الدخل اليوم</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card-box">
                <h4 class="header-title mt-0 mb-4">مقدار الربح الجدد</h4>
                <div class="widget-chart-1">
                    <div class="widget-chart-box-1 float-left" dir="ltr">
                        <i class="fas fa-shekel-sign fa-4x" style="color: #dc9fbc"></i>
                    </div>

                    <div class="widget-detail-1 text-right">
                        <h2 class="font-weight-normal pt-2 mb-1"> ₪{{$today_net_profits}} </h2>
                        <p class="text-muted mb-1">مقدار الربح اليوم</p>
                    </div>
                </div>
            </div>
        </div>

<!--        <div class="col-xl-3 col-md-6">
            <div class="card-box">
                <h4 class="header-title mt-0 mb-4">عدد الطلبات </h4>
                <div class="widget-chart-1">
                    <div class="widget-chart-box-1 float-left" dir="ltr">
                        <i class="fas fa-calendar fa-4x" style="color: #dc9fbc"></i>
                    </div>

                    <div class="widget-detail-1 text-right">
                        <h2 class="font-weight-normal pt-2 mb-1"> {{$orders_count}} </h2>
                        <p class="text-muted mb-1">عدد جميع الطلبات</p>
                    </div>
                </div>
            </div>
        </div>-->

    </div>



    <!-- end row -->
    <div class="row">
        <div class="col-xl-4">
            <div class="card-box">

                <!-- طلبات قيد الإنتظار-->

                <h4 class="header-title mb-3">طلبات قيد الإنتظار</h4>

                <div class="inbox-widget">
                    @foreach($preparation_orders as $order)
                        <div class="inbox-item">
                            <a href="#">
                                <h5 class="inbox-item-author mt-0 mb-1">{{$order->User->name}}</h5>
                                <p class="inbox-item-text">#{{$order->Card->name}}</p>
                                <p class="inbox-item-date">{{$order->created_at->diffForHumans()}}</p>
                            </a>
                        </div>
                    @endforeach
                </div>


            </div>
        </div>


        <!-- طلبات قيد الطباعة -->
        <div class="col-xl-8">
            <div class="card-box">

                <h4 class="header-title mt-0 mb-3">طلبات قيد الطباعة</h4>

                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                        <tr>
                            <th>#</th> <!-- رقم الطلب -->
                            <th>إسم الزبون</th>
                            <th>تاريخ الطلب</th>
                            <th>تاريخ تاكيد الطلب</th>
                            <th>حالة الطلب</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($printing_orders as $order)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$order->User->name}}</td>
                                <td>{{$order->created_at->diffForHumans()}}</td>
                                <td>{{$order->updated_at->diffForHumans()}}</td>
                                <td><span class="badge badge-warning">قيد الطباعة</span></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- end col -->

    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card-box">
                <h4 class="header-title mb-3">مقدار الربح اخر 12 شهر</h4>

                <div class="inbox-widget">
                    <div id="profit_chart" style=" height: 350px"></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card-box">
                <h4 class="header-title mb-3">عدد الطلبات  اخر 12 شهر</h4>

                <div class="inbox-widget" dir="ltr">
                    <div id="ordars_chart" style=" height: 350px"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages': ['corechart']});
        google.charts.setOnLoadCallback(drawProfitChart);

        function drawProfitChart() {
            var data = google.visualization.arrayToDataTable([
                ["Year Month", "Total", {role: "style"}],
                    @foreach($moneyStatistics as $sta)
                ['{{\Carbon\Carbon::parse($sta->created_at)->format("Y M")}}',{{$sta->total}}, "color: #28CFFE"],
                @endforeach
            ]);
            // data.sort([{column: 1}]);
            var options = {
                curveType: 'function',
                legend: {position: 'bottom'}
            };
            var chart = new google.visualization.LineChart(document.getElementById('profit_chart'));
            chart.draw(data, options);
        }


        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawOrdarsChart);

        function drawOrdarsChart() {
            var data = google.visualization.arrayToDataTable([
                ["Year Month", "Ordars", {role: "style"}],
                    @foreach($moneyStatistics as $sta)
                ['{{\Carbon\Carbon::parse($sta->created_at)->format("Y M")}}',{{$sta->ordars}}, "color: #28CFFE"],
                @endforeach
            ]);

            var options = {
                legend: {position: 'bottom'}
            };
            var chart = new google.charts.Bar(document.getElementById('ordars_chart'));
            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>
@endsection
