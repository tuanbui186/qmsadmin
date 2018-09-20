@extends('layouts.master')
@section('content')

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content">
    <!-- PAGE TITLE -->
    <div class="page-title">
        <h2><span class="fa fa-cogs"></span>QUẢN LÝ DỊCH VỤ</small></h2>        
    </div>
    <!-- END PAGE TITLE -->    
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-body">
                    <p>Chọn cửa hàng</p>
                        <div class="form-group">
                            <div class="col-md-8">
                                <select class="form-control" id="sltStore">
                                    <option value='0'>
                                        Mặc định
                                    </option>
                                    @foreach ($stores as $item)
                                        <option value="<?php echo $item->id; ?>">
                                            <?php echo $item->name; ?>
                                        </option>  
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 right">
                                <button  class="btn btn-success" id="addService">Thêm dịch vụ</button>
                            </div>
                        </div>                    
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <table class="table" id="tbServiceConfig">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Hình ảnh</th>                                 
                    <th>Tên dịch vụ</th>                           
                    <th>Số khởi tạo</th>              
                    <th>Số tối đa</th>
                    <th>Cấu hình</th>
                </tr>
            </thead>
            <tbody>                
            </tbody>
        </table>
    </div>
    <!-- Start Edit Image Modal -->        
    <div class="modal fade" tabindex="-1" id="modalEditImage" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="color: #6256a9; font-weight: bold">Chỉnh sửa hình ảnh</h4>
                </div>
                <form method="post" action="{{ url('edit-image-service') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body">                       
                    <div class="row">
                        <input name="txtServiceId" id="serviceId" hidden="">
                        <div class="col-md-6 col-xs-6">
                            <label>Hình ảnh</label>                        
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <label for="imageInput"><i>Chọn hình đại diện dịch vụ</i></label>
                            <input data-preview="#preview" name="txtUploadImage" type="file" id="addImageInput">
                            <img class="col-sm-6" id="preview"  src="" ></img>
                            <p class="help-block"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng lại</button>
                    <button type="submit" class="btn btn-primary" id="btnEditImage" name='upload_image'>Đồng ý</button>
                </div>
                </form>
            </div>
        </div>
    </div>  
    <!-- End Edit Image Modal -->     

    <!-- Start Add Modal -->        
    <div class="modal fade" tabindex="-1" id="modalAddService" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="color: #6256a9; font-weight: bold">Thêm dịch vụ</h4>
                </div>
                <form method="post" action="{{ url('add-service') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">                       
                        <div class="row">                           
                            <input id="storeId" hidden="">
                            <div class="col-md-6 col-xs-6">
                                <label>Dịch vụ</label>                        
                            </div>
                            <div class="col-md-6 col-xs-6">   
                                <select class="form-control" id="sltService">
                                    <option>
                                        Chọn dịch vụ ...
                                    </option>
                                </select>                       
                            </div>
                        </div>
                        </br>
                        <div class="row">                                
                            <div class="col-md-6 col-xs-6">
                                <label>Số khởi tạo</label>                        
                            </div>
                            <div class="col-md-6 col-xs-6">   
                                <input class="form-control" placeholder="1000" id="addInitSeq">                     
                            </div>
                        </div>
                        </br>
                        <div class="row">                                
                            <div class="col-md-6 col-xs-6">
                                <label>Số tối đa</label>                        
                            </div>
                            <div class="col-md-6 col-xs-6">   
                                <input class="form-control" placeholder="1999" id="addMaxSeq">                     
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                        <button type="button" class="btn btn-primary" id="btnAddServiceOfStore" name='btnAddServiceOfStore'>Xác nhận</button>
                    </div>
                </form>
                </hr>
                <div style="text-align: center">Hoặc</div>
                <div class="modal-body">
                    <div class="row">
                        <button  class="btn btn-success btn-block" data-toggle='modal' data-target='#modalCreateService'>Tạo mới dịch vụ </button>
                    </div>
                </div>                    
            </div>               
        </div>
    </div>  
    <!-- End Add Modal -->    

    <!-- Start Create Service Modal -->        
    <div class="modal fade" tabindex="-1" id="modalCreateService" role="dialog">
        <div class="modal-dialog">
                <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="color: #6256a9; font-weight: bold">Tạo mới dịch vụ</h4>
                </div>
                <form method="post" action="{{ url('add-service') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">                       
                        <div class="row">
                            <input name="txtServiceId" id="serviceId" hidden="">
                            <div class="col-md-6 col-xs-6">
                                <label>Dịch vụ</label>                        
                            </div>
                            <div class="col-md-6 col-xs-6">   
                                <input class="form-control" placeholder="Dịch vụ Internet" id="createServiceName">                      
                            </div>
                        </div>
                        </br>
                        <div class="row">                                
                            <div class="col-md-6 col-xs-6">
                                <label>Số khởi tạo <span style="color:red;">*</span></label>                        
                            </div>
                            <div class="col-md-6 col-xs-6">   
                                <input class="form-control" placeholder="Điền số khởi tạo" id="createInitSeq">                     
                            </div>
                        </div>
                        </br>
                        <div class="row">                                
                            <div class="col-md-6 col-xs-6">
                                <label>Số tối đa <span style="color:red;">*</span></label>                        
                            </div>
                            <div class="col-md-6 col-xs-6">   
                                <input class="form-control" placeholder="Điền số tối đa" id="createMaxSeq">                     
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                        <button type="button" class="btn btn-primary" id="btnCreateService" name="btnCreateService">Xác nhận</button>
                    </div>                
                </form>                
            </div>                               
        </div>
    </div>  
    <!-- End Create Service Modal -->       

    <!-- Start Edit Modal -->
    <div class="modal fade " tabindex="-1" id="modalEdit" role="dialog">
            <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title" style="color: #6256a9; font-weight: bold">Chỉnh sửa dịch vụ</h4>
                        </div>
                        <form method="post" action="{{ url('edit-service') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="modal-body"> 
                                    <input class="form-control" placeholder="Dịch vụ Internet" id="editLogoUrl" hidden="">                       
                                <div class="row">
                                    <input name="txtServiceId" id="editServiceId" hidden="">
                                    <div class="col-md-6 col-xs-6">
                                        <label>Dịch vụ</label>                        
                                    </div>
                                    <div class="col-md-6 col-xs-6">   
                                        <input class="form-control" placeholder="Dịch vụ Internet" id="editServiceName">                      
                                    </div>
                                </div>
                                </br>
                                <div class="row">                                
                                    <div class="col-md-6 col-xs-6">
                                        <label>Số khởi tạo</label>                        
                                    </div>
                                    <div class="col-md-6 col-xs-6">   
                                        <input class="form-control" placeholder="1000" id="editInitSeq">                     
                                    </div>
                                </div>
                                </br>
                                <div class="row">                                
                                    <div class="col-md-6 col-xs-6">
                                        <label>Số tối đa</label>                        
                                    </div>
                                    <div class="col-md-6 col-xs-6">   
                                        <input class="form-control" placeholder="1999" id="editInitMax">                     
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                                <button type="button" class="btn btn-primary" id="btnEditService" name='btnEditService'>Xác nhận</button>
                            </div>
                        </form>                
                    </div>               
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
                        <h4 class="modal-title" style="color: #6256a9; font-weight: bold">Xóa dịch vụ </h4>
                    </div>
                    <div class="modal-body">
                        <p>
                            Bạn có chắc chắn xóa dịch vụ này?
                        </p>                    
                    </div>                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng lại</button>
                    <button type="button" class="btn btn-primary" id="btnDelService">Đồng ý</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete Modal -->         
</div>
<script type="text/javascript" src="{{ URL::asset('public/js/jquery.form.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function() {
    showServices();    
    choiceStore();
    addAllServices();
    editService();
    $("#modalAddService").on('show.bs.modal', function (event) {     
        var storeId = $('#sltStore').val();
        $("#storeId").val(storeId);
       
    });
    $("#modalCreateService").on('show.bs.modal', function (event) {     
        var storeId = $('#sltStore').val();
        $("#storeId").val(storeId);       
        if(storeId == 0){
            console.log("Tạo mới dịch vụ mặc định");
            createService();
        }else{
            console.log("Tạo mới dịch vụ thuộc cửa hàng");
            createServiceOfStore(storeId);
        }        
    });
    $("#modalEdit").on('show.bs.modal', function (event) {     
          var button = $(event.relatedTarget);
          var editid = button.data('editid');   
          $("#editServiceId").val(editid);       
          getService(editid);          
    });
    $("#modalDelete").on('show.bs.modal', function (event) {     
          var button = $(event.relatedTarget);
          var serviceId = button.data('delid');       
          var storeId = button.data('storeid');
          if(storeId == 0){                
                deleteService(serviceId);
          }else{                
                deleteServiceOfStore(serviceId, storeId);
          }
    });
    $("#modalEditImage").on('show.bs.modal', function (event) {     
          var button = $(event.relatedTarget);
          var serviceid = button.data('serviceid');
          $('#serviceId').val(serviceid);          
    });

    function addAllServices(){
        $("#addService").click(function() {
           var storeId = $("#sltStore").val();                
           if(storeId == 0){            
                $("#modalCreateService").modal('show');            
           }else{
                $("#modalAddService").modal('show');            
                addServiceOfStore(storeId);
                getServiceNotInStore(storeId);
           }
        });
    }
    function showServices(){
        var url = 'show-services';             
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
                    if (data.errorCode !== 0){
                        console.log("Không có dữ liệu");
                    }else{
                        $("#tbServiceConfig").DataTable().destroy();
                        $("#tbServiceConfig tbody").empty();
                        let i = 1;
                        let img = "";
                        let init_seq = "";
                        let current_seq = "";
                        let max_seq = "";
                        let NOT_DEFINE = "-";
                        $.each (data.data.serviceList, function (key, item){  
                        if (item['logoUrl'] == "" || item['logoUrl'] == null){
                            img = "<span style='color: red'>Chưa có hình ảnh</span>";
                        }else{
                            img = "<img class='col-sm-6' style='cursor: pointer' height='50' width='50' data-toggle='modal' data-target='#modalEditImage' src='"+item['logoUrl']+"' data-serviceid="+item['id']+"></img>";
                        }
                        if (item['defaultInitSeq'] == "" || item['defaultInitSeq'] == null){
                            init_seq = NOT_DEFINE;
                        }else{
                            init_seq = item['defaultInitSeq'];
                        }
                        if (item['current_seq'] == "" || item['current_seq'] == null){
                            current_seq = NOT_DEFINE;
                        }else{
                            current_seq = item['current_seq'];
                        }
                        if (item['defaultMaxSeq'] == "" || item['defaultMaxSeq'] == null){
                            max_seq = NOT_DEFINE;
                        }else{
                            max_seq = item['defaultMaxSeq'];
                        }
                        let html = "<tr>" +
                                        "<td>"+i+"</td>" +
                                        "<td>"+img+"</td>" +
                                        "<td>"+item['name']+"</td>" +                                                                                                                      
                                        "<td><span style='font-size: 20px'>"+init_seq+"</span></td>" +                                        
                                        "<td><span style='font-size: 20px'>"+max_seq+"</span></td>" +
                                        "<td>" +
                                            "<button class='btn btn-success' data-toggle='modal' data-target='#modalEdit' data-editid="+item['id']+">Sửa</button>" +
                                            "<button class='btn btn-danger' data-toggle='modal' data-target='#modalDelete' data-storeid='0' data-delid="+item['id']+">Xóa</button>" +
                                        "</td>" +
                                    "</tr>";
                        i++;   
                        $("#tbServiceConfig tbody").append(html);
                        });      
                        $("#tbServiceConfig").DataTable();  
                    }
                },
                error: function(){
                    console.log("Lỗi lấy dữ liệu dịch vụ");
                }
        });
    }
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function getServices(e) {
                $('#preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#addImageInput").change(function(){
        readURL(this);
    });    
    $("#editImageInput").change(function(){
        readURL(this);
    });

    function addServiceOfStore(storeId){        
        $("#btnAddServiceOfStore").click(function () {
            // var storeId = $('#sltStore').val();
            var serviceId = $("#sltService").val();
            var initSeq = $("#addInitSeq").val();    
            var maxSeq = $("#addMaxSeq").val();                        
            var url = 'add-service-of-store';
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type:'POST',
                data: {storeId: storeId, serviceId: serviceId, initSeq: initSeq, maxSeq: maxSeq},
                dataType : 'json',
                success: function(value){     
                    console.log("-----------Thêm dịch vụ cho cửa hàng -------------");    
                    console.log(JSON.stringify(value));           
                    getServiceOfStore(storeId);
                    console.log("Thêm dịch vụ thành công");
                    $('#modalAddService').modal('hide');                    
                },
                error: function(){
                    console.log("Lỗi thêm dịch vụ");
                }
            });            
        });
    }    
    function getService(serviceId){
        let url = 'get-service';                     
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            type:'GET',        
            dataType : 'json',
            data: {serviceId : serviceId},
            success: function(data){  
                console.log(JSON.stringify(data));                                                 
                    $('#editServiceName').val(data.data.name);
                    $('#editInitSeq').val(data.data.defaultInitSeq);
                    $('#editInitMax').val(data.data.defaultMaxSeq);                            
                    $('#editLogoUrl').val(data.data.logoUrl); 
            },
            error: function() {
                console.log("Lỗi lấy dữ liệu dịch vụ");
            }
        });
    }
    function editService(){
        $("#btnEditService").click(function () {                    
            let url = 'edit-service';
            let editServiceId = $('#editServiceId').val();
            let editServiceName = $('#editServiceName').val();
            let editInitSeq = $('#editInitSeq').val();
            let editInitMax = $('#editInitMax').val();                                  
            let editLogoUrl = $('#editLogoUrl').val();
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type:'POST',
                data: {editServiceId: editServiceId, editServiceName: editServiceName, editInitSeq: editInitSeq, editInitMax: editInitMax, editLogoUrl: editLogoUrl},
                dataType : 'json',
                success: function(value){   
                    if(value.errorCode == 0){                                                     
                        $.notify("Chỉnh sửa quầy thành công", {type:"success"}); 
                        $('#modalEdit').modal('hide');      
                        showServices();                                                     
                    }
                },
                error: function(){
                    $.notify("Lỗi chỉnh sửa quầy", {color: "#fff", background: "#D44950"});                           
                }
            });                  
        });
    }

    function getServiceNotInStore(storeId){      
    let url = 'get-service-not-in-store';             
    // let storeId = $('#storeId').val();    
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            type:'GET',        
            dataType : 'json',
            data: {storeId : storeId},
            success: function(value){  
                console.log(JSON.stringify(value.data.serviceList));
                var html = "";
                $('#sltService').empty();
                $.each (value.data.serviceList, function (key, item){ 
                    html = "<option value='"+item['id']+"'>"+item['name']+"</option>";
                    $('#sltService').append(html);
                });
            },
            error: function(){
                console.log("Lỗi lấy dữ liệu dịch vụ");
            }
        });
    }

    function getServiceOfStore(storeId){
        var url = 'get-service-of-store';             
                $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });
              $.ajax({
                url: url,
                type:'GET',        
                dataType : 'json',
                data: {storeId : storeId},
                success: function(data){  
                    console.log(JSON.stringify(data));
                    if (data.errorCode !== 0){
                        console.log("Không có dữ liệu");
                    }else{
                        $("#tbServiceConfig").DataTable().destroy();
                        $("#tbServiceConfig tbody").empty();
                        let i = 1;
                        let img = "";
                        let init_seq = "";
                        let current_seq = "";
                        let max_seq = "";
                        let NOT_DEFINE = "-";
                        $.each (data.data.serviceList, function (key, item){  
                        if (item['logoUrl'] == "" || item['logoUrl'] == null){
                            img = "<span style='color: red'>Chưa có hình ảnh</span>";
                        }else{
                            img = "<img class='col-sm-6' style='cursor: pointer' height='50' width='50' data-toggle='modal' data-target='#modalEditImage' src='"+item['logoUrl']+"' data-serviceid="+item['id']+"></img>";
                        }
                        if (item['defaultInitSeq'] == "" || item['defaultInitSeq'] == null){
                            init_seq = NOT_DEFINE;
                        }else{
                            init_seq = item['defaultInitSeq'];
                        }
                        if (item['current_seq'] == "" || item['current_seq'] == null){
                            current_seq = NOT_DEFINE;
                        }else{
                            current_seq = item['current_seq'];
                        }
                        if (item['defaultMaxSeq'] == "" || item['defaultMaxSeq'] == null){
                            max_seq = NOT_DEFINE;
                        }else{
                            max_seq = item['defaultMaxSeq'];
                        }
                        let html = "<tr>" +
                                        "<td>"+i+"</td>" +
                                        "<td>"+img+"</td>" +
                                        "<td>"+item['name']+"</td>" +                                                                                                                      
                                        "<td><span style='font-size: 20px'>"+init_seq+"</span></td>" +                                        
                                        "<td><span style='font-size: 20px'>"+max_seq+"</span></td>" +
                                        "<td>" +
                                            "<button class='btn btn-success' data-toggle='modal' data-target='#modalEdit' data-editid="+item['id']+">Sửa</button>" +
                                            "<button class='btn btn-danger' data-toggle='modal' data-target='#modalDelete' data-storeid="+storeId+" data-delid="+item['id']+">Xóa</button>" +
                                        "</td>" +
                                    "</tr>";
                        i++;   
                        $("#tbServiceConfig tbody").append(html);
                        });      
                        $("#tbServiceConfig").DataTable();  
                    }
                },
                error: function(){
                    console.log("Lỗi lấy dữ liệu dịch vụ");
                }
        });
    }

    function createService(){
        $("#btnCreateService").click(function () {
            // var storeId = $('#sltStore').val();            
            var serviceName = $("#createServiceName").val();
            var initSeq = $("#createInitSeq").val();    
            var maxSeq = $("#createMaxSeq").val();                        
            var url = 'create-service';
            alert(serviceName +" "+ initSeq +" "+ maxSeq);
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type:'POST',
                data: {serviceName: serviceName, initSeq: initSeq, maxSeq: maxSeq},
                dataType : 'json',
                success: function(value){     
                    console.log("-----------Thêm dịch vụ cho cửa hàng -------------");    
                    console.log(JSON.stringify(value));           
                    showServices();
                    console.log("Tạo dịch vụ mới thành công");
                    $('#modalCreateService').modal('hide');                    
                },
                error: function(){
                    console.log("Lỗi tạo dịch vụ");
                }
            });            
        });
    }

    function createServiceOfStore(storeId){
        $("#btnCreateService").click(function () {
            console.log("Tạo mới dịch vụ cho cửa hàng");
            var serviceName = $("#addServiceName").val();
            var initSeq = $("#addInitSeq").val();    
            var maxSeq = $("#addMaxSeq").val();                        
            var url = 'create-service-of-store';
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type:'POST',
                data: {storeId: storeId, serviceName: serviceName, initSeq: initSeq, maxSeq: maxSeq},
                dataType : 'json',
                success: function(value){     
                    console.log("-----------Thêm dịch vụ cho cửa hàng -------------");    
                    console.log(JSON.stringify(value));           
                    getServiceOfStore(storeId);
                    console.log("Tạo dịch vụ mới cho cửa hàng thành công");
                    $('#modalCreateService').modal('hide');                    
                },
                error: function(){
                    console.log("Lỗi tạo dịch vụ mới");
                }
            });            
        });
    }
    //Choice some Store
    function choiceStore(){
        $('#sltStore').on('change', function() {                 
            if (this.value == 0){
                showServices();
            }else{
                getServiceOfStore(this.value);
            }
        })
    }
    function deleteService(serviceId){
        $("#btnDelService").click(function () {            
            var url = 'del-service';
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type:'POST',
                data: {serviceId : serviceId},
                dataType : 'json',
                success: function(value){ 
                    console.log(value);
                    showServices();                                        
                    $.notify("Xóa dịch vụ thành công", {type:"success"});  
                    $('#modalDelete').modal('hide');                    
                },
                error: function(){
                    $.notify("Lỗi xóa dịch vụ", {color: "#fff", background: "#D44950"});
                }
            });            
        });
    }
    function deleteServiceOfStore(serviceId, storeId){
        $("#btnDelService").click(function () {                 
            var url = 'del-service-of-store';
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type:'POST',
                data: {serviceId : serviceId, storeId : storeId},
                dataType : 'json',
                success: function(value){   
                    console.log(JSON.stringify(value));
                    getServiceOfStore(storeId);                 
                    $.notify("Xóa dịch vụ của cửa hàng thành công", {type:"success"});  
                    $('#modalDelete').modal('hide');                    
                },
                error: function(){
                    $.notify("Lỗi xóa dịch vụ của cửa hàng", {color: "#fff", background: "#D44950"});
                }
            });            
        });
    }
    
});
</script>
<script>
$(document).ready( function () {
    $('#tbServiceConfig').DataTable();
} );
</script>
@endsection