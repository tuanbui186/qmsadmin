@extends('layouts.master')
@section('content')
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content">
        <!-- PAGE TITLE -->
        <div class="page-title">
            <h2><span class="fa fa-users"></span> QUẢN LÝ KHÁCH HÀNG</h2>
        </div>
        <!-- END PAGE TITLE -->
        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form class="form-horizontal">
                            <div class="form-group">
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <span class="fa fa-search"></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Tìm kiếm thông tin khách hàng"/>
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="input-group-btn">
                    <button class="btn btn-primary" data-toggle='modal' data-target='#modalAddCus'>Thêm khách hàng</button>
                </div>
            </div>
        </div>
        <div class="row">
            <table class="table" id="tbCustomer">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Họ tên</th>                                 
                        <th>Email</th>                           
                        <th>Số điện thoại</th>              
                        <th>Địa chỉ</th>
                        <th>Điểm tích lũy</th>
                        <th>Cấu hình</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        <!-- Start Add Modal -->        
        <div class="modal fade" tabindex="-1" id="modalAddCus" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
				<div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" style="color: #6256a9; font-weight: bold">Thêm khách hàng</h4>
                    </div>
                <form>
                    {{ csrf_field() }}
                    <div class="modal-body">      						
                        <div class="row">
                            <div class="col-md-6 col-xs-6">
                                <label>Họ tên</label>                        
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <input id="addFullname" name="txtFullname" class="form-control" placeholder="Nhập họ và tên">
                            </div>
                        </div>
                        </br>    
                        <div class="row">
                            <div class="col-md-6 col-xs-6">
                                <label>Số điện thoại</label>                                                        
                            </div>  
                            <div class="col-md-6 col-xs-6">
                                <input type="text" id="addPhone" name="txtAddPhone" class="form-control" placeholder="Nhập số điện thoại">
                            </div>                           
                        </div>
                        </br>
                        <div class="row">
                            <div class="col-md-6 col-xs-6">
                                <label>Email</label>                        
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <input type="text" id="addEmail" name="txtAddEmail" class="form-control" placeholder="Địa chỉ Email">
                            </div>
                        </div>
                        </br>          
                        <div class="row">
                            <div class="col-md-6 col-xs-6">
                                <label>Giới tính</label>                        
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <select class="form-control" name="sltAddGender" id="addGender">
                                    <option value ="1">Nam</option>
                                    <option value ="0">Nữ</option>
                                </select>
                            </div>
                        </div>
                        </br>
                        <div class="row">
                                <div class="col-md-6 col-xs-6">
                                    <label>Ngày sinh</label>                        
                                </div>
                                <div class="col-md-6 col-xs-6">
                                    <input type="text" id="addBirthday" name="txtAddBirthday" class="form-control datepicker" placeholder="1990-01-01">
                                </div>
                            </div>
                        </br> 
                        <div class="row">
                                <div class="col-md-6 col-xs-6">
                                    <label>Điểm tích lũy</label>                                                        
                                </div>  
                                <div class="col-md-6 col-xs-6">
                                    <input type="text" id="addPoint" name="txtPoint" class="form-control" placeholder="Nhập số điểm tích lũy">
                                </div>                           
                            </div>
                        </br>
                        <div class="row">
                            <div class="col-md-6 col-xs-6">
                                <label>Mật khẩu</label>                        
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <input type="password" id="addPassword" name="txtAddPassword" class="form-control" placeholder="Nhập mật khẩu">
                            </div>
                        </div>
                        </br>         
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng lại</button>
                        <button type="button" class="btn btn-primary" id="btnAddCustomer" name='btnAddCustomer'>Đồng ý</button>
                    </div>
                </form>
            </div>
			</div>
		</div>
		<!-- End Add Modal -->  
		<!-- Start Add Image Modal -->        
        <div class="modal fade" tabindex="-1" id="modalAddImage" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
				<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title" style="color: #6256a9; font-weight: bold">Thêm/sửa hình đại diện khách hàng</h4>
						</div>
						<form method="post" action="{{ url('add-image-employee') }}" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="modal-body">  
							<input id="employeeId" name="txtEmployeeId" value="" hidden="">                  
							<div class="row">
								<div class="col-md-6 col-xs-6">
									<label>Hình ảnh</label>                        
								</div>
								<div class="col-md-6 col-xs-6">
									<label for="imageInput"><i>Chọn hình đại diện khách hàng</i></label>
									<input data-preview="#preview" name="txtUploadImageEmployee" type="file" id="addImageEmployee">
									<img class="col-sm-6" id="preview"  src="" ></img>
									<p class="help-block"></p>
								</div>
							</div>
							</br>         
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Đóng lại</button>
							<button type="submit" class="btn btn-primary" id="btnAddImageEmployee" name='btnAddImageEmployee'>Đồng ý</button>
						</div>
						</form>
				</div>
			</div>  
		</div>
		<!-- End Add Image Modal -->
    </div>
		<!-- END PAGE CONTENT WRAPPER -->
		
<script>
    $( function() {
        $( ".datepicker" ).datepicker();     
    } );
</script>    
<script>
$(document).ready(function() {
    getAllCustomer();
	addCustomer();
	
	$("#modalAddImage").on('show.bs.modal', function (event){
		var button = $(event.relatedTarget);
        var employeeId = button.data('employeeid');  
		$("#employeeId").val(employeeId);
	});
	
	function addCustomer(){
		$("#btnAddCustomer").click(function () { 			
            let url = 'add-customer';
            let addFullname = $('#addFullname').val();
            let addPhone = $('#addPhone').val();   
			let addEmail = $('#addEmail').val();
            let addPassword = $('#addPassword').val();
			let addPoint = $('#addPoint').val();        
			let addGender = $('#addGender').val();	
            let addBirthday = $('#addBirthday').val();
            console.log(addFullname +" "+addPhone+" "+addEmail+" "+ addPassword +" "+addPoint+" "+addGender +" "+ addBirthday);
			$.ajaxSetup({
				headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				url: url,
				type:'POST',
				data: {addFullname : addFullname, addPhone : addPhone, addGender: addGender, addPassword: addPassword, addEmail: addEmail, addPoint: addPoint, addBirthday: addBirthday},
				dataType : 'json',
				success: function(value){	
					console.log(JSON.stringify(value)); 
					if(value.errorCode == 0){          		
						$.notify("Thêm khách hàng thành công", {type:"success"});      
						$('#modalAdd').modal('hide');    			
						location.reload();						
					}else if(value.errorCode == 2){
						$.notify("Khách hàng đã tồn tại", {color: "#fff", background: "#D44950"});      
						$('#modalAdd').modal('hide');
					}else{
						$.notify("Lỗi thêm khách hàng", {color: "#fff", background: "#D44950"});      
						$('#modalAdd').modal('hide');    						
					}
				},
				error: function(){
					$.notify("Lỗi thêm khách hàng", {color: "#fff", background: "#D44950"});                          
				}
			});                  
        });
	}
    function getAllCustomer(){
        var url = 'get-customer';             
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            type:'GET',
            dataType : 'JSON',
            success: function(data){
                let phone = "";
                let email = "";
                let address = "";
                let birthday = "";
                let fullname = "";
                let point = "";
                
                if(data == [] || data == "" || data == null) {
                    $.notify('Không có dữ liệu khách hàng', {type: 'danger', icon:'close'})
                }else {
                    $("#tbCustomer").DataTable().destroy();
                    $("#tbCustomer tbody").empty();
                    console.log(JSON.stringify(data));		
                    let i = 1;			                                  
                    $.each (data.data.customerList, function (key, item) {                        
                        if (item['phone'] !== null || item['phone'] !== ""){
                            phone = item['phone'];
                        }else{
                            phone = "--";
                        }
                        if (item['email'] !== null || item['email'] !== ""){
                            email = item['email'];
                        }else{
                            email = "--";
                        }
                        if (item['address'] !== null || item['address'] !== ""){
                            address = item['address'];
                        }else{
                            address = "--";
                        }
                        if (item['birthday'] !== null || item['birthday'] !== ""){
                            birthday = item['birthday'];
                        }else{
                            birthday = "--";
                        }   
                        if (item['fullName'] !== null || item['fullName'] !== ""){
                            fullname = item['fullName'];
                        }else{
                            fullname = "--";
                        }  
                        if (item['point'] !== null || item['point'] !== ""){
                            point = item['point'];
                        }else{
                            point = "--";
                        }  
                        let html = "<tr>" +
                                        "<td>"+i+"</td>" +
                                        "<td>"+fullname+"</td>" +
                                        "<td>"+email+"</td>" +           
                                        "<td><span>"+phone+"</span></td>" +                                  "<td><span>"+address+"</span></td>" +
                                        "<td><span>"+point+"</span></td>" +
                                        "<td>"+
                                            "<button class='btn btn-success' data-toggle='modal' data-target='#modalEdit' data-editid="+item['userID']+">Sửa</button>" +
                                            "<button class='btn btn-danger' data-toggle='modal' data-target='#modalDelete' data-storeid='0' data-delid="+item['userID'] +">Xóa</button>"+
                                        "</td>"+
                                    "</tr>";           
                            $('#tbCustomer tbody').append(html);                i++;            
                        });
                        $("#tbCustomer").DataTable();  
                    }                    
            },
            error: function(){
                $.notify('Lỗi lấy thông tin người dùng', {type: 'danger', icon:'close'})
            }
        });
    } 
});
</script>
<script>
    $(document).ready( function () {
        $('#tbCustomer').DataTable();
    });
</script>
@endsection