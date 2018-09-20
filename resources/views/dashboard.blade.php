@extends('layouts.master')
@section('content')
    <script src="{{ URL::asset('public/js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{ URL::asset('public/js/highcharts.js')}}"></script>
    <script src="{{ URL::asset('public/js/highcharts-more.js')}}"></script>
    <script src="{{ URL::asset('public/js/exporting.js')}}"></script>
            <!-- PAGE CONTENT -->
            <div class="page-content">                
                <!-- START X-NAVIGATION VERTICAL -->
                <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
                    <!-- TOGGLE NAVIGATION -->
                    <li class="xn-icon-button">
                        <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
                    </li>
                    <!-- END TOGGLE NAVIGATION -->
                    <!-- SEARCH -->
                    <li class="xn-search">
                        <form role="form">
                            <input type="text" name="search" placeholder="Tìm kiếm..."/>
                        </form>
                    </li>   
                    <!-- END SEARCH -->
                    <!-- SIGN OUT -->
                    <li class="xn-icon-button pull-right">
                        <a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span></a>                        
                    </li> 
                    <!-- END SIGN OUT -->
                    <!-- MESSAGES -->
                    <li class="xn-icon-button pull-right">
                        <a href="#"><span class="fa fa-comments"></span></a>
                        <div class="informer informer-danger">4</div>
                        <div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
                            <div class="panel-heading">
                                <h3 class="panel-title"><span class="fa fa-comments"></span> Giao dịch</h3>
                                <div class="pull-right">
                                    <span class="label label-danger" id="countTrans2"></span>giao dịch mới
                                </div>
                            </div>
                            <div class="panel-body list-group list-group-contacts scroll" style="height: 200px;">
                            </div>     
                            <div class="panel-footer text-center">
                                <a href="pages-messages.html">Hiển thị tất cả giao dịch</a>
                            </div>                            
                        </div>                        
                    </li>
                    <!-- END MESSAGES -->
                    <!-- TASKS -->
                    <li class="xn-icon-button pull-right">
                        <a href="#"><span class="fa fa-tasks"></span></a>
                        <div class="informer informer-warning">3</div>
                        <div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
                            <div class="panel-heading">
                                <h3 class="panel-title"><span class="fa fa-tasks"></span> Đánh giá</h3>
                                <div class="pull-right">
                                    <span class="label label-warning">3 active</span>
                                </div>
                            </div>
                            <div class="panel-body list-group scroll" style="height: 200px;">                                
                                <a class="list-group-item" href="#">
                                    <strong></strong>
                                    <div class="progress progress-small progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;">50%</div>
                                    </div>
                                    <small class="text-muted"></small>
                                </a>
                                <a class="list-group-item" href="#">
                                    <strong></strong>
                                    <div class="progress progress-small progress-striped active">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;">80%</div>
                                    </div>
                                    <small class="text-muted"></small>
                                </a>
                                <a class="list-group-item" href="#">
                                    <strong>Lorem ipsum dolor</strong>
                                    <div class="progress progress-small progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%;">95%</div>
                                    </div>
                                    <small class="text-muted"></small>
                                </a>
                                <a class="list-group-item" href="#">
                                    <strong></strong>
                                    <div class="progress progress-small">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">100%</div>
                                    </div>
                                    <small class="text-muted">John Doe, 21 Sep 2014 /</small><small class="text-success"> Done</small>
                                </a>                                
                            </div>     
                            <div class="panel-footer text-center">
                                <a href="pages-tasks.html">Show all tasks</a>
                            </div>                            
                        </div>                        
                    </li>
                    <!-- END TASKS -->
                </ul>
                <!-- END X-NAVIGATION VERTICAL -->                     
                
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>                    
                    <li class="active">Trang chủ</li>
                </ul>
                <!-- END BREADCRUMB -->                       
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    <!-- START SEARCH -->
                    <div class="row">
                        <div class="col-md-2 col-xs-12">
                            <label>Chọn điểm giao dịch </label>
                            <select class="form-control" name="store" id="store">                          
                                <option value="0">
                                    Tất cả điểm giao dịch
                                </option>
                                <?php foreach($transPoint as $val){ ?>
                                    <option value="<?php echo $val->id; ?>">
                                        <?php echo $val->name; ?>
                                    </option>                                
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-2 col-xs-12">
                            <label>Dịch vụ</label>
                            <select class="form-control" id="sltService">                                
                                <option value="">
                                    Tất cả dịch vụ
                                </option>
                                <?php foreach($services as $val){ ?>
                                <option value="<?php echo $val->id; ?>">
                                    <?php echo $val->name; ?>
                                </option>                                
                                <?php } ?>                                
                            </select>
                        </div>
                        <?php   
                            $day=date("d");
                            $month=date("m");
                            $year=date("Y");                                                
                        ?>
                        <div class="col-md-2 col-xs-12 col-lg-2">
                            <label>Từ ngày</label>
                            <input class="form-control datepicker" id="datepickerFrom" value="<?php print $year."-".$month."-01"; ?>"/>
                        </div>
                        <div class="col-md-2 col-xs-12 col-lg-2">
                            <label>Đến ngày</label>
                            <input class="form-control datepicker" id="datepickerTo" value="<?php print $year."-".$month."-".$day; ?>"/>
                        </div>
                        <div class="col-md-4 col-xs-12 col-lg-4">
                            <br>
                            <button class="btn btn-success" id="btnSearch">Tìm kiếm</button>
                        </div>
                    </div>                                   
                    <!-- END SEARCH -->
                    <br>
                    <!-- START WIDGETS -->
                    <div class="row">
                        <div class="col-md-4 col-lg-4 col-sm-6">
                            <!-- START WIDGET REGISTRED -->
                            <div class="widget widget-default widget-item-icon" onclick="location.href='{{URL::to('/statistical/transaction')}}';" style="cursor: pointer;">
                                <div class="widget-item-left">
                                    <span class="fa fa-exchange"></span>
                                </div>
                                <div class="widget-data">
                                    <div class="widget-title">Giao dịch</div>
                                    <div class="widget-int num-count">
                                        <span style="font-size: 35px;" id="countTrans"> </span> <span style="font-size: 12px; "> lượt thành công</span>
                                        </br>
                                        <span style="font-size: 35px;" id="countFailTrans"> </span> <span style="font-size: 12px; "> lượt thất bại</span>
                                    </div>
                                    
                                    <!--<div class="widget-subtitle">(Phút)</div>-->
                                </div>
                                <div class="widget-controls">
                                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                                </div>
                            </div>
                            <!-- END WIDGET REGISTRED -->
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-6">                            
                            <!-- START WIDGET REGISTRED -->
                            <div class="widget widget-default widget-item-icon" onclick="location.href='{{URL::to('developing')}}';" style="cursor: pointer;">
                                <div class="widget-item-left">
                                    <span class="fa fa-clock-o"></span>
                                </div>
                                <div class="widget-data">
                                    <div class="widget-title">Thời gian trung bình</div>
                                    <div class="widget-int num-count">
                                        <div class="widget-int num-count">
                                        <span style="font-size: 35px;" id="averageTimeout"> </span><span style="font-size: 12px;">  phút chờ</span>
                                        </br> 
                                        <span style="font-size: 35px" id="averageServiceTime"></span> <span style="font-size: 12px;">  phút phục vụ</span>
                                        </div>                                                                                
                                    </div>                                                                    
                                </div>
                                <div class="widget-controls">                                
                                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                                </div>                            
                            </div>                            
                            <!-- END WIDGET REGISTRED -->
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-6">
                            <!-- START WIDGET REGISTRED -->
                            <div class="widget widget-default widget-item-icon" onclick="location.href='{{URL::to('/statistical/rating')}}';" style="cursor: pointer;">
                                <div class="widget-item-left">
                                    <span class="fa fa-star"></span>
                                </div>
                                <div class="widget-data">
                                <div class="widget-title">Đánh giá</div>
                                    <div class="widget-int num-count">
                                        <span id="averageScore"> </span>
                                        <span style="font-size: 12px">điểm </span>
                                        </br>
                                        <span id="numberVote"></span>
                                        <span style="font-size: 12px">lượt bầu chọn</span>
                                    </div>                                                                                                                                                
                                </div>
                                <!-- <div class="widget-controls">
                                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                                </div> -->
                            </div>
                            <!-- END WIDGET REGISTRED -->
                        </div>  
                    </div>                                     
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12">                            
                            <!-- START USERS ACTIVITY BLOCK -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <!--<div class="panel-title-box">-->
                                        <!--<h3>Biểu đồ thời gian phục vụ</h3>-->
                                    <!--</div>-->
                                    <!-- <ul class="panel-controls" style="margin-top: 2px;">
                                        <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>                                        
                                            <ul class="dropdown-menu">
                                                <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
                                                <li><a href="#" class="panel-remove"><span class="fa fa-times"></span> Remove</a></li>
                                            </ul>                                        
                                        </li>                                        
                                    </ul>-->
                                </div>                                
                                <div class="panel-body padding-0">
                                    <div id="timeServiceChart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                                </div>                                    
                            </div>
                            <!-- END USERS ACTIVITY BLOCK -->                            
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <!-- SHOW CIRCEL CHART  -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <!--<div class="panel-title-box">-->
                                        <!--<h3>Biểu đồ hình tròn</h3>-->
                                    <!--</div>-->
                                </div>
                                <div class="panel-body padding-0">
                                    <div id="ratioCircleChart" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
                                </div>
                            </div>
                            <!-- SHOW CIRCEL CHART  -->
                        </div>
                    </div>
                    <!-- START DASHBOARD CHART -->
					<div class="chart-holder" id="dashboard-area-1" style="height: 200px;"></div>
					<div class="block-full-width">                                                                       
                    </div>                    
                    <!-- END DASHBOARD CHART -->
                </div>
                <!-- END PAGE CONTENT WRAPPER -->                                
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->
        <script>
            var datePickFrom = $('#datepickerFrom').val();
            var dateFrom = datePickFrom + ' 00:00:00';            
            var datePickTo = $('#datepickerTo').val();
            var dateTo = datePickTo + ' 23:59:59';
            var store = $('#store').val();          
            getTimeServiceChart();
            getRatioCircleChart();
            // getVoteChart();            
            
            countTransaction(dateFrom, dateTo, store); 
            countFailTransaction(dateFrom, dateTo, store);
            getAverageScore(dateFrom, dateTo, store);
            getAverageTimeout(dateFrom, dateTo, store);            
            getVote(dateFrom, dateTo, store);           
            getAverageServiceTime(dateFrom, dateTo, store);
            search();
              
            function search(){
                $('#btnSearch').click(function () {     
                var datePickFrom = $('#datepickerFrom').val();
                var dateFrom = datePickFrom + ' 00:00:00';
                var datePickTo = $('#datepickerTo').val();
                var dateTo = datePickTo + ' 23:59:59';
                var store = $('#store').val();
                countTransaction(dateFrom, dateTo, store);  
                countFailTransaction(dateFrom, dateTo, store);
                getAverageTimeout(dateFrom, dateTo, store);
                getAverageScore(dateFrom, dateTo, store);            
                getVote(dateFrom, dateTo, store);           
                getAverageServiceTime(dateFrom, dateTo, store);                
                });
            }
            function countTransaction(dateFrom, dateTo, store){   
                let serviceId = $('#sltService').val();             
                let url = 'count-transaction';                            
                $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });
              $.ajax({
                url: url,
                type:'GET',
                data: {dateFrom: dateFrom, dateTo: dateTo, serviceId: serviceId, store: store},
                dataType : 'json',
                success: function(data){                    
                    $("#countTrans").text(data);
                    $("#countTrans2").text(data);
                },
                error: function(){
                    console.log("Lỗi đếm số lượt giao dịch");
                }
              });
            }
            function countFailTransaction(dateFrom, dateTo, store){   
                let serviceId = $('#sltService').val();         
                let url = 'count-fail-transaction';                            
                $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });
              $.ajax({
                url: url,
                type:'GET',
                data: {dateFrom: dateFrom, dateTo: dateTo, serviceId: serviceId, store: store},
                dataType : 'json',
                success: function(data){                    
                    $("#countFailTrans").text(data);                    
                },
                error: function(){
                    console.log("Lỗi đếm số lượt giao dịch lỗi");
                }
              });
            }
            function getAverageTimeout(dateFrom, dateTo, store){
                var url = 'get-average-timeout';
                var serviceId = $('#sltService').val();
                $.ajax({
                url: url,
                type:'GET',
                data: {dateFrom: dateFrom, dateTo: dateTo, serviceId: serviceId, store: store},
                dataType : 'json',
                success: function(data){
                    if(data != null || data == ""){
                        $("#averageTimeout").text((data/60).toFixed(1));
                    }else{
                        $("#averageTimeout").text("--");
                    }
                },
                error: function(){
                    $("#averageTimeout").text("--");
                    console.log("Lỗi lấy gía trị thời gian chờ TB");
                }
              });
            }
            function getAverageScore(dateFrom, dateTo, store){
                var url = 'get-average-score';
                var serviceId = $('#sltService').val();               
                $.ajax({
                url: url,
                type:'GET',
                data: {dateFrom: dateFrom, dateTo: dateTo, serviceId: serviceId, store: store},
                dataType : 'json',
                success: function(data){
                    if(data != null || data == ""){
                        $("#averageScore").text(data.toFixed(1));
                    }else{
                        $("#averageScore").text("--");
                    }
                },
                error: function(){  
                    $("#averageScore").text("--");                 
                    console.log("Lỗi lấy gía trị ĐTB");
                }
              });
            }
            function getVote(dateFrom, dateTo){
                var url = 'get-vote';
                var serviceId = $('#sltService').val();
                $.ajax({
                url: url,
                type:'GET',
                data: {dateFrom: dateFrom, dateTo: dateTo, serviceId: serviceId, store: store},
                dataType : 'json',
                success: function(data){                        
                    if(data != null || data != ""){                
                        $.each (data, function (key, item) {                        
                            $("#numberVote").text(item["count"]);
                        });
                    }else{
                        $("#numberVote").text("--");
                    }
                },
                error: function(){
                    console.log("Lỗi lấy gía trị lượt bình chọn");
                }
              });
            }
            function getAverageServiceTime(dateFrom, dateTo, store){
                var url = 'get-average-service-time';
                var serviceId = $('#sltService').val();
                $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });
              $.ajax({
                url: url,
                type:'GET',
                dataType : 'json',
                data: {dateFrom: dateFrom, dateTo: dateTo, serviceId: serviceId, store: store},
                success: function(data){
                    if(data != null || data != ""){
                        $("#averageServiceTime").text((data/60).toFixed(1));
                    }else{
                        $("#averageServiceTime").text("--");
                    }
                },
                error: function(){
                    $("#averageServiceTime").text("--");
                    console.log("Lỗi lấy giá trị thời gian phục vụ trung bình");
                }
              });
            }                       
            function getTimeServiceChart(){                
                var url = 'get-time-service-chart';
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: url,
                    type:'GET',
                    dataType : 'json',
                    //data: {dateFrom: dateFrom, dateTo: dateTo},
                    success: function(data){     
                        console.log(data);
                            var chart = Highcharts.chart('timeServiceChart', {

                                title: {
                                    text: 'THỜI GIAN PHỤC VỤ TRUNG BÌNH DỊCH VỤ'
                                },

                                subtitle: {
                                    text:""
                                },

                                xAxis: {
                                    categories: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12']
                                },

                                series: [{
                                    type: 'column',
                                    colorByPoint: true,
                                    data: data,
                                    showInLegend: false
                                }]
                            });
                    },
                    error: function(){
                        console.log("Lỗi lấy gía trị biểu đồ thời gian phục vụ trung bình dịch vụ");
                    }
                });
            }
            function getRatioCircleChart(){
                var url = 'get-ratio-circle-chart';
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
                        Highcharts.chart('ratioCircleChart', {
                            chart: {
                                plotBackgroundColor: null,
                                plotBorderWidth: null,
                                plotShadow: false,
                                type: 'pie'
                            },
                            title: {
                                text: 'TỈ LỆ SỬ DỤNG DỊCH VỤ'
                            },
                            tooltip: {
                                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                            },
                            plotOptions: {
                                pie: {
                                    allowPointSelect: true,
                                    cursor: 'pointer',
                                    dataLabels: {
                                        enabled: false
                                    },
                                    showInLegend: true
                                }
                            },
                            series: [{
                                name: 'Brands',
                                colorByPoint: true,
                                data: data
                            }]
                        });
                    },
                    error: function(){
                        console.log("Lỗi lấy gía trị biểu đồ tỉ lệ sử dụng dịch vụ");
                    }
                });
            }
            function getVoteChart(){
                var chart =
                    Highcharts.chart('voteChart', {

                        title: {
                            text: 'Điểm bầu chọn trung bình'
                        },

                        subtitle: {
                            text: 'Theo từng dịch vụ'
                        },

                        yAxis: {
                            title: {
                                text: 'Điểm trung bình'
                            }
                        },
                        legend: {
                            layout: 'vertical',
                            align: 'right',
                            verticalAlign: 'middle'
                        },

                        plotOptions: {
                            series: {
                                label: {
                                    connectorAllowed: false
                                },
                                pointStart: 2012
                            }
                        },

                        series: [{
                            name: 'Dịch vụ đóng cước',
                            data: [6, 4, 7, 4, 1, 5, 6, 8]
                        }, {
                            name: 'Dịch vụ Internet',
                            data: [8, 9, 5, 4, 5, 6, 7, 8]
                        }, {
                            name: 'Dịch vụ di động Vinaphone',
                            data: [4, 5, 7, 8, 8, 9, 10, 4]
                        }, {
                            name: 'Dịch vụ truyền số liệu',
                            data: [null, null, 4, 4, 2, 5, 6, 6]
                        }, {
                            name: 'Giải đáp thắc mắc',
                            data: [3, 4, 6, 8, 3, 2, 10, 1]
                        },
                            {
                            name: 'Dịch vụ khác',
                            data: [7, 8, 9, 4, 3, 5, 6, 7]
                        }],

                        responsive: {
                            rules: [{
                                condition: {
                                    maxWidth: 500
                                },
                                chartOptions: {
                                    legend: {
                                        layout: 'horizontal',
                                        align: 'center',
                                        verticalAlign: 'bottom'
                                    }
                                }
                            }]
                        }

                    });
            }           
        </script>
@endsection        