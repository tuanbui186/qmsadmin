@extends('layouts.master')
@section('content')
    <!-- PAGE CONTENT -->
<script src="{{ URL::asset('public/js/jquery-3.1.1.min.js')}}"></script>
<script src="{{ URL::asset('public/js/highcharts.js')}}"></script>
<script src="{{ URL::asset('public/js/highcharts-more.js')}}"></script>
<script src="{{ URL::asset('public/js/exporting.js')}}"></script>
    <!-- PAGE CONTENT -->

    <div class="page-content">
    <div id="menu">
        <ul>
            <li><a href="{{URL::to('/detail-employee/NV000001')}}" class="active">Tổng kết</a></li>
            <li><a href="{{URL::to('/transaction')}}">Giao dịch</a></li>
            <li><a href="{{URL::to('/rating')}}">Đánh giá</a></li>
            <li><a href="{{URL::to('/time-working')}}">Thời gian làm việc</a></li>
            <li><a href="{{URL::to('/account-manager')}}">Quản lý tài khoản</a></li>
        </ul>
    </div>
        <h2 style="text-align: center" id="nameEmployee"></h2>
        <h3 style="text-align: center"><img src="{{ URL::asset('public/csrs-admin-template/img/star.png')}}" height="50px" width="50px"/><span class="centered">5</span></h3>
      <!-- Chart -->
        <div id="container"></div>
        <div class="row">
            <div style="text-align: center">
                <button class="btn btn-primary" id="plain">Biểu đồ cột dọc</button>
                <button class="btn btn-danger" id="inverted">Biểu đồ cột ngang</button>
                <button class="btn btn-default" id="polar">Biểu đồ tròn</button>
            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT -->
<script>
    var url = window.location.pathname;
    var id = url.substring(url.lastIndexOf('/') + 1);
    getChartAverageScore();
    getInfoEmployee();  
//    setInterval(getChartAverageScore, 15000);
//    setInterval(getAttendanceEmployee, 15000);

    function getChartAverageScore() { 
            var url = '../get-chart-average-score';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type:'GET',
                data: {employeeId: id},
                dataType : 'JSON',
                success: function(data){
                    if(data != null) {
//                        alert(JSON.stringify(data));
                        var chart = Highcharts.chart('container', {

                            title: {
                                text: 'ĐIỂM ĐÁNH GIÁ TRUNG BÌNH THEO THÁNG'
                            },

                            subtitle: {
                                text:""
                            },

                            xAxis: {
                                categories: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12']
                            },

                            series: [{
                                type: 'column',
                                colorByPoint: true,
                                data: data,
                                showInLegend: false
                            }]
                        });


                        $('#plain').click(function () {
                            chart.update({
                                chart: {
                                    inverted: false,
                                    polar: false
                                },
                                subtitle: {
                                    text: 'Plain'
                                }
                            });
                        });

                        $('#inverted').click(function () {
                            chart.update({
                                chart: {
                                    inverted: true,
                                    polar: false
                                },
                                subtitle: {
                                    text: 'Inverted'
                                }
                            });
                        });

                        $('#polar').click(function () {
                            chart.update({
                                chart: {
                                    inverted: false,
                                    polar: true
                                },
                                subtitle: {
                                    text: 'Polar'
                                }
                            });
                        });
                    }
                    else {
                        $.notify('Không có dữ liệu', {type: 'warning', icon:'exclamation'})
                    }
                },
                error: function(){
                    $.notify('Lỗi lấy dữ liệu biểu đồ', {type: 'danger', icon:'close'})
                }
            });
    }
    function convertTime(datetime){
        var date = new Date(Date.parse(datetime));
        var hours = "0" + date.getHours();
        var minutes = "0" + date.getMinutes();
        var seconds = "0" + date.getSeconds();
        var d = date.getDate();
        var m = date.getMonth() + 1;
        var y = date.getFullYear();
        var timerp = hours.substr(-2) + ':' + minutes.substr(-2) + ':' + seconds.substr(-2);
        var daterp = d + '/' + m + '/' + y;
        var newDateTime = timerp + ', ' + daterp;
        return newDateTime;
    }
    function getiii(){
        alert("fsdjfosadjfios");
    }
    function getInfoEmployee(){           
        var url = '../get-info-employee';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            type:'GET',
            data: {employeeId: id},
            dataType : 'JSON',
            success: function(data){
                if(data != null) {
                    // alert(JSON.stringify(data));
                    $.each (data, function (key, item) {
                        $('#nameEmployee').text(item['full_name']);
                    });
                }
                else {
                    $.notify('Không có dữ liệu', {type: 'warning', icon:'exclamation'})
                }
            },
            error: function(){
                $.notify('Lỗi lấy dữ liệu nhân viên', {type: 'danger', icon:'close'})
            }
        });
    }
</script>
@endsection