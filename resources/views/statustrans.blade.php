@extends('layouts.master')
@section('content')

        <!-- PAGE CONTENT WRAPPER -->
<div class="page-content">
    <!-- PAGE TITLE -->
    <div class="page-title">
        <h2><span class="fa fa-exchange"></span>TÌNH TRẠNG GIAO DỊCH</small></h2>
</div>
        <!-- END PAGE TITLE -->
<div class="row">
<div class="col-md-12">

    <div class="panel panel-default">
        <div class="panel-body">
            <p>Tìm kiếm</p>
            <form class="form-horizontal">
                <div class="form-group">
                    <div class="col-md-8">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="fa fa-search"></span>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Chọn ngày bắt đầu" id="datepickerFrom"/>
                            </div>
                            <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="Chọn ngày kết thúc" id="datepickerTo"/>
                            </div>
                            <div class="input-group-btn">
                                <button class="btn btn-primary">Tìm</button>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
            <div class="row">
                <div id="chartdiv"></div>
                <!-- Start Chart -->
                <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
                <script src="https://www.amcharts.com/lib/3/serial.js"></script>
                <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
                <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
                <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
                <!-- End Chart -->
                <script>
                    var chart = AmCharts.makeChart("chartdiv", {
                        "type": "serial",
                        "theme": "light",
                        "legend": {
                            "horizontalGap": 10,
                            "maxColumns": 1,
                            "position": "right",
                            "useGraphSettings": true,
                            "markerSize": 10
                        },
                        "dataProvider": [{
                            "date": "1-1-2018",
                            "europe": 2.5,
                            "namerica": 2.5,
                            "asia": 2.1,
                            "lamerica": 0.3,
                            "meast": 0.2,
                            "africa": 0.1
                        }, {
                            "date": "1-2-2018",
                            "europe": 2.6,
                            "namerica": 2.7,
                            "asia": 2.2,
                            "lamerica": 0.3,
                            "meast": 0.3,
                            "africa": 0.1
                        }, {
                            "date": "1-3-2018",
                            "europe": 2.8,
                            "namerica": 2.9,
                            "asia": 2.4,
                            "lamerica": 0.3,
                            "meast": 0.3,
                            "africa": 0.1
                        }],
                        "valueAxes": [{
                            "stackType": "regular",
                            "axisAlpha": 0.3,
                            "gridAlpha": 0
                        }],
                        "graphs": [{
                            "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                            "fillAlphas": 0.8,
                            "labelText": "[[value]]",
                            "lineAlpha": 0.3,
                            "title": "Dịch vụ Internet",
                            "type": "column",
                            "color": "#000000",
                            "valueField": "europe"
                        }, {
                            "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                            "fillAlphas": 0.8,
                            "labelText": "[[value]]",
                            "lineAlpha": 0.3,
                            "title": "Dịch vụ truyền số liệu",
                            "type": "column",
                            "color": "#000000",
                            "valueField": "namerica"
                        }, {
                            "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                            "fillAlphas": 0.8,
                            "labelText": "[[value]]",
                            "lineAlpha": 0.3,
                            "title": "Đóng cước",
                            "type": "column",
                            "color": "#000000",
                            "valueField": "asia"
                        }, {
                            "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                            "fillAlphas": 0.8,
                            "labelText": "[[value]]",
                            "lineAlpha": 0.3,
                            "title": "Dịch vụ di động Vinaphone",
                            "type": "column",
                            "color": "#000000",
                            "valueField": "lamerica"
                        }, {
                            "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                            "fillAlphas": 0.8,
                            "labelText": "[[value]]",
                            "lineAlpha": 0.3,
                            "title": "Giải đáp thắc mắc",
                            "type": "column",
                            "color": "#000000",
                            "valueField": "meast"
                        }, {
                            "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                            "fillAlphas": 0.8,
                            "labelText": "[[value]]",
                            "lineAlpha": 0.3,
                            "title": "Khác",
                            "type": "column",
                            "color": "#000000",
                            "valueField": "africa"
                        }],
                        "categoryField": "date",
                        "categoryAxis": {
                            "gridPosition": "start",
                            "axisAlpha": 0,
                            "gridAlpha": 0,
                            "position": "left"
                        },
                        "export": {
                            "enabled": true
                        }

                    });
                </script>
            </div>
        </div>
    </div>

</div>

</div>
<div class="row">
<table class="table">

</table>
</div>
        <!-- Start delete Modal -->
<div class="modal fade " tabindex="-1" id="delete" role="dialog">
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
        </br>
        <!--div style="font-size:10px;"-->
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng lại</button>
        <button type="button" class="btn btn-primary">Đồng ý</button>
    </div>
</div>
</div>
        <!-- End delete Modal -->
</div>
</div>
</div>
<script>
$( function() {
    $( "#datepickerFrom" ).datepicker();
    $( "#datepickerTo" ).datepicker();
} );
</script>
@endsection