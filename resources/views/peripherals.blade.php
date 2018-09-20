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
            <form class="form-horizontal">
                <div class="form-group">
                    <div class="col-md-8">
                        <input class="form-control" placeholder="Nhap thiet bi can tim"></input>
                    </div>
                    <div class="col-md-4 right">
                        <button class="btn btn-success">Tìm kiếm</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

</div>
<div class="row">
<table class="table">
    <thead>
    <tr>
        <th>No</th>
        <th>Mã thiết bị</th>
        <th>Tên thiết bị</th>
        <th>Tình trạng</th>
        <th>Dịch vụ Internet</th>
        <th>DV truyền số liệu</th>
        <th>Đóng cước</th>
        <th>Dịch vụ di động</th>
        <th>Giải đáp thắc mắc</th>
        <th>Khác</th>
        <th>Cấu hình</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>1</td>
        <td>Vuon Mit</td>
        <td>1</td>
        <td><input type="checkbox" value=""></td>
        <td><input type="checkbox" value=""></td>
        <td><input type="checkbox" value=""></td>
        <td><input type="checkbox" value=""></td>
        <td><input type="checkbox" value=""></td>
        <td><input type="checkbox" value=""></td>
        <td><input type="checkbox" value=""></td>
        <td>
            <button class="btn btn-success" data-toggle="modal" data-target="#edit">Sửa</button>
            <button class="btn btn-danger" data-toggle="modal" data-target="#delete">Xóa</button>
        </td>
    </tr>
    <tr>
        <td>2</td>
        <td>Vuon Xoai</td>
        <td>2</td>
        <td><input type="checkbox" value=""></td>
        <td><input type="checkbox" value=""></td>
        <td><input type="checkbox" value=""></td>
        <td><input type="checkbox" value=""></td>
        <td><input type="checkbox" value=""></td>
        <td><input type="checkbox" value=""></td>
        <td><input type="checkbox" value=""></td>
        <td>
            <button class="btn btn-success" data-toggle="modal" data-target="#edit">Sửa</button>
            <button class="btn btn-danger" data-toggle="modal" data-target="#delete">Xóa</button>
        </td>
    </tr>
    <tr>
        <td>3</td>
        <td>Vuon Xoai</td>
        <td>4</td>
        <td><input type="checkbox" value="" checked=""></td>
        <td><input type="checkbox" value=""></td>
        <td><input type="checkbox" value=""></td>
        <td><input type="checkbox" value=""></td>
        <td><input type="checkbox" value=""></td>
        <td><input type="checkbox" value=""></td>
        <td><input type="checkbox" value=""></td>
        <td>
            <button class="btn btn-success" data-toggle="modal" data-target="#edit">Sửa</button>
            <button class="btn btn-danger" data-toggle="modal" data-target="#delete">Xóa</button>
        </td>
    </tr>
    <tr>
        <td>4</td>
        <td>Vuon Mit</td>
        <td>1</td>
        <td><input type="checkbox" value=""></td>
        <td><input type="checkbox" value=""></td>
        <td><input type="checkbox" value=""></td>
        <td><input type="checkbox" value="" checked=""></td>
        <td><input type="checkbox" value=""></td>
        <td><input type="checkbox" value=""></td>
        <td><input type="checkbox" value=""checked=""></td>
        <td>
            <button class="btn btn-success" data-toggle="modal" data-target="#edit">Sửa</button>
            <button class="btn btn-danger" data-toggle="modal" data-target="#delete">Xóa</button>
        </td>
    </tr>
    <tr>
        <td>5</td>
        <td>Vuon Mit</td>
        <td>1</td>
        <td><input type="checkbox" value=""></td>
        <td><input type="checkbox" value=""></td>
        <td><input type="checkbox" value=""></td>
        <td><input type="checkbox" value=""></td>
        <td><input type="checkbox" value=""></td>
        <td><input type="checkbox" value=""></td>
        <td><input type="checkbox" value=""></td>
        <td>
            <button class="btn btn-success" data-toggle="modal" data-target="#edit">Sửa</button>
            <button class="btn btn-danger" data-toggle="modal" data-target="#delete">Xóa</button>
        </td>
    </tr>
    <tr>
        <td>6</td>
        <td>Vuon Mit</td>
        <td>7</td>
        <td><input type="checkbox" value=""></td>
        <td><input type="checkbox" value="" checked=""></td>
        <td><input type="checkbox" value=""></td>
        <td><input type="checkbox" value=""></td>
        <td><input type="checkbox" value=""></td>
        <td><input type="checkbox" value=""></td>
        <td><input type="checkbox" value="" checked=""></td>
        <td>
            <button class="btn btn-success" data-toggle="modal" data-target="#edit">Sửa</button>
            <button class="btn btn-danger" data-toggle="modal" data-target="#delete">Xóa</button>
        </td>
    </tr>
    </tbody>
</table>
<!-- Modal Edit -->
<div class="modal fade " tabindex="-1" id="edit" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="color: #6256a9; font-weight: bold">Chỉnh sửa dịch vụ </h4>
            </div>
            <div class="modal-body">
                <p>
                    Bạn có chắc chắn chỉnh sửa dịch vụ này?
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
<!-- End Modal Edit -->
</div>

        </div>
        <!-- END PAGE CONTENT WRAPPER -->
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
        <!-- END PAGE CONTENT WRAPPER -->
</div>
@endsection