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
        echo getCurrentURL();

    ?>
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content">
        <!-- PAGE TITLE -->
        <div class="page-title">
            <h2><span class="fa fa-users"></span> Danh sách các cửa hàng </h2>
        </div>
        <!-- END PAGE TITLE -->
        <div class="row" id="getStore">
  
        </div>   
  
    </div>
    <!-- END PAGE CONTENT WRAPPER -->
    
<script>
    $( function() {
        $( ".datepicker" ).datepicker();     
    } );
</script>    
<script>
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
</script>
<script>
    getStore();
    function getStore(){
        var url = 'get-stores';      
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
          let status_book = "";
            $.each (value.data.storeList, function (key, item){                
                if(item['allow_book_online'] == 1){
                    status_book = "Cho phép đặt lịch";
                }else if(item['allow_book_online'] == 0){
                    status_book = "Không cho phép đặt lịch";
                }                
                let htmlStore = "<a href='show-all-employee/"+item['id']+"'>"+
                                    "<div class='col-md-3' style='cursor: pointer'>"+
                                        "<div class='panel panel-default'>"+
                                            "<div class='panel-body profile'>"+
                                                "<div class='profile-image'>"+
                                                    "<img src='"+item['pictureUrl']+"' height='50' width='50'/>"+
                                                "</div>"+
                                                "<div class='profile-data'>"+
                                                    "<div class='profile-data-name'>"+
                                                        item['name'] +
                                                    "</div>"+
                                                    "<div class='profile-data-title'>"+
                                                       "Mở cửa:"+ item['openTime'] +", Đóng cửa:"+ item['closeTime']+
                                                    "</div>"+         
                                                    "<div class='profile-data-title'>"+
                                                        item['phone'] +
                                                    "</div>"+      
                                                    "<div class='profile-data-title'>"+
                                                        status_book+
                                                    "</div>"+                                       
                                                "</div>"+
                                            "</div>"+
                                            "<div class='panel-body'>"+
                                                "<div class='contact-info'>"+
                                                "</div>"+
                                            "</div>"+
                                        "</div>"+      
                                    "</div>"
                                "</a>";
                  $("#getStore").append(htmlStore);
            });     
        },
        error: function(){
          console.log('Không lấy được dữ liệu');
        }
      });
    }
</script>
@endsection