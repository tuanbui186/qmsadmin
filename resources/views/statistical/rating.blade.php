@extends('layouts.master')
@section('content')

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content">
    <!-- PAGE TITLE -->
    <div class="page-title">
        <h2><span class="fa fa-cogs"></span>THỐNG KÊ ĐÁNH GIÁ</small></h2>
</div>
        <!-- END PAGE TITLE -->
<div class="row">
<div class="col-md-12">

    <div class="panel panel-default">
        <div class="panel-body">
            <p>Chọn điểm giao dịch</p>
            <form class="form-horizontal">
                <div class="form-group">
                    <div class="col-md-6">
                        <input class="form-control" placeholder="Nhập tên đánh giá cần tìm"></input>
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
<table class="table" id="tbRating">
    <thead>
        <tr>
            <th>Mã giao dịch</th>
            <th>Người đánh giá</th>
            <th>Điểm đánh giá</th>
            <th>Góp ý</th>
            <th>Thời điểm đánh giá</th>
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
    getRating();
    $("#modalCustomer").on('show.bs.modal', function (event) {          
          var button = $(event.relatedTarget);
          var customerId = button.data('customerid');                 
          getCustomer(customerId);
    });
    function getRating(){
        var NOT_DEFINE = "-";
        var url = '../statistical/get-rating';             
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
                        $("#tbRating").DataTable().destroy();
                        $("#tbRating tbody").empty();
                        let i = 1;      
                        let marks = "";    
                        let comment = "";             
                        let reviewed_tst = "";
                        let full_name = "";
                        $.each (data, function (key, item){
                        if(item['marks'] === null || item['marks'] == ""){
                            marks = NOT_DEFINE;
                        }else{
                            marks = item['marks'];
                        }  

                        if(item['comment'] === null || item['comment'] == ""){
                            comment = NOT_DEFINE;
                        }else{
                            comment = item['comment'];
                        } 

                        if(item['reviewed_tst'] === null || item['reviewed_tst'] == ""){
                            reviewed_tst = NOT_DEFINE;
                        }else{
                            reviewed_tst = item['reviewed_tst'];
                        } 
                        if(item['full_name'] === null || item['full_name'] == ""){
                            full_name = NOT_DEFINE;
                        }else{
                            full_name = item['full_name'];
                        }                                                          
                        let html = "<tr>"+
                                        // "<td>"+i+"</td>"+
                                        "<td>"+item['id']+"</td>"+
                                        "<td><a style='cursor: pointer' data-toggle='modal' data-target='#modalCustomer' data-customerid='"+item['customerId']+"'>"+full_name+"</a></td>"+                                                                                
                                        "<td>"+marks+"</td>"+
                                        "<td>"+comment+"</td>"+                                        
                                        "<td>"+reviewed_tst+"</td>"+                                        
                                    "</tr>";
                            i++;   
                            $("#tbRating tbody").append(html);
                        });   
                        $("#tbRating").DataTable();     
                    }
                },
                error: function(){
                    console.log("Lỗi lấy dữ liệu đánh giá");
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
                    let gender = "";                 
                    if(data.errorCode !== 0 ){
                        console.log("Không có dữ liệu");
                    }else{
                        if(data.data.gender === "1"){
                            gender = "Nam";
                        }else if(data.data.gender === "0"){
                            gender = "Nữ";
                        }
                        $("#cusName").text(data.data.fullName);          
                        $("#cusGender").text(gender);
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
    $('#tbRating').DataTable();
} );
</script>
@endsection