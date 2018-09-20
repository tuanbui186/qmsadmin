<!DOCTYPE html>
<html lang="en" class="body-full-height">
    <head>        
        <!-- META SECTION -->
        <title>QMS Admin - Hệ thống đánh gía dịch vụ khách hàng</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="{{ URL::asset('public/csrs-admin-template/css/theme-default.css')}}"/>
        <!-- EOF CSS INCLUDE -->
        <script src="{{URL::asset('public/js/jquery-3.1.1.min.js')}}"></script>
    </head>
    <body>
        
        <div class="login-container">
        
            <div class="login-box animated fadeInDown">
                <div class="login-logo"></div>
                <div class="login-body">
                    <div class="login-title"><strong>QMS Cloud</strong></br>Hệ thống đánh giá dịch vụ khách hàng </div>
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}                   
                    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                        <div class="col-md-12">
                            <input id="username" name="username" type="text" class="form-control" placeholder="Tên đăng nhập" value="{{ old('username') }}" autofocus/>
                            @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <div class="col-md-12">
                            <input id="password" name="password" type="password" class="form-control" value="{{ old('password') }}" value="{{ old('password')}}" placeholder="Mật khẩu"/>
                            @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <!-- <div class="col-md-6">
                            <a href="#" class="btn btn-link btn-block">Forgot your password?</a>
                        </div> -->
                        <div class="col-md-6">
                            <button class="btn btn-info btn-block" id="btnLogin">Đăng nhập</button>
                        </div>
                    </div>
                    </form>                    
                </div>
                <div class="login-footer">
                    <div class="pull-left">
                        &copy; 2018 VNPT IT
                    </div>
                    <div class="pull-right">
                        <a href="#">Về chúng tôi</a> |
                        <a href="#">Điều khoản</a> |
                        <a href="#">Liên hệ chúng tôi</a>
                    </div>
                </div>
            </div>            
        </div>
    </body>
</html>