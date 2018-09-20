@extends('layouts.master')
@section('content')

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content">
    <!-- PAGE TITLE -->
    <div class="page-title">
        <h2><span class="fa fa-cogs"></span>THỐNG KÊ GIAO DỊCH</small></h2>
</div>
        <!-- END PAGE TITLE -->
<div class="row">
<div class="col-md-12">

    <div class="panel panel-default">
        <div class="panel-body">
            <p>Tìm kiếm giao dịch theo mã giao dịch</p>
            <form class="form-horizontal">
                <div class="form-group">
                    <div class="col-md-6">
                        <input class="form-control" placeholder="Nhập mã giao dịch cần tìm" name="txtTransactionId"></input>
                    </div>
                    <div class="col-md-3 right">
                        <button class="btn btn-success">Tìm kiếm</button>
                    </div>
                    <div class="col-md-3 right">                        
                        <button class="btn btn-primary"><i class="fa fa-download"></i>Xuất báo cáo</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

</div>
<div class="row">
<table class="table" id="tbTrans">
    <thead>
        <tr>           
            <th>Mã giao dịch</th>
            <th>Tên nhân viên</th>            
            <th>Số điện thoại khách hàng</th>
            <th>Tên khách hàng</th>
            <th>Tên dịch vụ</th>
            <th>Quầy giao dịch</th>
            <th>Số lấy phiếu</th>
            <th>Thời điểm bắt đầu giao dịch</th>
            <th>Thời điểm kết thúc giao dịch</th>
            <th>Thời gian xử lý giao dịch(giây)</th>
            <th>Thời gian chờ giao dịch(giây)</th>        
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<!-- END PAGE CONTENT WRAPPER -->
    <!-- Start Customer Modal -->        
    <div class="modal fade " tabindex="-1" id="modalCustomer" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="color: #6256a9; font-weight: bold">Thông tin khách hàng </h4>
                </div>
                <div class="modal-body">
                    <div class="col-md-6 col-xs-12"> Họ và tên:</div><div class="col-md-6 col-xs-12" id="cusName"></div>
                    </br>
                    <div class="col-md-6 col-xs-12"> Giới tính: </div><div class="col-md-6 col-xs-12" id="cusGender"></div>
                    </br>
                    <div class="col-md-6 col-xs-12"> Email: </div><div class="col-md-6 col-xs-12" id="cusEmail"></div>
                    </br>
                    <div class="col-md-6 col-xs-12"> Số điện thoại: </div><div class="col-md-6 col-xs-12" id="cusPhone"></div>
                    </br>
                    <div class="col-md-6 col-xs-12"> Địa chỉ: </div><div class="col-md-6 col-xs-12" id="cusAddress"></div>                
                    </br>
                <!--div style="font-size:10px;"-->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng lại</button>
                <!-- <button type="button" class="btn btn-primary" id="btnDelEmployee">Đồng ý</button> -->
            </div>
        </div>
    </div>
    <!-- End Customer Modal --> 
</div>
<script>
$(document).ready(function() {
    getTransaction();
    $("#modalCustomer").on('show.bs.modal', function (event) {          
          var button = $(event.relatedTarget);
          var customerId = button.data('customerid');                 
          getCustomer(customerId);
    });
    function getTransaction(){
        var NOT_DEFINE = "-";
        var url = '../statistical/get-transactions';             
                $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });
              $.ajax({
                url: url,
                type:'GET',        
                dataType : 'json',
                success: function(data){  
                    console.log(JSON.stringify(data));
                    if (data == ""){
                        console.log("Không có dữ liệu");
                    }else{
                        $("#tbTrans").DataTable().destroy();
                        $("#tbTrans tbody").empty();
                        let i = 1;     
                        let start_tst = "";    
                        let end_tst = "";             
                        let process_time = "";
                        $.each (data, function (key, item){
                        if(item['start_tst'] === null || item['start_tst'] == ""){
                            start_tst = NOT_DEFINE;
                        }else{
                            start_tst = item['start_tst'];
                        }  

                        if(item['end_tst'] === null || item['end_tst'] == ""){
                            end_tst = NOT_DEFINE;
                        }else{
                            end_tst = item['end_tst'];
                        } 

                        if(item['process_time'] === null || item['process_time'] == ""){
                            process_time = NOT_DEFINE;
                        }else{
                            process_time = item['process_time'];
                        }  

                        if(item['wait_time'] === null || item['wait_time'] == ""){
                            wait_time = NOT_DEFINE;
                        }else{
                            wait_time = item['wait_time'];
                        }   
                        let html = "<tr>"+                                        
                                        "<td>"+item['id']+"</td>"+
                                        "<td><a href='../summary/"+item['employeeId']+"'>"+item['employeeName']+"</a></td>"+
                                        "<td>"+item['phone']+"</td>"+
                                        "<td><a style='cursor: pointer' data-toggle='modal' data-target='#modalCustomer' data-customerid='"+item['customerId']+"'>"+item['customerName']+"</a></td>"+                                                                                                                      
                                        "<td>"+item['serviceName']+"</td>"+
                                        "<td>"+item['counterName']+"</td>"+
                                        "<td>"+item['ticket_number']+"</td>"+
                                        "<td>"+start_tst+"</td>"+
                                        "<td>"+end_tst+"</td>"+
                                        "<td>"+process_time+"</td>"+
                                        "<td>"+wait_time+"</td>"+                                        
                                    "</tr>";
                            i++;   
                            $("#tbTrans tbody").append(html);
                        });   
                        $("#tbTrans").DataTable();     
                    }
                },
                error: function(){
                    console.log("Lỗi lấy dữ liệu giao dịch");
                }
        });
    }
    function getCustomer(customerId){        
        var url = '../get-customer';                     

            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type:'GET',  
                data: {customerId: customerId},
                dataType : 'json',
                success: function(data){                
                    if(data.errorCode !== 0 ){
                        console.log("Không có dữ liệu");
                    }else{
                        // console.log("--------------------------------");                        
                        // console.log(JSON.stringify(data));
                        var cusGender = "";                        
                        if(data.data.gender === "1"){
                            cusGender = "Nam";
                        }else if(data.data.gender === "0"){
                            cusGender = "Nữ";
                        }
                        
                        $("#cusName").text(data.data.fullName);          
                        $("#cusGender").text(cusGender);
                        $("#cusEmail").text(data.data.email);
                        $("#cusPhone").text(data.data.phone);
                        $("#cusAddress").text(data.data.address);
                    }                                            
                },
                error: function(){
                    console.log("Lỗi lấy dữ liệu khách hàng");
                }
            });
    }
});
</script>
<script>
$(document).ready( function () {
    $('#tbTrans').DataTable();
} );
</script>
@endsection