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
        <li><a href="../transaction/<?php echo $employee_id; ?>">Giao dịch</a></li>
        <li><a href="../rating/<?php echo $employee_id; ?>" class="active">Đánh giá</a></li>
        <li><a href="../time-working/<?php echo $employee_id; ?>">Thời gian làm việc</a></li>
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
<script>
$( function() {
    $( ".datepicker" ).datepicker();
} );
</script>
<script>
var url = window.location.pathname;
var employeeId = url.substring(url.lastIndexOf('/') + 1);
var dateFrom = $("#dateFrom").val();
var dateTo = $("#dateTo").val();

getInfoEmployee();
getDataRatingEmployee(dateFrom, dateTo);
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
                                        "<td>"+item['reviewed_tst']+"</td>"+
                                        "<td>"+item['customerId']+"</td>"+
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
</script>
<script>
$(document).ready( function () {
    $('#tbTransactionEmployee').DataTable();
} );
</script>
@endsection