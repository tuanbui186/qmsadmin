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
<?php 
    $string = $_SERVER['REQUEST_URI'];
    $last_word_start = strrpos($string, '/') + 1; 
    $employee_id = substr($string, $last_word_start); 
?>
    <ul>
        <li><a href="{{route('getEmployeeManager')}}"><i class="fa fa-arrow-left"></i>Quản lý nhân viên</a></li>
        <li><a href="../summary/<?php echo $employee_id; ?>">Tổng kết</a></li>
        <!-- <li><a href="../transaction/<?php echo $employee_id; ?>">Giao dịch</a></li> -->
        <!-- <li><a href="../rating/<?php echo $employee_id; ?>">Đánh giá</a></li> -->
        <li><a href="../time-working/<?php echo $employee_id; ?>" class="active">Thời gian làm việc</a></li>
        <li><a href="../account-manager/<?php echo $employee_id; ?>">Quản lý tài khoản</a></li>
    </ul>
</div>
    <br>
    <div class="text-center">
        <!-- <img src="{{ URL::asset('public/csrs-admin-template/assets/employees/employee_woman.png')}}" height="50px" width="50px"/> -->
        <span style="font-size:18px; font-weight: bold" id="nameEmployee"></span>
    </div>
    <br>
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
    <br>
    <table class="table tab-content" id="tbTimeWorking">
        <thead>
            <tr>
                <th>STT</th>
                <th>Ngày</th>
                <th>Đăng nhập đầu tiên</th>
                <th>Đăng xuất giao dịch cuối</th>
                <th>Thời gian (giây)</th>
            </tr>
        </thead>
        <tbody>            
        </tbody>
    </table>

</div>
<!-- END PAGE CONTENT -->
<script>
$( function() {
    $( "#datepickerFrom" ).datepicker();
    $( "#datepickerTo" ).datepicker();
} );
</script>
<script>
var url = window.location.pathname;
var employeeId = url.substring(url.lastIndexOf('/') + 1);
var dateFrom = $("#dateFrom").val();
var dateTo = $("#dateTo").val();

getInfoEmployee();
getDataTimeWorkingEmployee(dateFrom, dateTo);
search();
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
                alert("Lỗi lấy thông tin người dùng");
            }
        });
    }
    function getDataTimeWorkingEmployee(dateFrom, dateTo){    
        var url = '../get-data-time-working';
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
                    $("#tbTimeWorking").DataTable().destroy(); 
                    $("#tbTimeWorking tbody").empty();
                    let i = 1;
                    $.each (data, function (key, item) {
                        // Time start converter
                        var dateStart = new Date(Date.parse(item['start_tst']));
                        var hoursStart = "0" + dateStart.getHours();
                        var minutesStart = "0" + dateStart.getMinutes();
                        var secondsStart = "0" + dateStart.getSeconds();
                        var dStart = dateStart.getDate();
                        var mStart = dateStart.getMonth() + 1;
                        var yStart = dateStart.getFullYear();
                        var timeStart = hoursStart.substr(-2) + ':' + minutesStart.substr(-2) + ':' + secondsStart.substr(-2);                        
                        var dateStart = dStart + '/' + mStart + '/' + yStart; 

                        var a = timeStart.split(':'); // split it at the colons
                        // minutes are worth 60 seconds. Hours are worth 60 minutes.
                        var secondsStart = (+a[0]) * 60 * 60 + (+a[1]) * 60 + (+a[2]);                         
                        // Time end converter
                        var dateEnd = new Date(Date.parse(item['end_tst']));
                        var hoursEnd = "0" + dateEnd.getHours();
                        var minutesEnd = "0" + dateEnd.getMinutes();
                        var secondsEnd = "0" + dateEnd.getSeconds();
                        var dEnd = dateEnd.getDate();
                        var mEnd = dateEnd.getMonth() + 1;
                        var yEnd = dateEnd.getFullYear();
                        var timeEnd = hoursEnd.substr(-2) + ':' + minutesEnd.substr(-2) + ':' + secondsEnd.substr(-2);
                        var dateEnd = dEnd + '/' + mEnd + '/' + yEnd;           

                        var a = timeEnd.split(':'); // split it at the colons                       
                        var secondsEnd = (+a[0]) * 60 * 60 + (+a[1]) * 60 + (+a[2]);  // minutes are worth 60 seconds. Hours are worth 60 minutes.
                        var second = secondsEnd - secondsStart;
                        let html = "<tr>" +
                                    "<td>"+i+"</td>"+
                                    "<td>"+dateStart+"</td>"+
                                    "<td>"+dateStart+" "+ timeStart+"</td>"+
                                    "<td>"+dateEnd+" "+timeEnd+"</td>"+
                                    "<td>"+second+"</td>"+
                                "</tr>";
                        $("#tbTimeWorking tbody").append(html);
                        i++;
                    });
                    $("#tbTimeWorking").DataTable();
                }
                else {
                    console.log("Không có dữ liệu");
                }
            },
            error: function(){
                console.log("Lỗi lấy thông tin dữ liệu giao dịch");
            }
        });
    }
    function search(){
        $('#btnSearch').click(function () {     
                var dateFrom = $('#dateFrom').val();
                var dateTo = $('#dateTo').val();
                getDataTimeWorkingEmployee(dateFrom, dateTo);
            });
    }
</script>
@endsection