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
        <li><a href="{{route('getEmployeeManager')}}"><i class="fa fa-arrow-left"></i> Quản lý nhân viên</a></li>
        <li><a href="../summary/<?php echo $employee_id; ?>">Tổng kết</a></li>
        <!-- <li><a href="../transaction/<?php echo $employee_id; ?>">Giao dịch</a></li>
        <li><a href="../rating/<?php echo $employee_id; ?>">Đánh giá</a></li> -->
        <li><a href="../time-working/<?php echo $employee_id; ?>">Thời gian làm việc</a></li>
        <li><a href="../account-manager/<?php echo $employee_id; ?>" class="active">Quản lý tài khoản</a></li>
    </ul>
    </div>
    <br>
    <div class="row">
        <div class="col-md-6"><label>Tên đăng nhập</label> <input class="form-control" value="" id="username" disabled>
        </div>
        <div class="col-md-6">
        <label>Tên hiển thị</label> <input class="form-control" value="" id="fullName" name="txtFullName">
        </div>
        <div class="col-md-6">
        <label>Điểm giao dịch</label>
            <select class="form-control" id="txtTranspointName" disabled>
                <?php foreach($transPoint as $val){ ?>
                    <option value="<?php echo $val->id; ?>">
                        <?php echo $val->name; ?>
                    </option>                                
                <?php } ?>
            </select>
        </div>
        <div class="col-md-6 pos">
        <label>Chức vụ</label>
            <select class="form-control" name="txtPosition" id="position">
                <?php foreach($position as $val){ ?>
                    <option value="<?php echo $val->id; ?>">
                        <?php echo $val->name; ?>
                    </option>                                
                <?php } ?>
            </select>
        </div>
        <div class="col-md-6">
            <label>Quyền truy cập</label>
            <select class="form-control" name="txtEditPermission" id="permission" disabled>                        
            </select>                
        </div>
        <div class="col-md-6">
            <label>Email</label>
            <input type="text" class="form-control" value="" id="email">
        </div>
        <div class="col-md-6">
            <label>Mật khẩu mới</label>
            <input type="password" class="form-control" value="" id="newPassword">
        </div>
        <div class="col-md-6">
            <label>Xác nhận mật khẩu </label>
            <input type="password" class="form-control" value="" id="confirmPassword">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-6">            
                <!-- <input id="employeeId" name="txtEmployeeId" hidden> -->
                <button class="btn btn-danger" data-toggle='modal' data-target='#modalDelete'><span class="glyphicon glyphicon-remove-circle"></span>Xóa tài khoản</button>
        </div>
        <div class="col-md-6">
            <button class="btn btn-success" id="btnEditAccount"><span class="glyphicon glyphicon-save"></span>Lưu</button>
        </div>
    </div>
        <!-- Start Delete Modal -->        
    <div class="modal fade " tabindex="-1" id="modalDelete" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="color: #6256a9; font-weight: bold">Xóa tài khoản </h4>
                </div>
                <div class="modal-body">
                    <p>
                        Bạn có chắc chắn xóa tài khoản này?
                    </p>
                </br>
                <!--div style="font-size:10px;"-->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng lại</button>
                <button type="button" class="btn btn-primary" id="btnDelEmployee">Đồng ý</button>
            </div>
        </div>
    </div>
    <!-- End Delete Modal --> 
<script>
var url = window.location.pathname;
var employeeId = url.substring(url.lastIndexOf('/') + 1);
delEmployee();
editEmployee();
getDataEmployee();
    function getDataEmployee(){    
        let url = '../get-data-account-manager';
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
                    console.log(JSON.stringify(data));  
                    $.each (data, function (key, item) {                        
                        $("#username").val(item["username"]);
                        $("#fullName").val(item["full_name"]);
                        $("#email").val(item["email"]);                             
                        $("div.pos select").val(item["position_id"]);                                                      
                    });
                }
                else {
                    alert("Không có dữ liệu");
                }
            },
            error: function(){
                $.notify('Lỗi lấy dữ liệu thông tin tài khoản', {type: 'danger', icon:'close'})
            }
        });
    }

    function delEmployee(){
        $("#btnDelEmployee").click(function () {                    
            let url = '../del-employee';
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type:'POST',
                data: {employeeId : employeeId},
                dataType : 'json',
                success: function(value){                                        
                    $.notify("Success", {type: "Xóa tài khoản thành công", icon:"check"});
                    $('#modalDelete').modal('hide');            
                    window.location.href="{{route('getEmployeeManager')}}";            
                },
                error: function(){
                    $.notify("Lỗi xóa tài khoản", {color: "#fff", background: "#D44950"});                           
                } 
            });            
        });
    }

    function editEmployee(){
        $("#btnEditAccount").click(function () {                    
            let url = '../edit-employee';
            let fullName = $('#fullName').val();
            let position = $('#position').val();
            let email = $('#email').val();
            let newPassword = $('#newPassword').val();
            let confirmPassword = $('#confirmPassword').val();
            console.log(fullName);
            console.log(position);
            console.log(email);
            console.log(newPassword);
            console.log(confirmPassword);
            if (newPassword != confirmPassword){
                $.notify("Mật khẩu không khớp nhau", {color: "#fff", background: "#D44950"});                               
            }else{
                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: url,
                    type:'POST',
                    data: {employeeId : employeeId, fullName: fullName, position: position, email: email, newPassword: newPassword},
                    dataType : 'text',
                    success: function(value){   
                        if(value === "Ok"){                                                     
                            $.notify("Sửa thông tin tài khoản thành công", {type:"success"});                                                      
                        }else {
                            $.notify("Lỗi sửa thông tin tài khoản", {color: "#fff", background: "#D44950"});      
                        }
                    },
                    error: function(){
                        $.notify("Lỗi sửa thông tin tài khoản", {color: "#fff", background: "#D44950"});                           
                    }
                });
            }            
        });
    }
</script>

@endsection