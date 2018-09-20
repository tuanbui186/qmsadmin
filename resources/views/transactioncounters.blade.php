@extends('layouts.master')
@section('content')

        <!-- PAGE CONTENT WRAPPER -->
<div class="page-content">
    <!-- PAGE TITLE -->
    <div class="page-title">
        <h2><span class="fa fa-cogs"></span>QUẢN LÝ QUẦY GIAO DỊCH</small></h2>
</div>
        <!-- END PAGE TITLE -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <p>Chọn cửa hàng</p>        
                    <div class="form-group">
                        <div class="col-md-8">
                            <div class="input-group">
                                <select class="form-control" name="transPoint">                          
                                    <!-- <option value="0">
                                        Tất cả điểm giao dịch
                                    </option> -->
                                    <?php foreach($transPoint as $val){ ?>
                                        <option value="<?php echo $val->id; ?>">
                                            <?php echo $val->name; ?>
                                        </option>                                
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 right">
                            <button class="btn btn-success" data-toggle="modal" data-target="#modalAdd">Thêm quầy giao dịch</button>
                        </div>
                    </div>              
            </div>
        </div>
    </div> 
</div>
<div class="row">
<table class="table" id="tbTransCounter">
    <thead>
        <tr>
            <th>No</th>
            <th>Quầy giao dịch</th>
            <th>Thứ tự quầy</th>
            <th>Tình trạng</th>
            <th>Cửa hàng</th>  
            <th>Dịch vụ</th>   
            <th>Cấu hình</th>
        </tr>
    </thead>    
</table>
<!-- Start Add Modal -->
    <div class="modal fade " tabindex="-1" id="modalAdd" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="color: #6256a9; font-weight: bold">Thêm quầy giao dịch </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-2">
                            <label>Tên quầy giao dịch</label>
                        </div>
                        <div class="col-md-6 col-sm-2">
                            <input class="form-control" placeholder="Tên quầy giao dịch" id="addCounterName">
                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <div class="col-md-6 col-sm-2">
                            <label>Thứ tự quầy</label>
                        </div>
                        <div class="col-md-6 col-sm-2">
                        <input class="form-control" placeholder="Thứ tự quầy" id="addCounterSeq" maxlength="4">
                        </div>
                    </div>
                    </br>
                    {{-- <div class="row">
                        <div class="col-md-6 col-sm-2">
                            <label>Tình trạng</label>
                        </div>
                        <div class="col-md-6 col-sm-2">
                        <Select class="form-control" id="addStatusCounter">
                            <option value="0">Đóng</option>
                            <option value="1">Chờ giao dịch</option>                            
                            <option value="2">Đang gọi số</option>
                            <option value="3">Đang giao dịch</option>
                        </Select>
                        </div>
                    </div>
                    </br> --}}
                    <div class="row">
                        <div class="col-md-6 col-sm-2">
                            <label>Cửa hàng</label>
                        </div>
                        <div class="col-md-6 col-sm-2">
                            <select class="form-control" name="transPoint" id="addTransPoint">                                                             
                                    <?php foreach($transPoint as $val){ ?>
                                        <option value="<?php echo $val->id; ?>">
                                            <?php echo $val->name; ?>
                                        </option>                                
                                    <?php } ?>
                            </select>
                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <div class="col-md-6 col-sm-2">
                            <label>Dịch vụ</label>
                        </div>
                        <div class="col-md-6 col-sm-2">
                            <select class="multiSelection" multiple="multiple" id="addServiceList">
                                <?php foreach($service as $val){ ?>
                                    <option value="<?php echo $val->id; ?>">
                                        <?php echo $val->name; ?>
                                    </option>                                
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </br>
                <!--div style="font-size:10px;"-->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng lại</button>
                <button type="button" class="btn btn-primary" id="btnAddCounter">Đồng ý</button>
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
                <h4 class="modal-title" style="color: #6256a9; font-weight: bold">Chỉnh sửa quầy giao dịch </h4>
                <span id="editCounterId" hidden></span>
                <span id="editStoreId" hidden></span>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <label>Tên quầy giao dịch</label>
                    </div>
                    <div class="col-md-6 col-xs-6">
                    <input class="form-control" placeholder="Tên quầy giao dịch" id="editCounterName">
                    </div>
                </div>
                </br>
                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <label>Thứ tự quầy</label>
                    </div>
                    <div class="col-md-6 col-xs-6">
                    <input class="form-control" placeholder="Thứ tự quầy" id="editCounterSeq">
                    </div>
                </div>
                </br>
                {{-- <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <label>Tình trạng</label>
                    </div>
                    <div class="col-md-6 col-xs-6">
                    <Select class="form-control" id="editStatus">     
                        <option value="0">Đóng</option>
                        <option value="1">Chờ giao dịch</option>                            
                        <option value="2">Đang gọi số</option>
                        <option value="3">Đang giao dịch</option>               
                    </Select>
                    </div>
                </div>
                </br> --}}
                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <label>Dịch vụ</label>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <span id="curServiceList"></span>
                        </br>
                        <select class="multiSelection" multiple="multiple" id="editServiceList">
                            <?php foreach($service as $val){ ?>
                                <option value="<?php echo $val->id; ?>">
                                    <?php echo $val->name; ?>
                                </option>                                
                            <?php } ?>
                        </select>
                    </div>
                </div>
                </br>
                <!--div style="font-size:10px;"-->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng lại</button>
                <button type="button" class="btn btn-primary" id="btnEditCounter">Đồng ý</button>
            </div>
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
                <h4 class="modal-title" style="color: #6256a9; font-weight: bold">Xóa quầy giao dịch </h4>
            </div>
            <div class="modal-body">
                <p>
                    Bạn có chắc chắn xóa quầy giao dịch này?
                </p>
            </br>
            <!--div style="font-size:10px;"-->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Đóng lại</button>
            <button type="button" class="btn btn-primary" id="btnDelCounter">Đồng ý</button>
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
    var NOT_DEFINE = "-";
    getAllTransactionCounters();
    addTransactionCounter();
    editTransactionCounter();
    $("#modalEdit").on('show.bs.modal', function (event) {             
          var button = $(event.relatedTarget);
          var counterId = button.data('counterid');          
          $('#editCounterId').text(counterId);
          var storeId = button.data('storeid');          
          $('#editStoreId').text(storeId);           
          getTransactionCounter(counterId);          
    });
    $("#modalDelete").on('show.bs.modal', function (event) {     
          var button = $(event.relatedTarget);
          var counterId = button.data('counterid');       
          deleteTransactionCounter(counterId);
    });
    function getAllTransactionCounters(){
        var url = 'get-all-trans-counters';             
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
                    console.log(JSON.stringify(value));                                   
                    if(value.total === 0 ){
                        console.log("Không có dữ liệu");
                    }else{
                        let i = 1;
                        let status = "";                          
                        $("#tbTransCounter").DataTable().destroy(); 
                        $("#tbTransCounter tbody").empty();                        
                        $.each (value.data.counterList, function (key, item){ 
                            let serviceList = "";                            
                            $.each(item['serviceList'], function (key2, item2){
                                serviceList += "- "+item2['name']+"</br> ";
                            });
                            if(item['status'] == 0){
                                status = "Đóng";
                            }else if(item['status'] == 1){
                                status = "Chờ giao dịch";
                            }else if(item['status'] == 2){
                                status = "Đang gọi số";
                            }else if(item['status'] == 3){
                                status = "Đang giao dịch";	
                            }                                                                                                  
                            let html = "<tr>"+
                                            "<td>"+i+"</td>"+
                                            "<td>"+item['name']+"</td>"+
                                            "<td>"+item['seq']+"</td>"+                                            
                                            "<td>"+status+"</td>"+ 
                                            "<td>"+item['store'].name+"</td>"+                                            
                                            "<td>"+serviceList+"</td>"+   
                                            "<td>"+
                                                "<button class='btn btn-success' data-toggle='modal' data-counterid='"+item['id']+"' data-storeid='"+item['store'].id+"' data-target='#modalEdit'>Sửa</button>"+
                                                "<button class='btn btn-danger' data-toggle='modal' data-counterid='"+item['id']+"' data-storeid='"+item['store'].id+"' data-target='#modalDelete'>Xóa</button>"+
                                            "</td>"+
                                        "</tr>";                                    
                                    if(item['status'] === 1){
                                        $("#transPoint option[value=1]").prop('selected', 'selected');                             
                                    }else if (item['status'] === 0) {
                                        $("#transPoint option[value=0]").prop('selected', 'selected');   
                                    }                                        
                                $("#tbTransCounter tbody").append(html);                                
                                i++;
                        });
                        $("#tbTransCounter").DataTable();  
                    }
                },
                error: function(){
                    console.log("Lỗi lấy dữ liệu quầy giao dịch");
                }
            });
    }
    function addTransactionCounter(){
        $("#btnAddCounter").click(function () {                    
            let url = 'add-transaction-counter';            
            let addCounterName = $('#addCounterName').val();
            let addDevice = $("#addDevice").val();
            let addCounterSeq = $('#addCounterSeq').val();
            let addStatusCounter = $('#addStatusCounter').val();                        
            let addServiceList = $('#addServiceList').val(); 
            let addTransPoint = $('#addTransPoint').val();                  
                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: url,
                    type:'POST',
                    data: {addCounterName : addCounterName, addDevice: addDevice, addCounterSeq : addCounterSeq, addStatusCounter: addStatusCounter, addServiceList: addServiceList, addTransPoint: addTransPoint},
                    dataType : 'JSON',
                    success: function(value){   
                        console.log(JSON.stringify(value));
                        if(value.errorCode === 0){                                                     
                            $.notify("Thêm quầy thành công", {type:"success"});      
                            $('#modalAdd').modal('hide');    
                            getAllTransactionCounters();
                        }else if(value.errorCode === 2){
                            $.notify("Quầy đã tồn tại", {color: "#fff", background: "#D44950"});   
                            $('#modalAdd').modal('hide');     
                        }else{
                            $.notify("Lỗi thêm quầy", {color: "#fff", background: "#D44950"});
                        }

                    },
                    error: function(){
                        $.notify("Lỗi thêm quầy", {color: "#fff", background: "#D44950"});                           
                    }
                });                  
        });
    }
    function getTransactionCounter(counterId){  
        var url = 'get-transaction-counter';             
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type:'GET',  
                data: {counterId: counterId},
                dataType : 'json',
                success: function(data){                
                    if(data.errorCode !== 0 ){
                        console.log("Không có dữ liệu");
                    }else{
                        console.log("--------------------------------");                        
                        console.log(JSON.stringify(data));               
                        let arrService = "";
                            $('#editStatus').val(data.data.status);                                
                            $('#editCounterName').val(data.data.name);
                            $('#editCounterSeq').val(data.data.seq);                               
                            let serviceId = "";
                            let serviceName = "";
                            let serviceList = "";
                            // let arrService = "";
                            if(data.data.serviceList != null || data.data.serviceList != ""){
                                $.each(data.data.serviceList, function (key2, item2){ 
                                    if(item2['id'] === null || item2['id'] === ""){
                                        serviceId = NOT_DEFINE;
                                    }else{
                                        serviceId = item2['id'];
                                    }
                                    if(item2['name'] === null || item2['name'] === ""){
                                        serviceName = NOT_DEFINE;
                                    }else{
                                        serviceName = item2['name'];
                                    }
                                    // arrService.push(serviceId);
                                    serviceList += serviceName +", ";                                   
                                });
                                
                                $('#curServiceList').text(serviceList);
                                // $('#editServiceList').val(JSON.stringify(arrService));
                            }
                        
                    }
                },
                error: function(){
                    console.log("Lỗi lấy dữ liệu quầy giao dịch");
                }
            });
    }
    function editTransactionCounter(){
        $("#btnEditCounter").click(function () {                    
            let url = 'edit-transaction-counter';
            let counterId = $('#editCounterId').text();
            let storeId = $('#editStoreId').text();
            let deviceId = $('#editDevice').text();
            let counterName = $('#editCounterName').val();
            let counterSeq = $('#editCounterSeq').val();
            let statusCounter = $('#editStatus').val();
            let sltServiceList = $('#editServiceList').val();              
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type:'POST',
                data: {counterId: counterId, storeId: storeId, deviceId: deviceId, counterName : counterName, counterSeq : counterSeq, statusCounter: statusCounter, sltServiceList: sltServiceList},
                dataType : 'json',
                success: function(value){   
                    if(value.errorCode === "0"){                                                     
                        $.notify("Chỉnh sửa quầy thành công", {type:"success"}); 
                        $('#modalEdit').modal('hide');      
                        getAllTransactionCounters();                                                     
                    }else {
                        $.notify("Lỗi chỉnh sửa quầy", {color: "#fff", background: "#D44950"});      
                    }
                },
                error: function(){
                    $.notify("Lỗi chỉnh sửa quầy", {color: "#fff", background: "#D44950"});                           
                }
            });                  
        });
    }
    function deleteTransactionCounter(counterId){
        $("#btnDelCounter").click(function () {                    
            console.log(counterId);
            let url = 'del-transaction-counter';
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type:'POST',
                data: {counterId : counterId},
                dataType : 'JSON',
                success: function(value){                     
                    if (value.errorCode == "0"){                                      
                        $.notify("Xóa quầy giao dịch thành công", {type:"success"});   
                        $('#modalDelete').modal('hide');      
                        getAllTransactionCounters();                                                          
                    }else{
                        $.notify("Lỗi xóa quầy giao dịch", {color: "#fff", background: "#D44950"});  
                    }
                },
                error: function(){
                    $.notify("Lỗi xóa quầy giao dịch", {color: "#fff", background: "#D44950"});                           
                } 
            });            
        });
    }
});
</script>
<script>
$(document).ready( function () {
    $('#tbTransCounter').DataTable();
} );
</script>
@endsection