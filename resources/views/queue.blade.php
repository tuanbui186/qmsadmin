@extends('layouts.master')
@section('content')

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content">
    <!-- PAGE TITLE -->
    <div class="page-title">
        <h2><span class="fa fa-cogs"></span>BẢNG THÔNG TIN XẾP HÀNG</small></h2>
</div>
        <!-- END PAGE TITLE -->
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-body">
                <p>Chọn điểm giao dịch</p>
                <select class="form-control">
                    <option>
                        Tất cả
                    </option>
                    <option>
                        Biên Hòa
                    </option>
                    <option>
                        Xuân Lộc
                    </option>
                </select>
                <!-- <form class="form-horizontal">
                    <div class="form-group">
                        <div class="col-md-8">
                            <input class="form-control" placeholder="Nhập tên đánh giá cần tìm"></input>
                        </div>
                        <div class="col-md-4 right">
                            <button class="btn btn-success">Tìm kiếm</button>
                        </div>
                    </div>
                </form> -->
            </div>
        </div>
    </div>
</div>
<div class="row">
<table class="table" id="tbQueue">
    <thead>
        <tr>
            <th>STT</th>
            <th>Thời gian</th>
            <th>Số phiếu</th>
            <th>Tên dịch vụ</th>
            <th>Khách hàng</th>
            <th>Trạng thái</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>2018-03-20 18:16:39</td>
            <td>5</td>
            <td>Dịch vụ mobifone</td>
            <td>Tuấn</td>
            <td>Chờ phục vụ</td>
        </tr>        
    </tbody>
</table>
<!-- END PAGE CONTENT WRAPPER -->
</div>
<script>
    getQueueList();
    function getQueueList(){
        var url = 'queue';             
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
                        $("#tbQueue").DataTable().destroy();
                        $("#tbQueue tbody").empty();
                        let i = 1;                        
                        let status = "";
                        let time = "";
                        $.each (data, function (key, item){  
                        if(item['status'] === 0){
                            status = "Chờ giao dịch";
                        } else if(item['status' === 1]){
                            status = "Đang gọi số";
                        } else if(item['status'] === 2){
                            status = "Đang giao dịch";
                        } else if(item['status' === 3]){
                            status = "Đóng";
                        }

                        let html = "<tr>"+
                                        "<td>"+i+"</td>"+
                                        "<td>"+item['start_tst']+"</td>"+
                                        "<td>"+item['ticket_number']+"</td>"+
                                        "<td>"+item['service_name']+"</td>"+
                                        "<td>"+item['full_name']+"</td>"+
                                        "<td>"+status+"</td>"+                                                 
                                    "</tr>";
                            i++;   
                            $("#tbQueue tbody").append(html);
                        });   
                        $("#tbQueue").DataTable();     
                    }
                },
                error: function(){
                    console.log("Lỗi lấy dữ liệu giao dịch");
                }
        });
    }
</script>
<script>
$(document).ready( function () {
    $('#tbQueue').DataTable();
} );
</script>
@endsection