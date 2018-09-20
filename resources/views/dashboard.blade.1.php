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
                                    <span class="label label-danger">4 giao dịch mới</span>
                                </div>
                            </div>
                            <div class="panel-body list-group list-group-contacts scroll" style="height: 200px;">
                                <a href="#" class="list-group-item">
                                    <div class="list-group-status status-online"></div>
                                    <img src="assets/images/users/user2.jpg" class="pull-left" alt="John Doe"/>
                                    <span class="contacts-title">John Doe</span>
                                    <p>Praesent placerat tellus id augue condimentum</p>
                                </a>
                                <a href="#" class="list-group-item">
                                    <div class="list-group-status status-away"></div>
                                    <img src="assets/images/users/user.jpg" class="pull-left" alt="Dmitry Ivaniuk"/>
                                    <span class="contacts-title">Dmitry Ivaniuk</span>
                                    <p>Donec risus sapien, sagittis et magna quis</p>
                                </a>
                                <a href="#" class="list-group-item">
                                    <div class="list-group-status status-away"></div>
                                    <img src="assets/images/users/user3.jpg" class="pull-left" alt="Nadia Ali"/>
                                    <span class="contacts-title">Nadia Ali</span>
                                    <p>Mauris vel eros ut nunc rhoncus cursus sed</p>
                                </a>
                                <a href="#" class="list-group-item">
                                    <div class="list-group-status status-offline"></div>
                                    <img src="assets/images/users/user6.jpg" class="pull-left" alt="Darth Vader"/>
                                    <span class="contacts-title">Darth Vader</span>
                                    <p>I want my money back!</p>
                                </a>
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
                                    <strong>Phasellus augue arcu, elementum</strong>
                                    <div class="progress progress-small progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;">50%</div>
                                    </div>
                                    <small class="text-muted">John Doe, 25 Sep 2014 / 50%</small>
                                </a>
                                <a class="list-group-item" href="#">
                                    <strong>Aenean ac cursus</strong>
                                    <div class="progress progress-small progress-striped active">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;">80%</div>
                                    </div>
                                    <small class="text-muted">Dmitry Ivaniuk, 24 Sep 2014 / 80%</small>
                                </a>
                                <a class="list-group-item" href="#">
                                    <strong>Lorem ipsum dolor</strong>
                                    <div class="progress progress-small progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%;">95%</div>
                                    </div>
                                    <small class="text-muted">John Doe, 23 Sep 2014 / 95%</small>
                                </a>
                                <a class="list-group-item" href="#">
                                    <strong>Cras suscipit ac quam at tincidunt.</strong>
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
                        <div class="col-md-6">
                            <label>Chọn điểm giao dịch</label>
                            <select class="form-control">
                                <option>
                                    Chọn điểm giao dịch
                                </option>
                                <option>
                                    Biên Hòa
                                </option>
                                <option>
                                    Long Thành
                                </option>
                                <option>
                                    Xuân Lộc
                                </option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Dịch vụ</label>
                            <select class="form-control">
                                <option>
                                    Chọn dịch vụ
                                </option>
                                <option>
                                    Dịch vụ đóng cước
                                </option>
                                <option>
                                    Dịch vụ Internet
                                </option>
                                <option>
                                    Dịch vụ Di động
                                </option>
                                <option>
                                    Dịch vụ truyền số liệu
                                </option>
                                <option>
                                    Giải đáp thắc mắc
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Từ</label>
                            <input class="form-control" id="datepickerFrom"/>
                        </div>
                        <div class="col-md-4">
                            <label>Đến</label>
                            <input class="form-control" id="datepickerTo"/>
                        </div>
                        <div class="col-md-4">
                            <br>
                            <button class="btn btn-success">Tìm kiếm</button>
                        </div>
                    </div>
                    <!-- END SEARCH -->
                    <br>
                    <!-- START WIDGETS -->
                    <div class="row">
                        <!--<div class="col-md-3">-->
                            <!--&lt;!&ndash; START WIDGET SLIDER &ndash;&gt;-->
                            <!--<div class="widget widget-default widget-carousel" onclick="location.href='{{route('getEmployeeManager')}}';">-->
                                <!--<div class="owl-carousel" id="owl-example">-->
                                    <!--<div style="cursor: pointer;">-->
                                        <!--<div class="widget-title">Tổng nhân viên</div>-->
                                        <!-- <div class="widget-subtitle"><?php echo "Tính đến ngày: " . date("Y/m/d") . "<br>";?></div> -->
                                        <!-- <div class="widget-int"> <?php echo $emp; ?></div> -->
                                    <!--</div>-->
                                <!--</div>-->
                                <!--<div class="widget-controls">-->
                                    <!--<a href="{{route('getEmployeeManager')}}" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>-->
                                <!--</div>-->
                            <!--</div>-->
                            <!--&lt;!&ndash; END WIDGET SLIDER &ndash;&gt;-->
                        <!--</div>-->
                        <div class="col-md-3">

                            <!-- START WIDGET REGISTRED -->
                            <div class="widget widget-default widget-item-icon" onclick="location.href='{{URL::to('developing')}}';" style="cursor: pointer;">
                                <div class="widget-item-left">
                                    <span class="fa fa-exchange"></span>
                                </div>
                                <div class="widget-data">
                                    <div class="widget-int num-count">5 <span style="font-size: 12px; "> Lượt</span></div>
                                    <div class="widget-title">Lượt giao dịch</div>
                                    <!--<div class="widget-subtitle">(Phút)</div>-->
                                </div>
                                <div class="widget-controls">
                                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                                </div>
                            </div>
                            <!-- END WIDGET REGISTRED -->
                        </div>
                        <div class="col-md-2">
                            
                            <!-- START WIDGET REGISTRED -->
                            <div class="widget widget-default widget-item-icon" onclick="location.href='{{URL::to('developing')}}';" style="cursor: pointer;">
                                <div class="widget-item-left">
                                    <span class="fa fa-clock-o"></span>
                                </div>
                                <div class="widget-data">
                                    <div class="widget-int num-count">5 <span style="font-size: 12px; "> Phút</span></div>
                                    <div class="widget-title">Thời gian chờ trung bình</div>
                                    <!--<div class="widget-subtitle">(Phút)</div>-->
                                </div>
                                <div class="widget-controls">                                
                                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                                </div>                            
                            </div>                            
                            <!-- END WIDGET REGISTRED -->
                        </div>
                        <!--<div class="col-md-3">-->
                            <!---->
                            <!--&lt;!&ndash; START WIDGET CLOCK &ndash;&gt;-->
                            <!--<div class="widget widget-info widget-padding-sm">-->
                                <!--<div class="widget-big-int plugin-clock">00:00</div>                            -->
                                <!--<div class="widget-subtitle plugin-date">Đang tải...</div>-->
                                <!--<div class="widget-controls">                                -->
                                    <!--<a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="left" title="Remove Widget"><span class="fa fa-times"></span></a>-->
                                <!--</div>                            -->
                                <!--<div class="widget-buttons widget-c3">-->
                                    <!--<div class="col">-->
                                        <!--<a href="#"><span class="fa fa-clock-o"></span></a>-->
                                    <!--</div>-->
                                    <!--<div class="col">-->
                                        <!--<a href="#"><span class="fa fa-bell"></span></a>-->
                                    <!--</div>-->
                                    <!--<div class="col">-->
                                        <!--<a href="#"><span class="fa fa-calendar"></span></a>-->
                                    <!--</div>-->
                                <!--</div>                            -->
                            <!--</div>                        -->
                            <!--&lt;!&ndash; END WIDGET CLOCK &ndash;&gt;-->
                            <!---->
                        <!--</div>-->

                        <div class="col-md-2">
                            <!-- START WIDGET REGISTRED -->
                            <div class="widget widget-default widget-item-icon" onclick="location.href='{{URL::to('developing')}}';" style="cursor: pointer;">
                                <div class="widget-item-left">
                                    <span class="fa fa-star"></span>
                                </div>
                                <div class="widget-data">
                                    <div class="widget-int num-count"><?php printf("%6.2f",$avgEval); ?></div>
                                    <div class="widget-title">Điểm đánh giá trung bình</div>
                                    <!--<div class="widget-subtitle">Dịch vụ cửa hàng</div>-->
                                </div>
                                <div class="widget-controls">
                                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                                </div>
                            </div>
                            <!-- END WIDGET REGISTRED -->
                        </div>
                        <div class="col-md-2">
                            <!-- START WIDGET REGISTRED -->
                            <div class="widget widget-default widget-item-icon" onclick="location.href='{{URL::to('developing')}}';" style="cursor: pointer;">
                                <div class="widget-item-left">
                                    <span class="fa fa-plus-square"></span>
                                </div>
                                <div class="widget-data">
                                    <div class="widget-int num-count"><?php echo $vote; ?></div>
                                    <div class="widget-title">Lượt bầu chọn</div>
                                    <!--<div class="widget-subtitle">Dịch vụ của bạn</div>-->
                                </div>
                                <div class="widget-controls">
                                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                                </div>
                            </div>
                            <!-- END WIDGET REGISTRED -->
                        </div>
                        <div class="col-md-3">
                            <!-- START WIDGET REGISTRED -->
                            <div class="widget widget-default widget-item-icon" onclick="location.href='{{URL::to('developing')}}';" style="cursor: pointer;">
                                <div class="widget-item-left">
                                    <span class="fa fa-calendar"></span>
                                </div>
                                <div class="widget-data">
                                    <div class="widget-int num-count"><?php echo $avgTimePeriod; ?> <span style="font-size: 12px; "> giây</span></div>
                                    <div class="widget-title">Thời gian phục vụ trung bình</div>
                                    <div class="widget-subtitle">Dựa trên <?php echo $trans ?> lượt giao dịch</div>
                                </div>
                                <div class="widget-controls">
                                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                                </div>
                            </div>
                            <!-- END WIDGET REGISTRED -->
                        </div>
                    <!-- END WIDGETS -->                    
                    
                    <div class="row">
                        <div class="col-md-4">
                            
                            <!-- START USERS ACTIVITY BLOCK -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <!--<div class="panel-title-box">-->
                                        <!--<h3>Biểu đồ thời gian phục vụ</h3>-->
                                    <!--</div>-->
                                    <ul class="panel-controls" style="margin-top: 2px;">
                                        <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>                                        
                                            <ul class="dropdown-menu">
                                                <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
                                                <li><a href="#" class="panel-remove"><span class="fa fa-times"></span> Remove</a></li>
                                            </ul>                                        
                                        </li>                                        
                                    </ul>                                    
                                </div>                                
                                <div class="panel-body padding-0">
                                    <div id="timeServiceChart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                                </div>                                    
                            </div>
                            <!-- END USERS ACTIVITY BLOCK -->
                            
                        </div>
                        <div class="col-md-4">
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
\
                        </div>

						<div class="col-md-4">
                            
                            <!-- START PROJECTS BLOCK -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <!--<div class="panel-title-box">-->
                                        <!--<h3>Biểu đồ cột bầu chọn </h3>-->
                                    <!--</div>                                    -->
                                    <ul class="panel-controls" style="margin-top: 2px;">
                                        <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>                                        
                                            <ul class="dropdown-menu">
                                                <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
                                                <li><a href="#" class="panel-remove"><span class="fa fa-times"></span> Remove</a></li>
                                            </ul>                                        
                                        </li>                                        
                                    </ul>
                                </div>
                                <div class="panel-body panel-body-table">
                                    <div id="voteChart" style="	height: 300px; min-width: 310px; max-width: 800px;"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- END PROJECTS BLOCK -->
                            
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
            getTimeServiceChart();
            getRatioCircleChart();
            getVoteChart();
            function getEmployee(){
            var url = '../get-time-service';
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
                   alert(JSON.stringify(data));
                  $.each (data, function (key, item){

                  });
                },
                error: function(){
                    toastr.warning("Lỗi lấy gía trị");
                }
              });
            }
            function getTimeServiceChart(){
                var url = 'get-time-service';
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: url,
                    type:'GET',
//                    data: {sensorid: sensorid},
                    dataType : 'json',
                    success: function(data){
//                        alert(JSON.stringify(data));
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
                        alert("Lỗi lấy gía trị");
                    }
                });
            }
            function getRatioCircleChart(){
                var url = 'get-ratio-circle';
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
//                        alert(JSON.stringify(data));
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
                        alert("Lỗi lấy gía trị");
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
<script>
$( function() {
    $( "#datepickerFrom" ).datepicker();
    $( "#datepickerTo" ).datepicker();
} );
</script>
@endsection        