@extends('layouts.master')
@section('content')
    <?php 
        function getCurrentURL()
        {
            $currentURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
            $currentURL .= $_SERVER["SERVER_NAME"];
        
            if($_SERVER["SERVER_PORT"] != "80" && $_SERVER["SERVER_PORT"] != "443")
            {
                $currentURL .= ":".$_SERVER["SERVER_PORT"];
            } 
        
                $currentURL .= $_SERVER["REQUEST_URI"];
            return $currentURL;
        }            
        // echo getCurrentURL();
        $split = explode('/',getCurrentURL());        
    ?>
    <?php 
        $string = $_SERVER['REQUEST_URI'];
        $last_word_start = strrpos($string, '/') + 1; 
        $store_id = substr($string, $last_word_start); 
    ?>
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content">
        <!-- PAGE TITLE -->
        <div class="page-title">
            <h2><span class="fa fa-users"></span> QUẢN LÝ NHÂN VIÊN</h2>
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
                                        <input type="text" class="form-control" placeholder="Tìm kiếm thông tin nhân viên"/>
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
                    <button class="btn btn-primary" data-toggle='modal' data-target='#modalAdd'>Thêm nhân viên </button>
                </div>
            </div>
        </div>
        <div class="row" id="employeeList">
            
        </div>
        <!-- Start Add Modal -->        
        <div class="modal fade" tabindex="-1" id="modalAdd" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
				<div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" style="color: #6256a9; font-weight: bold">Thêm nhân viên</h4>
                    </div>
                    <form>
                    {{ csrf_field() }}
                    <div class="modal-body">      
						<input name="txtStoreId" id="addStoreId" value="<?php echo $split[5]; ?>" hidden="">  
                        <div class="row">
                            <div class="col-md-6 col-xs-6">
                                <label>Tên đăng nhập</label>                        
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <input id="addUsername" name="txtUsername" class="form-control" placeholder="Nhập tên đăng nhập">
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
                        <div class="row">
                            <div class="col-md-6 col-xs-6">
                                <label>Họ và tên</label>                        
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <input type="text" id="addFullName" name="txtAddFullName" class="form-control" placeholder="Nhập họ và tên">
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
                                <label>Email</label>                        
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <input type="email" id="addEmail" name="txtAddEmail" class="form-control" placeholder="nguyenvana@gmail.com">
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
                                <label>Chức vụ</label>                        
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <select class="form-control" name="sltAddPosition" id="addPosition">
                                    <?php foreach($position as $val){ ?>
                                        <option value="<?php echo $val->id; ?>">
                                            <?php echo $val->name; ?>
                                        </option>                                
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        </br>
                        <div class="row">
                            <div class="col-md-6 col-xs-6">
                                <label>Nhóm quyền truy cập</label>                        
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <select class="form-control" name="sltRightGroup" id="addRightGroup">
                                    <?php foreach($right_group as $val){ ?>
                                        <option value="<?php echo $val->id; ?>">
                                            <?php echo $val->name; ?>
                                        </option>                                
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        </br>
                        <div class="row">
                            <div class="col-md-6 col-xs-6">
                                <label>Loại tài khoản</label>                        
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <select class="form-control" name="sltRoleId" id="addRoleId">                                    
                                        <option value="515">
                                            <?php echo "Nhân viên"; ?>
                                        </option>                                                                    
                                </select>
                            </div>
                        </div>
                        </br>
                        <div class="row">
                            <div class="col-md-6 col-xs-6">
                                <label>Địa chỉ</label>                        
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <input type="text" class="form-control" name="txtAddAddress" id="addAddress" placeholder="so 10 Pho Quang">
                            </div>
                        </div> 
                        </br> 
                        <div class="row">
                            <div class="col-md-6 col-xs-6">
                                <label>Số điện thoại</label>                        
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <input type="text" class="form-control" name="txtAddPhone" id="addPhone" maxlength="13" placeholder="+849090909090">
                            </div>
                        </div>           
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng lại</button>
                        <button type="button" class="btn btn-primary" id="btnAddEmployee" name='btnAddEmployee'>Đồng ý</button>
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
							<h4 class="modal-title" style="color: #6256a9; font-weight: bold">Thêm/sửa hình đại diện nhân viên</h4>
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
									<label for="imageInput"><i>Chọn hình đại diện nhân viên</i></label>
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
  function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#addImageEmployee").change(function(){
        readURL(this);
    });
    getAllEmployee();
	addEmployee();
    $("#modalCustomer").on('show.bs.modal', function (event) {          
          var button = $(event.relatedTarget);
          var customerId = button.data('customerid');                 
          getCustomer(customerId);
    });
	
	$("#modalAddImage").on('show.bs.modal', function (event){
		var button = $(event.relatedTarget);
        var employeeId = button.data('employeeid');  
		$("#employeeId").val(employeeId);
	});
	
	function addEmployee(){
		$("#btnAddEmployee").click(function () { 			
            let url = '../add-employee';
            let addStoreId = $('#addStoreId').val();
            let addUsername = $('#addUsername').val();   
			let addFullName = $('#addFullName').val();
            let addPassword = $('#addPassword').val();
			let addGender = $('#addGender').val();
            let addEmail = $('#addEmail').val();
            let addBirthday = $('#addBirthday').val();
            let addPosition = $('#addPosition').val();
            let addAddress = $('#addAddress').val();           
            let addPhone = $('#addPhone').val(); 
            let addRoleId = $('#addRoleId').val(); 
			let addRightGroup = $('#addRightGroup').val();								
			$.ajaxSetup({
				headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				url: url,
				type:'POST',
				data: {addStoreId : addStoreId, addUsername : addUsername, addGender: addGender, addFullName: addFullName, addPassword: addPassword, addEmail: addEmail, addBirthday: addBirthday, addPosition: addPosition, addAddress: addAddress, addRoleId: addRoleId, addRightGroup: addRightGroup, addPhone: addPhone, addBirthday: addBirthday},
				dataType : 'json',
				success: function(value){	
					/* console.log(JSON.stringify(value)); */
					if(value.errorCode == 0){             							
						$.notify("Thêm nhân viên thành công", {type:"success"});      
						$('#modalAdd').modal('hide');    			
						 location.reload();						
					}else if(value.errorCode == 2){
						$.notify("Nhân viên đã tồn tại", {color: "#fff", background: "#D44950"});      
						$('#modalAdd').modal('hide');
					}else{
						$.notify("Lỗi thêm nhân viên", {color: "#fff", background: "#D44950"});      
						$('#modalAdd').modal('hide');    						
					}
				},
				error: function(){
					$.notify("Lỗi thêm nhân viên", {color: "#fff", background: "#D44950"});                           
				}
			});                  
        });
	}
    function getAllEmployee(){
        var url = '../get-all-employee';
        var store_id = '<?php echo $store_id; ?>';        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            type:'GET',
            data: {storeId: store_id},
            dataType : 'JSON',
            success: function(data){
                if(data == [] || data == "" || data == null) {
                    $.notify('Không có dữ liệu nhân viên', {type: 'danger', icon:'close'})
                }else {
                    console.log(JSON.stringify(data));					
                    var html = "";
                    $.each (data, function (key, item) {
                        html = "<div class='col-md-3' style='cursor: pointer'>"+
											"<div class='panel panel-default'>"+
												"<div class='panel-body profile'>"+													
														"<div class='profile-image'>"+       
															"<img data-toggle='modal' data-target='#modalAddImage' data-employeeid='"+item['id']+"' height='100px' width='100px' src='"+item['avatar_url']+"'>"+
														"</div>"+													
													"<div class='profile-data'>"+
														"<div class='profile-data-name'>"+
															item['full_name']+
														"</div>"+                                        
														"<div>"+
															"<span style='color: white'>Điểm: </span><span style='color: #01a252;'>"+
																item['marks']+
															"</span>"+
														"</div>"+
													"</div>"+
													 "<div class='profile-controls'>"+
														"<a class='profile-control-left'><span class='fa fa-info'></span></a>"+
														"<a class='profile-control-right'><span class='fa fa-phone'></span></a>"+
													 "</div>"+
												"</div>"+
												"<a href='../summary/"+ item['id']+"'>"+
													"<div class='panel-body' style='text-align: center'>"+
														"<div class='contact-info'>"+
																"<p><small>Số điện thoại</small><br/>"+
																	item['phone']+
																"</p>"+                                           
																"<p><small>Email</small><br/>"+
																	item['email']+
																"</p>"+
																"<p><small>Địa chỉ</small><br/>"+
																	item['address']+
																"</p>"+
																"<p><small>Ngày sinh</small><br/>"+
																	item['birthday']+
																"</p>"+                            
														"</div>"+
													"</div>"+
												 "</a>";
											"</div>"+                
										"</div>";                                   
                            $('#employeeList').append(html);
                            });
                    }                    
            },
            error: function(){
                $.notify('Lỗi lấy thông tin người dùng', {type: 'danger', icon:'close'})
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
					console.log("--------------------------------");                        
					console.log(JSON.stringify(data));
					$("#cusName").text(data.data.fullName);          
					$("#cusGender").text(data.data.gender);
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

@endsection