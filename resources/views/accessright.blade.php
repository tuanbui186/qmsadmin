@extends('layouts.master')
        @section('content')

        <!-- PAGE CONTENT WRAPPER -->
<div class="page-content">
    <!-- PAGE TITLE -->
    <div class="page-title">
        <h2><span class="fa fa-cogs"></span>QUẢN LÝ QUYỀN TRUY CẬP</small></h2>
</div>
        <!-- END PAGE TITLE -->
<div class="row">
<div class="col-md-12">

    <div class="panel panel-default">
        <div class="panel-body">
            <form class="form-horizontal">
                <div class="form-group">
                    <div class="col-md-8">
                        <div class="input-group">
                            <input class="form-control" name="" placeholder="Nhập tên truy cập"/>
                        </div>
                    </div>
                    <div class="col-md-4 right">
                        <button  class="btn btn-success" >Thêm quyền truy cập</button>
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
            <th>STT</th>
            <th>Tên nhóm truy cập</th>
            <th>Số quyền truy cập</th>
            <th>Cấu hình</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>1</td>
            <td>Vườn mít - Nhân viên</td>
            <td>1</td>
            <td>
                <button class="btn btn-success" data-toggle="modal" data-target="#edit">Sửa</button>
                <button class="btn btn-danger" data-toggle="modal" data-target="#delete">Xóa</button>
            </td>
        </tr>
        <tr>
            <td>2</td>
            <td>Vườn mít - Quản lý</td>
            <td>2</td>
            <td>
                <button class="btn btn-success" data-toggle="modal" data-target="#edit">Sửa</button>
                <button class="btn btn-danger" data-toggle="modal" data-target="#delete">Xóa</button>
            </td>
        </tr>
        <tr>
            <td>3</td>
            <td>Vườn Mít - Kỹ Thuật</td>
            <td>4</td>
            <td>
                <button class="btn btn-success" data-toggle="modal" data-target="#edit">Sửa</button>
                <button class="btn btn-danger" data-toggle="modal" data-target="#delete">Xóa</button>
            </td>
        </tr>
        <tr>
            <td>4</td>
            <td>Vườn xoài - Nhân Viên</td>
            <td>1</td>
            <td>
                <button class="btn btn-success" data-toggle="modal" data-target="#edit">Sửa</button>
                <button class="btn btn-danger" data-toggle="modal" data-target="#delete">Xóa</button>
            </td>
        </tr>
        <tr>
            <td>5</td>
            <td>Ban giám đốc</td>
            <td>10</td>
            <td>
                <button class="btn btn-success" data-toggle="modal" data-target="#edit">Sửa</button>
                <button class="btn btn-danger" data-toggle="modal" data-target="#delete">Xóa</button>
            </td>
        </tr>
        </tbody>
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
    <div class="modal fade" tabindex="-1" id="edit" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="color: #6256a9; font-weight: bold">Chỉnh sửa quyền truy cập</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <label>Tên nhóm </label> <input value="Vườn mít - Quản lý"/>
                    </div>
                    <div class="row">
                        <label><input type="checkbox"  name="cfgService" value="" checked=""> Cho phép Cấu hình dịch vụ</label>
                    </div>
                    <div class="row">
                        <label><input type="checkbox"  name="cfgService" value="" checked=""> Cho phép Thiết lập quầy dịch vụ</label>
                    </div>
                    <div class="row">
                        <label><input type="checkbox"  name="cfgService" value="" checked=""> Cho phép thêm mới và thay đổi thông tin nhân viên</label>
                    </div>
                    <div class="row">
                        <label><input type="checkbox"  name="viewSum" value="" checked=""> Cho phép xem tổng kết đánh giá nhân viên</label>
                    </div>
                </br>
                <!--div style="font-size:10px;"-->

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng lại</button>
                <button type="button" class="btn btn-primary">Lưu</button>
            </div>
        </div>
    </div>

</div>
@endsection