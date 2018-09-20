@extends('layouts.master')
@section('content')

        <!-- PAGE CONTENT WRAPPER -->
<div class="page-content">
    <!-- PAGE TITLE -->
    <div class="page-title">
        <h2><span class="fa fa-cogs"></span>QUẢN LÝ CỬA HÀNG</small></h2>
</div>
        <!-- END PAGE TITLE -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                    <div class="form-group">
                        <div class="col-md-8">
                        </div>
                        <div class="col-md-4 right">
                            <button class="btn btn-success" data-toggle="modal" data-target="#modalAdd">Thêm cửa hàng</button>
                        </div>
                    </div>              
            </div>
        </div>
    </div> 
</div>
<div class="row">
    <table class="table" id="tbStores">
        <thead>
            <tr>                
                <th>Hình</th>
                <th>Tên cửa hàng</th>
                <th>Mô tả</th>            
                <th>Địa chỉ</th>
                <th>Số điện thoại</th>                 
                <th>Cấu hình</th>                
            </tr>
        </thead>
        <tbody> 
        </tbody>
    </table>
<!-- Start Add Modal -->
<div class="modal fade " tabindex="-1" id="modalAdd" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="color: #6256a9; font-weight: bold">Thêm cửa hàng </h4>
            </div>              
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <label>Tên cửa hàng</label>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <input class="form-control" placeholder="Tên cửa hàng" id="storeName" name="txtStoreName">
                    </div>
                </div>
                </br>
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <label>Mô tả</label>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <input class="form-control" placeholder="Mô tả" id="description" name="txtDescription">
                    </div>
                </div>
                </br>
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <label>Chọn Tỉnh/TP</label>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <Select class="form-control" id="province" name="sltProvince">
                                <option selected>
                                    --- Vui lòng chọn tỉnh/thành phố ---
                                </option>
                            <?php foreach($provinces as $val){ ?>
                                    
                                    <option value="<?php echo $val->id; ?>">
                                        <?php echo $val->name; ?>
                                    </option>                                
                            <?php } ?>                       
                        </Select>
                    </div>
                </div>
                </br>
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <label>Chọn Quận/Huyện</label>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <Select class="form-control" id="district" name="sltDistrict">                            
                        </Select>
                    </div>
                </div>
                </br>
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <label>Địa chỉ</label>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <input class="form-control" placeholder="Số 10 Phổ Quang, Tân Bình, Hồ Chí Minh" id="address" name="txtAddress">
                    </div>
                </div>
                </br>
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <label>Kinh độ</label>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <input class="form-control" placeholder="10.437982" id="longitude" name="txtLongitude">
                    </div>
                </div>
                </br>
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <label>Vĩ độ</label>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <input class="form-control" placeholder="10.437982" id="latitude" name="txtLatitude">
                    </div>
                </div>
                </br>
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <label>Số điện thoại</label>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <input class="form-control" placeholder="1069472093" id="phone" name="txtPhone">
                    </div>
                </div>
                </br>
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <label>Fax</label>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <input class="form-control" placeholder="8948982" id="fax" name="txtFax">
                    </div>
                </div>
                </br>
                <!-- <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <label>Thời điểm mở cửa</label>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <input class="form-control" placeholder="07:30:30" id="openTime" name="txtOpenTime">
                    </div>
                </div>
                </br>
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <label>Thời điểm đóng cửa</label>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <input class="form-control" placeholder="18:30:30" id="closeTime" name="txtCloseTime">
                    </div>
                </div>
                </br> -->
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <label>Đặt lịch hẹn</label>
                    </div>
                    <div class="col-md-6 col-xs-12">
                    <Select class="form-control" id="makeAppoint" name="sltMakeAppoint">
                        <option value="0">Không cho phép</option>
                        <option value="1">Cho phép</option>                            
                    </Select>
                    </div>
                </div>                                            
            </div>        
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng lại</button>
                <button type="button" class="btn btn-primary" id="btnAdd">Đồng ý</button>
            </div> 
        </div>           
    </div>
</div>
<!-- End Add Modal -->  
<!-- Start Add Image Modal -->
<div class="modal fade " tabindex="-1" id="modalAddImage" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <form method="post" action="{{ url('edit-image-transaction-point') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="color: #6256a9; font-weight: bold">Thêm ảnh cửa hàng</h4>
                </div>       
                <div class="modal-body">
                    <input id="editImgStoreId" name="txtEditImgStoreId" hidden></input>
                    <div class="row">
                        <div class="col-md-6 col-xs-6">
                            <label>Hình ảnh</label>                        
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <label for="imageInput"><i>Chọn hình ảnh cửa hàng</i></label>
                            <input data-preview="#preview" name="txtUploadImageStore" type="file" id="addImageStore">
                            <img class="col-sm-6" id="preview"  src="" ></img>
                            <p class="help-block"></p>
                        </div>
                    </div>
                </div>                           
                <div class="modal-footer">	
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng lại</button>
                    <button type="submit" class="btn btn-primary" id="btnEditImage">Đồng ý</button>
                </div>
            </div> 
        </form>        
    </div>
</div>
<!-- End Add Image Modal --> 
<!-- Start Edit Modal -->
<div class="modal fade " tabindex="-1" id="modalEdit" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <form method="post" action="{{ url('edit-store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="color: #6256a9; font-weight: bold">Sửa cửa hàng </h4>
                </div>            
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <label>Tên cửa hàng</label>
                            <input id="editStoreId" name="txtEditStoreId" hidden></input>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <input class="form-control" placeholder="Tên cửa hàng" id="editStoreName" name="txtEditStoreName">
                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <label>Mô tả</label>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <input class="form-control" placeholder="Mô tả" id="editDescription" name="txtEditDescription">
                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <label>Vĩ độ</label>
                        </div>
                        <div class="col-md-6 col-xs-12">
                        <input class="form-control" placeholder="10.7801323" name="txtEditLatitude" id="editLatitude">
                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <label>Kinh độ</label>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <input class="form-control" placeholder="10.7801323" name="txtEditLongitude" id="editLongitude">
                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <label>Địa chỉ</label>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <input class="form-control" placeholder="Hcm" id="editAddress" name="txtEditAddress">
                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <label>Số điện thoại</label>
                        </div>
                        <div class="col-md-6 col-xs-12">
                        <input class="form-control" placeholder="0908789789" id="editPhone" name="txtEditPhone">
                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <div class="col-md-6 col-xs-6">
                            <label>Fax</label>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <input class="form-control" placeholder="0978967986" id="editFax" name="txtEditFax">
                        </div>
                    </div>
                    </br>
                    {{-- <div class="row">
                        <div class="col-md-6 col-xs-6">
                            <label>Thời điểm mở cửa</label>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <input class="form-control" id="editOpenTime" name="txtEditOpenTime" value="07:30:00" disable>
                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <div class="col-md-6 col-xs-6">
                            <label>Thời điểm đóng cửa</label>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <input class="form-control" id="editCloseTime" name="txtEditCloseTime" value="17:00:00">
                        </div>
                    </div>
                    </br> --}}
                    <div class="row">
                        <div class="col-md-6 col-xs-6">
                            <label>Đặt lịch hẹn</label>
                        </div>
                        <div class="col-md-6 col-xs-6">
                        <select class="form-control" id="sltEditMakeAppoint" name="sltEditMakeAppoint">
                            <option value="0">Không cho phép</option>
                            <option value="1">Cho phép</option>                            
                        </select>
                        </div>
                    </div>                    
                    </br>                    
                </div>                       
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng lại</button>
                    <button type="submit" class="btn btn-primary" id="btnEdit">Đồng ý</button>
                </div> 
            </div>            
        </form>
    </div>
</div>
<!-- End Edit Modal -->
<!-- Start Delete Modal -->
<div class="modal fade " tabindex="-1" id="modalDelete" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="color: #6256a9; font-weight: bold">Xóa cửa hàng</h4>
            </div>
            <div class="modal-body">
                <p>
                    Bạn có chắc chắn xóa cửa hàng này?
                </p>
            </div>
            </br>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng lại</button>
                <button type="button" class="btn btn-primary" id="btnDel">Đồng ý</button>
            </div>
        </div>        
    </div>
</div>
<!-- End Delete Modal -->    
</div>
<!-- Initialize the plugin: -->
<script>
    function getOptions(isFilter) {
    return {
        enableFiltering: isFilter,
        enableCaseInsensitiveFiltering: isFilter,
        includeSelectAllOption: true,  
        filterPlaceholder: 'Tìm dịch vụ ...',
        nonSelectedText: 'Chọn dịch vụ!',
        numberDisplayed: 6,
        maxHeight: 400,
        }
    }
    $('.multiSelection').multiselect(getOptions(true));   
</script>
<script type="text/javascript">
 $(document).ready(function() {
    getAllStores();
    addStore();
    getDistrict();
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function getServices(e) {
                $('#preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#addImageStore").change(function(){
        readURL(this);
    });
    
    $("#editImageStore").change(function(){
        readURL(this);
    });
    $("#modalAddImage").on('show.bs.modal', function (event) {           
          var button = $(event.relatedTarget);
          var storeId = button.data('id');                    
          $('#editImgStoreId').val(storeId);                
    });

    $("#modalEdit").on('show.bs.modal', function (event) {             
          var button = $(event.relatedTarget);
          var storeId = button.data('id');          
          $('#editStoreId').val(storeId);          
         getStore(storeId);          
    });
    $("#modalDelete").on('show.bs.modal', function (event) {     
          var button = $(event.relatedTarget);
          var storeId = button.data('id');       
         deleteStore(storeId);
    });
    function getAllStores(){		
        var pageURL = $(location).attr("href");
        var curURL = pageURL.substring(0, pageURL.lastIndexOf("/") + 1);
        var url = 'get-all-stores';             
                $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });
              $.ajax({
                url: url,
                type:'GET',        
                dataType : 'json',
                success: function(value){    
                    // $("#tbTransCounter tbody").empty();                
                    if(value === "" ){
                        console.log("Không có dữ liệu");
                    }else{
                        console.log(JSON.stringify(value));
                        let i = 1;
                        let status = "";    
                        let name = "";
                        let description = "";
                        let picture_url = "";
                        let address = "";
                        let phone = "";
                        let fax = "";
                        let open_time = "";
                        let close_time = "";
                        let created_tst = ""; 
                        let btnUploadImage = "";                        
                        
                        $("#tbStores").DataTable().destroy();
                        $("#tbStores tbody").empty();
                        $.each (value.data.storeList, function (key, item){                             
                            // if(item['allow_book_online'] === 0){
                            //     status = "Không cho phép";
                            // }else if(item['allow_book_online'] === 1){
                            //     status = "Cho phép";
                            // }
                            if(item['name'] == "" || item['name'] == null){
                                name = "Chưa có giá trị";                                
                            }else{
                                name = item['name'];
                            }
                            if(item['description'] == "" || item['description'] == null){
                                description = "Chưa xác định";
                            }else{
                                description = item['description'];
                            }
                            if(item['pictureUrl'] == "" || item['pictureUrl'] == null){
                                // btnUploadImage = "<button class='btn btn-info' data-toggle='modal' data-id='"+item['id']+"' data-target='#modalAddImage'>Thêm ảnh</button>";
                                picture_url = "<img style='cursor: pointer' data-toggle='modal' data-id='"+item['id']+"' data-target='#modalAddImage' height='50' width='50' src='"+curURL+"/storage/upload/stores/default-store.png'>";
                            }else{
                                picture_url = "<img style='cursor: pointer' data-toggle='modal' data-id='"+item['id']+"' data-target='#modalAddImage' height='50' width='50' src='"+item['pictureUrl']+"'>";                                
                            }
                            if(item['address'] == "" || item['address'] == null){
                                address = "Chưa xác định";
                            }else{
                                address = item['address'];
                            }
                            if(item['phone'] == "" || item['phone'] == null){
                                phone = "Chưa xác định";
                            }else{
                                phone = item['phone'];
                            }
                            if(item['fax'] == "" || item['fax'] == null){
                                fax = "Chưa xác định";
                            }else{
                                fax = item['fax'];
                            }
                            if(item['openTime'] == "" || item['openTime'] == null){
                                open_time = "Chưa xác định";
                            }else{
                                open_time = item['openTime'];
                            }
                            if(item['closeTime'] == "" || item['closeTime'] == null){
                                close_time = "Chưa xác định";
                            }else{
                                close_time = item['closeTime'];
                            }
                            if(item['createdTst'] == "" || item['createdTst'] == null){
                                created_tst = "Chưa xác định";
                            }else{
                                created_tst = item['createdTst'];
                            }                            
                            let html = "<tr"+
                                            "<td>"+i+"</td>"+
                                            "<td>"+picture_url+"</td>"+                                                                                        
                                            "<td>"+name+"</td>"+
                                            "<td>"+description+"</td>"+                                                                                        
                                            "<td>"+address+"</td>"+   
                                            "<td>"+phone+"</td>"+                                      
                                            // "<td>"+open_time+"</td>"+ 
                                            // "<td>"+close_time+"</td>"+                                                                                         
                                            "<td>"+
                                                "<button class='btn btn-success' data-toggle='modal' data-id='"+item['id']+"' data-target='#modalEdit'>Sửa</button>"+
                                                "<button class='btn btn-danger' data-toggle='modal' data-id='"+item['id']+"' data-target='#modalDelete'>Xóa</button>"+
                                            "</td>"+
                                        "</tr>";                                    
                                    if(item['status'] === 1){
                                        $("#store option[value=1]").prop('selected', 'selected');                             
                                    }else if (item['status'] === 0) {
                                        $("#store option[value=0]").prop('selected', 'selected');   
                                    }                                        
                                $("#tbStores").append(html);                                
                                i++;
                        });
                        $("#tbStores").DataTable();
                    }
                },
                error: function(){
                    console.log("Lỗi lấy dữ liệu cửa hàng");
                }
            });
    }

    function addStore(){
        $("#btnAdd").click(function () {                    
            let url = 'add-store';
            let storeName = $('#storeName').val();
            let description = $('#description').val();                        
            let address = $('#address').val();
            let districtId = $('#district').val();
            let latitude = $('#latitude').val();
            let longitude = $('#longitude').val();            
            let phone = $('#phone').val();
            let fax = $('#fax').val();
            let openTime = $('#openTime').val();
            let closeTime = $('#closeTime').val();
            let makeAppoint = $('#makeAppoint').val();    
                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: url,
                    type:'POST',
                    data: {storeName : storeName, description : description, latitude: latitude, longitude: longitude, address: address, districtId: districtId, phone: phone, fax: fax, openTime: openTime, closeTime: closeTime, makeAppoint: makeAppoint},
                    dataType : 'text',
                    success: function(value){						
                        if(value.errorCode == 0){             							
                            $.notify("Thêm cửa hàng thành công", {type:"success"});      
                            $('#modalAdd').modal('hide');    
                            getAllStores();
                        }else if(value.errorCode == 2){
                            $.notify("Cửa hàng đã tồn tại", {color: "#fff", background: "#D44950"});      
							$('#modalAdd').modal('hide');
                        }else{
							$.notify("Thêm cửa hàng thành công", {type:"success"});      
                            $('#modalAdd').modal('hide');    
                            getAllStores();
						}
                    },
                    error: function(){
                        $.notify("Lỗi thêm cửa hàng", {color: "#fff", background: "#D44950"});                           
                    }
                });                  
        });
    }
    
    function getStore(storeId){  
        var url = 'get-store';             
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type:'GET',  
                data: {storeId: storeId},
                dataType : 'json',
                success: function(data){                
                    if(data === "" ){
                        console.log("Không có dữ liệu");
                    }else{
                        console.log("--------------------------------");                        
                        console.log(JSON.stringify(data));
                        let status = "";                                                    
                        $.each (data, function (key, item){                                
                            $('#editStoreName').val(item['name']);                                
                            $('#editPicture').val(item['picture_url']);    
                            $('#editDescription').val(item['description']);
                            $('#editLatitude').val(item['latitude']);                                        
                            $('#editLongitude').val(item['longitude']);
                            $('#editAddress').val(item['address']);
                            $('#editPhone').val(item['phone']);
                            $('#editFax').val(item['fax']);
                            $('#editAddress').val(item['address']);
                            $('#editOpenTime').val(item['open_time']);
                            $('#editCloseTime').val(item['close_time']);
                            $('#sltEditMakeAppoint').val(item['allow_book_online']);
                        });
                    }
                },
                error: function(){
                    console.log("Lỗi lấy dữ liệu cửa hàng");
                }
            });
    }
  
    function deleteStore(storeId){
        $("#btnDel").click(function () {                    
            let url = 'del-store';
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type:'POST',
                data: {storeId : storeId},
                dataType : 'text',
                success: function(value){  
                    if (value == "Ok"){                                      
                        $.notify("Xóa cửa hàng thành công", {type:"success"});   
                        $('#modalDelete').modal('hide');      
                        getAllStores();                                                          
                    }else{
                        $.notify("Lỗi xóa cửa hàng", {color: "#fff", background: "#D44950"});  
                    }
                },
                error: function(){
                    $.notify("Lỗi xóa cửa hàng", {color: "#fff", background: "#D44950"});                           
                } 
            });            
        });
    }

    function getDistrict(){        
        $('#province').on('change', function() {            
            var provinceId = this.value;
            var url = 'get-district';         
            var html = "<option value='0'>--</option>";
            
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type:'GET',  
                data: {provinceId: provinceId},
                dataType : 'json',
                success: function(data){                
                    if(data.errorcode === 0 ){
                        $('#district').append(html);                        
                        $.notify("Không có dữ liệu quận/huyện", {color: "#fff", background: "#D44950"});
                    }else{                       
                        $('#district').empty();
                        console.log("---------------get district-----------------");                        
                        console.log(JSON.stringify(data));
                        $.each (data.data.districtList, function (key, item){   
                            html = "<option value='"+item['districtId']+"'>"+item['districtName']+"</option>"
                            $('#district').append(html);
                        });
                    }
                },
                error: function(){                    
                    $.notify("Lỗi lấy dữ liệu quận/huyện", {color: "#fff", background: "#D44950"});
                }
            });
        })
    }
});
</script>
<script>
    $(document).ready( function () {
        $('#tbStore').DataTable();
    } );
</script>
@endsection