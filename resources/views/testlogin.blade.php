<div class="col-md-6 col-xs-offset-3" style="margin-top:100px;">
    <form action="" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="panel panel-info">
            <div class="panel-heading">
                Login
            </div>
            <div class="panel-body">
                <div class="col-md-12" style="margin-top: 5px; color: #1997F8;">
                    <div class="col-md-4">
                        Username
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="email" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-12" style="margin-top: 5px;color:#1997F8;">
                    <div class="col-md-4">
                        Password
                    </div>
                    <div class="col-md-8">
                        <input type="password" name="password" class="form-control" required>
                    </div>
                </div>
                <?php echo Hash::make("123"); ?>
                <!-- nút submit -->
                <div class="col-md-12" style="margin-top: 5px; color: black;">
                    <div class="col-md-3 col-xs-offset-4">
                        <input type="submit" class="btn btn-info" value="Login">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>