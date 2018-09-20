@extends('layouts.master')
@section('content')
    <!-- PAGE CONTENT -->
<script src="{{ URL::asset('public/js/jquery-3.1.1.min.js')}}"></script>
<script src="{{ URL::asset('public/js/highcharts.js')}}"></script>
<script src="{{ URL::asset('public/js/highcharts-more.js')}}"></script>
<script src="{{ URL::asset('public/js/exporting.js')}}"></script>
<script src="{{ URL::asset('Highcharts-6.1.0/code/highcharts.js')}}"></script>
<script src="{{ URL::asset('Highcharts-6.1.0/code/modules/series-label.js')}}"></script>
<script src="{{ URL::asset('Highcharts-6.1.0/code/modules/exporting.js')}}"></script>
    <!-- PAGE CONTENT -->

<div class="page-content">
    <div id="menu">
        <?php 
            $string = $_SERVER['REQUEST_URI'];
            $last_word_start = strrpos($string, '/') + 1; 
            $employee_id = substr($string, $last_word_start); 
        ?>
        <ul>
            <li><a href="{{route('getEmployeeManager')}}"><i class="fa fa-arrow-left"></i>Quản lý nhân viên</a></li>
            <li><a href="../summary/<?php echo $employee_id; ?>" class="active">Tổng kết</a></li>
            <!-- <li><a href="../transaction/<?php echo $employee_id; ?>">Giao dịch</a></li> -->
            <!-- <li><a href="../rating/<?php echo $employee_id; ?>">Đánh giá</a></li> -->
            <li><a href="../time-working/<?php echo $employee_id; ?>">Thời gian làm việc</a></li>
            <li><a href="../account-manager/<?php echo $employee_id; ?>">Quản lý tài khoản</a></li>
        </ul>
    </div>        
        <h2 style="text-align: center; font-weight: bold;" id="nameEmployee"></h2>
        <h3 style="text-align: center"><img src="{{ URL::asset('public/csrs-admin-template/img/star.png')}}" height="50px" width="50px"/><span class="centered" id="markEmployee"></span></h3>        
      <!-- Chart -->
    <div class="row">
            <div class="col-md-6 col-lg-6 col-xs-12">
                <div id="container"></div>        
                <div class="row">
                    <div style="text-align: center">
                        <button class="btn btn-primary" id="plain">Biểu đồ cột dọc</button>
                        <button class="btn btn-danger" id="inverted">Biểu đồ cột ngang</button>
                        <!-- <button class="btn btn-default" id="polar">Biểu đồ tròn</button> -->
                    </div>
                </div>                
            </div>
        <!-- Transaction Chart -->
            <div class="col-md-6 col-lg-6 col-xs-12">
                <div id="containerTrans" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
            </div>
        <!-- End Transaction Chart -->    
    </div>
    <hr>
    <div class="row">
        <div class="col-md-6 col-lg-6 col-xs-12">
            <div style="text-align: center">
                <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#showmore">Chi tiết đánh giá</button>
            </div>
            <div id="showmore" class="collapse">
                <center><h2><span style="color: blue; font-size: 20px;" class="text-center">BẢNG ĐÁNH GIÁ NHÂN VIÊN</span></center>
                <?php   
                    $day=date("d");
                    $month=date("m");
                    $year=date("Y");                                                
                ?>            
                <div class="row" style="font-size: 14px">
                    <div class="col-md-4">
                        <label >Từ ngày: </label> <input class="form-control-static datepicker" type="text" value="<?php print $year."-".$month."-01"; ?>" id="dateFrom"></input>
                    </div>
                    <div class="col-md-4">
                        <label> Đến ngày: </label> <input class="form-control-static datepicker" type="text" value="<?php print $year."-".$month."-".($day + 1); ?>" id="dateTo"></input>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-success glyphicon glyphicon-search" style="width: 100px" id="btnSearch"> Tìm</button>
                    </div>
                </div>
                <table class="table tab-content" id="tbRatingEmployee">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Ngày</th>
                            <th>Người đánh giá</th>
                            <th>Điểm đánh giá</th>  
                            <th>Lý do</th>
                        </tr>
                    </thead>
                    <tbody>        
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xs-12l">                   
        <!-- Danh sách giao dịch -->         
        <div style="text-align: center">
            <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#showTransaction">Chi tiết thống kê</button>
        </div>
        <div id="showTransaction" class="collapse">
            <center><h2><span style="color: blue; font-size: 20px;" class="text-center">BẢNG THỐNG KÊ GIAO DỊCH NHÂN VIÊN</span></center>
            <?php   
                $day=date("d");
                $month=date("m");
                $year=date("Y");                                                
            ?>
            <div class="row" style="font-size: 14px">
                <div class="col-md-4">
                    <label >Từ ngày: </label> <input class="datepicker form-control-static" type="text" value="<?php print $year."-".$month."-01"; ?>" id="dateFromTrans"></input>
                </div>
                <div class="col-md-4">
                    <label> Đến ngày: </label> <input class="datepicker form-control-static" type="text" value="<?php print $year."-".$month."-".($day + 1); ?>" id="dateToTrans"></input>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-success glyphicon glyphicon-search" style="width: 100px" id="btnSearchTrans"> Tìm</button>
                </div>
            </div>
            <br>
            <table class="table tab-content" id="tbTransactionEmployee">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Ngày</th>
                        <th>Mã giao dịch</th>
                        <th>Người đánh giá</th>
                        <th>Dịch vụ</th>
                        <th>Thời gian(s)</th>
                    </tr>
                </thead>
                <tbody>   
                </tbody>
            </table>
        </div>
        </div>
    </div>
</div>

    <!-- END PAGE CONTENT -->
<script>
    var url = window.location.pathname;
    var id = url.substring(url.lastIndexOf('/') + 1);
    getChartAverageScore();
    getChartTrans();
    getInfoEmployee();  
    getMarkEmployee();
    
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
                alert("Không có dữ liệu");
            }
            },
            error: function(){
                alert("Lỗi lấy biểu đồ");
            }
        });
    }
    function getChartTrans(){
        Highcharts.chart('containerTrans', {
            chart: {
                type: 'spline'
            },
            title: {
                text: 'BIỂU ĐỒ THỐNG KÊ GIAO DỊCH NHÂN VIÊN'
            },
            subtitle: {
                text: 'Dựa trên thời gian giao dịch'
            },
            xAxis: {
                type: 'datetime',
                dateTimeLabelFormats: { // don't display the dummy year
                    month: '%e. %b',
                    year: '%b'
                },
                title: {
                    text: 'Date'
                }
            },
            yAxis: {
                title: {
                    text: 'Thời gian giao dịch (s)'
                },
                min: 0
            },
            tooltip: {
                headerFormat: '<b>{series.name}</b><br>',
                pointFormat: '{point.x:%e. %b}: {point.y:.2f} s'
            },

            plotOptions: {
                spline: {
                    marker: {
                        enabled: true
                    }
                }
            },

            colors: ['#6CF', '#39F', '#06C', '#036', '#000'],

            // Define the data points. All series have a dummy year
            // of 1970/71 in order to be compared on the same x axis. Note
            // that in JavaScript, months start at 0 for January, 1 for February etc.
            series: [{
                name: "Dịch vụ Thanh toán",
                data: [
                    [Date.UTC(1970, 10, 25), 0],
                    [Date.UTC(1970, 11,  6), 0.25],
                    [Date.UTC(1970, 11, 20), 1.41],
                    [Date.UTC(1970, 11, 25), 1.64],
                    [Date.UTC(1971, 0,  4), 1.6],
                    [Date.UTC(1971, 0, 17), 2.55],
                    [Date.UTC(1971, 0, 24), 2.62],
                    [Date.UTC(1971, 1,  4), 2.5],
                    [Date.UTC(1971, 1, 14), 2.42],
                    [Date.UTC(1971, 2,  6), 2.74],
                    [Date.UTC(1971, 2, 14), 2.62],
                    [Date.UTC(1971, 2, 24), 2.6],
                    [Date.UTC(1971, 3,  1), 2.81],
                    [Date.UTC(1971, 3, 11), 2.63],
                    [Date.UTC(1971, 3, 27), 2.77],
                    [Date.UTC(1971, 4,  4), 2.68],
                    [Date.UTC(1971, 4,  9), 2.56],
                    [Date.UTC(1971, 4, 14), 2.39],
                    [Date.UTC(1971, 4, 19), 2.3],
                    [Date.UTC(1971, 5,  4), 2],
                    [Date.UTC(1971, 5,  9), 1.85],
                    [Date.UTC(1971, 5, 14), 1.49],
                    [Date.UTC(1971, 5, 19), 1.27],
                    [Date.UTC(1971, 5, 24), 0.99],
                    [Date.UTC(1971, 5, 29), 0.67],
                    [Date.UTC(1971, 6,  3), 0.18],
                    [Date.UTC(1971, 6,  4), 0]
                ]
            }, {
                name: "Dịch vụ Internet",
                data: [
                    [Date.UTC(1970, 10,  9), 0],
                    [Date.UTC(1970, 10, 15), 0.23],
                    [Date.UTC(1970, 10, 20), 0.25],
                    [Date.UTC(1970, 10, 25), 0.23],
                    [Date.UTC(1970, 10, 30), 0.39],
                    [Date.UTC(1970, 11,  5), 0.41],
                    [Date.UTC(1970, 11, 10), 0.59],
                    [Date.UTC(1970, 11, 15), 0.73],
                    [Date.UTC(1970, 11, 20), 0.41],
                    [Date.UTC(1970, 11, 25), 1.07],
                    [Date.UTC(1970, 11, 30), 0.88],
                    [Date.UTC(1971, 0,  5), 0.85],
                    [Date.UTC(1971, 0, 11), 0.89],
                    [Date.UTC(1971, 0, 17), 1.04],
                    [Date.UTC(1971, 0, 20), 1.02],
                    [Date.UTC(1971, 0, 25), 1.03],
                    [Date.UTC(1971, 0, 30), 1.39],
                    [Date.UTC(1971, 1,  5), 1.77],
                    [Date.UTC(1971, 1, 26), 2.12],
                    [Date.UTC(1971, 3, 19), 2.1],
                    [Date.UTC(1971, 4,  9), 1.7],
                    [Date.UTC(1971, 4, 29), 0.85],
                    [Date.UTC(1971, 5,  7), 0]
                ]
            }, {
                name: "Dịch vụ chăm sóc khách hàng",
                data: [
                    [Date.UTC(1970, 9, 15), 0],
                    [Date.UTC(1970, 9, 31), 0.09],
                    [Date.UTC(1970, 10,  7), 0.17],
                    [Date.UTC(1970, 10, 10), 0.1],
                    [Date.UTC(1970, 11, 10), 0.1],
                    [Date.UTC(1970, 11, 13), 0.1],
                    [Date.UTC(1970, 11, 16), 0.11],
                    [Date.UTC(1970, 11, 19), 0.11],
                    [Date.UTC(1970, 11, 22), 0.08],
                    [Date.UTC(1970, 11, 25), 0.23],
                    [Date.UTC(1970, 11, 28), 0.37],
                    [Date.UTC(1971, 0, 16), 0.68],
                    [Date.UTC(1971, 0, 19), 0.55],
                    [Date.UTC(1971, 0, 22), 0.4],
                    [Date.UTC(1971, 0, 25), 0.4],
                    [Date.UTC(1971, 0, 28), 0.37],
                    [Date.UTC(1971, 0, 31), 0.43],
                    [Date.UTC(1971, 1,  4), 0.42],
                    [Date.UTC(1971, 1,  7), 0.39],
                    [Date.UTC(1971, 1, 10), 0.39],
                    [Date.UTC(1971, 1, 13), 0.39],
                    [Date.UTC(1971, 1, 16), 0.39],
                    [Date.UTC(1971, 1, 19), 0.35],
                    [Date.UTC(1971, 1, 22), 0.45],
                    [Date.UTC(1971, 1, 25), 0.62],
                    [Date.UTC(1971, 1, 28), 0.68],
                    [Date.UTC(1971, 2,  4), 0.68],
                    [Date.UTC(1971, 2,  7), 0.65],
                    [Date.UTC(1971, 2, 10), 0.65],
                    [Date.UTC(1971, 2, 13), 0.75],
                    [Date.UTC(1971, 2, 16), 0.86],
                    [Date.UTC(1971, 2, 19), 1.14],
                    [Date.UTC(1971, 2, 22), 1.2],
                    [Date.UTC(1971, 2, 25), 1.27],
                    [Date.UTC(1971, 2, 27), 1.12],
                    [Date.UTC(1971, 2, 30), 0.98],
                    [Date.UTC(1971, 3,  3), 0.85],
                    [Date.UTC(1971, 3,  6), 1.04],
                    [Date.UTC(1971, 3,  9), 0.92],
                    [Date.UTC(1971, 3, 12), 0.96],
                    [Date.UTC(1971, 3, 15), 0.94],
                    [Date.UTC(1971, 3, 18), 0.99],
                    [Date.UTC(1971, 3, 21), 0.96],
                    [Date.UTC(1971, 3, 24), 1.15],
                    [Date.UTC(1971, 3, 27), 1.18],
                    [Date.UTC(1971, 3, 30), 1.12],
                    [Date.UTC(1971, 4,  3), 1.06],
                    [Date.UTC(1971, 4,  6), 0.96],
                    [Date.UTC(1971, 4,  9), 0.87],
                    [Date.UTC(1971, 4, 12), 0.88],
                    [Date.UTC(1971, 4, 15), 0.79],
                    [Date.UTC(1971, 4, 18), 0.54],
                    [Date.UTC(1971, 4, 21), 0.34],
                    [Date.UTC(1971, 4, 25), 0]
                ]
            }]
        });
    }
    function convertTime(datetime){
        var date = new Date(Date.parse(datetime));
        var hours = "0" + date.getHours();
        var minutes = "0" + date.getMinutes();
        var seconds = "0" + date.getSeconds();function getInfoEmployee(){           
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
                    alert("Không có dữ liệu");
                }
            },
            error: function(){
                alert("Lỗi lấy thông tin người dùng");
            }
        });
    }
        var d = date.getDate();
        var m = date.getMonth() + 1;
        var y = date.getFullYear();
        var timerp = hours.substr(-2) + ':' + minutes.substr(-2) + ':' + seconds.substr(-2);
        var daterp = d + '/' + m + '/' + y;
        var newDateTime = timerp + ', ' + daterp;
        return newDateTime;
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
                    alert("Không có dữ liệu");
                }
            },
            error: function(){
                alert("Lỗi lấy thông tin người dùng");
            }
        });
    }
    function getMarkEmployee(){
        var url = '../get-mark-employee';
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
                    //  alert(JSON.stringify(data));
                    $.each (data, function (key, item) {        
                        mark = parseFloat(item['marks']);
                        $('#markEmployee').text(mark.toFixed(1));
                    });
                }
                else {
                    alert("Không có dữ liệu");
                }
            },
            error: function(){
                $.notify('Lỗi lấy thông tin điểm người dùng', {type: 'danger', icon:'close'})
            }
        });
    }
    var url = window.location.pathname;
    var employeeId = url.substring(url.lastIndexOf('/') + 1);
    var dateFrom = $("#dateFrom").val();
    var dateTo = $("#dateTo").val();
    var dateFromTrans = $("#dateFromTrans").val();
    var dateToTrans = $("#dateToTrans").val();
    getInfoEmployee();
    getDataRatingEmployee(dateFrom, dateTo);
    search();
    getDataTransactionEmployee(dateFromTrans, dateToTrans);
    searchTrans();

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
            data: {employeeId: employeeId},
            dataType : 'JSON',
            success: function(data){
                if(data != null) {
                    // alert(JSON.stringify(data));
                    $.each (data, function (key, item) {
                        $('#nameEmployee').text(item['full_name']);
                    });
                }
                else {
                    alert("Không có dữ liệu");
                }
            },
            error: function(){
                $.notify('Lỗi lấy dữ liệu thông tin nhân viên', {type: 'danger', icon:'close'});
            }
        });
    }
    function getDataRatingEmployee(dateFrom, dateTo){    
        var url = '../get-data-rating';
        let NOT_DEFINE = "-";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            type:'GET',
            data: {employeeId: employeeId, dateFrom: dateFrom, dateTo: dateTo},
            dataType : 'JSON',
            success: function(data){               
                // console.log(data);
                if(data != null || data != "") { 
                    $("#tbRatingEmployee").DataTable().destroy();                                       
                    $("#tbRatingEmployee tbody").empty();
                    let i = 1;       
                    let comment = "";
                    
                        $.each (data, function (key, item) {
                        if(item['comment'] === null || item['comment'] === ""){
                            comment = NOT_DEFINE;
                        } else{
                            comment = item['comment'];
                        }
                        let html = "<tr>" +
                                        "<td>"+i+"</td>"+
                                        "<td>"+item['start_tst']+"</td>"+
                                        "<td>"+item['customerName']+"</td>"+
                                        "<td>"+item['marks']+"</td>"+
                                        "<td>"+comment+"</td>"+
                                    "</tr>";
                            $("#tbRatingEmployee tbody").append(html);
                            i++;
                        });
                        $("#tbRatingEmployee").DataTable();
                }else {
                    $.notify('Không có dữ liệu', {type: 'warning', icon:'exclamation'});
                }
            },
            error: function(){
                $.notify('Lỗi lấy dữ liệu', {type: 'danger', icon:'close'})
            }
        });
    }
    function search(){
        $('#btnSearch').click(function () {     
                var dateFrom = $('#dateFrom').val();
                var dateTo = $('#dateTo').val();
                getDataRatingEmployee(dateFrom, dateTo);
        });
    }
    function getDataTransactionEmployee(dateFromTrans, dateToTrans){    
        var url = '../get-data-transaction-employee';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            type:'GET',
            data: {employeeId: employeeId, dateFrom: dateFrom, dateTo: dateTo},
            dataType : 'JSON',
            success: function(data){
                if(data != null) {
                    console.log(JSON.stringify(data));
                    $("#tbTransactionEmployee").DataTable().destroy();
                    $("#tbTransactionEmployee tbody").empty();
                    let i = 1;
                    $.each (data, function (key, item) {
                       let html = "<tr>" +
                                    "<td>"+i+"</td>"+
                                    "<td>"+item['start_tst']+"</td>"+                                    
                                    "<td>"+item['id']+"</td>"+
                                    "<td>"+item['customerName']+"</td>"+
                                    "<td>"+item['name']+"</td>"+
                                    "<td>"+item['process_time']+"</td>"+
                                "</tr>";
                        $("#tbTransactionEmployee tbody").append(html);
                        i++;
                    });
                    $("#tbTransactionEmployee").DataTable(); 
                }
                else {
                    $.notify('Không có dữ liệu', {type: 'warning', icon:'exclamation'});
                }
            },
            error: function(){
                $.notify('Lỗi lấy dữ liệu thông tin dữ liệu giao dịch', {type: 'danger', icon:'close'})
                
            }
        });
    }
    function searchTrans(){
        $('#btnSearchTrans').click(function () {     
            var dateFromTrans = $('#dateFromTrans').val();
            var dateToTrans = $('#dateToTrans').val();
            getDataTransactioEmployee(dateFromTrans, dateToTrans);
        });
    }
</script>
<script>
$(document).ready( function () {
    $('#tbTransactionEmployee').DataTable();
   
});
</script>
@endsection