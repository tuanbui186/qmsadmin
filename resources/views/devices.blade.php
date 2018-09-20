@extends('layouts.master')
@section('content')

        <!-- PAGE CONTENT WRAPPER -->
<div class="page-content">
    <!-- PAGE TITLE -->
    <div class="page-title">
        <h2><span class="fa fa-cogs"></span>QUẢN LÝ THIẾT BỊ</small></h2>
</div>
        <!-- END PAGE TITLE -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <p>Chọn điểm giao dịch</p>        
                    <div class="form-group">
                        <div class="col-md-8">
                            <div class="input-group">
                                <select class="form-control" name="transPoint" disabled>                          
                                    <!-- <option value="0">
                                        Tất cả điểm giao dịch
                                    </option> -->
                                    <?php foreach($transPoint as $val){ ?>
                                        <option value="<?php echo $val->trans_point_id; ?>">
                                            <?php echo $val->trans_point_name; ?>
                                        </option>                                
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 right">
                            <button class="btn btn-success" data-toggle="modal" data-target="#modalAdd">Thêm thiết bị</button>
                        </div>
                    </div>              
            </div>
        </div>
    </div> 
</div>
<div class="row">
<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Tên thiết bị</th>
            <th>API Key</th>
            <th>Loại thiết bị</th>
            <th>Thời điểm tạo</th>     
            <th>Thời điểm chỉnh sửa</th>
        </tr>
    </thead>
    <tbody id="tbDevices"> 
    </tbody>
</table>
<!-- Start Add Modal -->
    <div class="modal fade " tabindex="-1" id="modalAdd" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="color: #6256a9; font-weight: bold">Thêm thiết bị </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-xs-6">
                            <label>Tên thiết bị</label>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <input class="form-control" placeholder="Tên thiết bị" id="deviceName">
                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <div class="col-md-6 col-xs-6">
                            <label>Loại thiết bị</label>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <select class="form-control" id="deviceType">                                                  
                                <?php foreach($device as $val){ ?>
                                    <option value="<?php echo $val->device_type_id; ?>">
                                        <?php echo $val->device_type_name; ?>
                                    </option>                                
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    </br>                    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng lại</button>
                <button type="button" class="btn btn-primary" id="btnAddDevice">Đồng ý</button>
            </div>
        </div>
    </div>
<!-- End Add Modal -->  
</div>
<!-- Start Edit Modal -->
<div class="modal fade " tabindex="-1" id="modalEdit" role="dialog">
<div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" style="color: #6256a9; font-weight: bold">Chỉnh sửa tên thiết bị </h4>
            <span id="editDeviceId" hidden></span>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6 col-xs-6">
                    <label>Tên thiết bị</label>
                </div>
                <div class="col-md-6 col-xs-6">
                <input class="form-control" placeholder="Tên thiết bị" id="editDeviceName">
                </div>
            </div>
            </br>
            <div class="row">
                <div class="col-md-6 col-xs-6">
                    <label>Loại thiết bị</label>
                </div>
                <div class="col-md-6 col-xs-6">                
                    <select class="form-control" id="editDeviceType">                                                  
                        <?php foreach($device as $val){ ?>
                            <option value="<?php echo $val->device_type_id; ?>">
                                <?php echo $val->device_type_name; ?>
                            </option>                                
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>            
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Đóng lại</button>
            <button type="button" class="btn btn-primary" id="btnEditDevice">Đồng ý</button>
        </div>
    </div>
</div>
<!-- End Edit Modal -->
</div>
<!-- Start Delete Modal -->
<div class="modal fade " tabindex="-1" id="modalDelete" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="color: #6256a9; font-weight: bold">Xóa thiết bị</h4>
            </div>
            <div class="modal-body">
                <p>
                    Bạn có chắc chắn xóa thiết bị này?
                </p>
            </br>
            <!--div style="font-size:10px;"-->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Đóng lại</button>
            <button type="button" class="btn btn-primary" id="btnDelDevice">Đồng ý</button>
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

    getAllDevices();
    addDevice();
    editDevice();
    $("#modalEdit").on('show.bs.modal', function (event) {             
          var button = $(event.relatedTarget);
          var deviceId = button.data('id');          
          $('#editDeviceId').text(deviceId);          
          getDevice(deviceId);          
    });
    $("#modalDelete").on('show.bs.modal', function (event) {     
          var button = $(event.relatedTarget);
          var deviceId = button.data('id');       
          deleteDevice(deviceId);
    });
    function getAllDevices(){
        var url = 'get-all-devices';             
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
                    // $("#tbTransCounter tbody").empty();                
                    if(data === "" ){
                        console.log("Không có dữ liệu");
                    }else{
                        console.log(JSON.stringify(data));
                        let i = 1;
                        let status = "";    
                        $("#tbDevices").empty();
                        $.each (data, function (key, item){                        
                            let html = "<tr>"+
                                            "<td>"+i+"</td>"+
                                            "<td>"+item['device_name']+"</td>"+
                                            "<td>"+item['api_key']+"</td>"+
                                            "<td>"+item['device_type_name']+"</td>"+                                                                                        
                                            "<td>"+item['created_tst']+"</td>"+
                                            "<td>"+item['last_modified_tst']+"</td>"+
                                            "<td>"+
                                                "<button class='btn btn-success' data-toggle='modal' data-id='"+item['device_id']+"' data-target='#modalEdit'>Sửa</button>"+
                                                "<button class='btn btn-danger' data-toggle='modal' data-id='"+item['device_id']+"' data-target='#modalDelete'>Xóa</button>"+
                                            "</td>"+
                                        "</tr>";                                                                        
                                $("#tbDevices").append(html);                                
                                i++;
                        });
                    }
                },
                error: function(){
                    console.log("Lỗi lấy dữ liệu quầy giao dịch");
                }
            });
    }
    function addDevice(){
        $("#btnAddDevice").click(function () {                    
            let url = 'add-device';
            let deviceName = $('#deviceName').val();
            let deviceTypeId = $('#deviceType').val();                                    
                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: url,
                    type:'POST',
                    data: {deviceName : deviceName, deviceTypeId : deviceTypeId},
                    dataType : 'text',
                    success: function(value){   
                        if(value === "Ok"){                                                     
                            $.notify("Thêm quầy thành công", {type:"success"});      
                            $('#modalAdd').modal('hide');    
                            getAllDevices();
                        }else {
                            $.notify("Lỗi thêm quầy", {color: "#fff", background: "#D44950"});      
                        }
                    },
                    error: function(){
                        $.notify("Lỗi thêm quầy", {color: "#fff", background: "#D44950"});                           
                    }
                });                  
        });
    }
    function getDevice(deviceId){  
        var url = 'get-device';             
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type:'GET',  
                data: {deviceId: deviceId},
                dataType : 'json',
                success: function(data){                
                    if(data === "" ){
                        console.log("Không có dữ liệu");
                    }else{                     
                        console.log(JSON.stringify(data));
                        let status = "";                            
                        let arrService = [];                   
                        let serviceList = "";
                        $.each (data, function (key, item){                                                            
                            $('#editDeviceName').val(item['device_name']);
                            $('#editDeviceType').val(item['device_type_id']);                               
                        });
                    }
                },
                error: function(){
                    console.log("Lỗi lấy dữ liệu thiết bị");
                }
            });
    }
    function editDevice(){
        $("#btnEditDevice").click(function () {                    
            let url = 'edit-device';
            let deviceId = $('#editDeviceId').text();
            let deviceName = $('#editDeviceName').val();
            let deviceTypeId = $('#editDeviceType').val();
           
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type:'POST',
                data: {deviceId: deviceId, deviceName : deviceName, deviceTypeId : deviceTypeId},
                dataType : 'text',
                success: function(value){   
                    if(value === "Ok"){                                                     
                        $.notify("Chỉnh sửa thiết bị", {type:"success"}); 
                        $('#modalEdit').modal('hide');      
                        getAllDevices();                                                     
                    }else {
                        $.notify("Lỗi chỉnh sửa thiết bị", {color: "#fff", background: "#D44950"});      
                    }
                },
                error: function(){
                    $.notify("Lỗi chỉnh sửa thiết bị", {color: "#fff", background: "#D44950"});                           
                }
            });                  
        });
    }
    function deleteDevice(deviceId){
        $("#btnDelDevice").click(function () {                    
            let url = 'del-device';
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type:'POST',
                data: {deviceId : deviceId},
                dataType : 'text',
                success: function(value){  
                    if (value == "Ok"){                                      
                        $.notify("Xóa thiết bị thành công", {type:"success"});   
                        $('#modalDelete').modal('hide');      
                        getAllDevices();                                                          
                    }else{
                        $.notify("Lỗi xóa thiết bị", {color: "#fff", background: "#D44950"});  
                    }
                },
                error: function(){
                    $.notify("Lỗi xóa thiết bị", {color: "#fff", background: "#D44950"});                           
                } 
            });            
        });
    }
});
</script>
<!-- End Get Transaction Counter-->
@endsection