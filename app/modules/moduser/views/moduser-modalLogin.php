<!-- modal -->
<div class="modal fade" id="modalRegis" tabindex="-1" role="dialog" aria-labelledby="modalRegisLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modalRegisLabel">Đăng ký tài khoản</h4>
            </div>
            <div class="modal-body">
                <div class="message"></div>
                <form class="validate">
                	<div class="form-group">
                		<label for="inputName">
                			Họ tên <span class="color-red">*</span>
                		</label>
                		<input type="name" name="username" class="form-control required" id="inputName" placeholder="Họ tên">
                	</div>
                	<div class="form-group">
                		<label for="inputEmail">
                			Địa chỉ email <span class="color-red">*</span>
                		</label>
                		<input type="email" name="email" class="form-control required" id="inputEmail" placeholder="Email">
                	</div>
                	<div class="form-group">
                		<label for="inputPassword">
                			Mật khẩu <span class="color-red">*</span>
                		</label>
                		<input type="password" name="password" class="form-control required" id="inputPassword" placeholder="Mật khẩu">
                	</div>
                	<div class="form-group">
                		<label for="inputPassword">
                			Nhập lại mật khẩu <span class="color-red">*</span>
                		</label>
                		<input type="password" name="repassword" class="form-control required" id="inputRePassword" placeholder="Mật khẩu">
                	</div>
                	<div class="form-group">
                		<label for="inputPhone">
                			Số điện thoại <span class="color-red">*</span>
                		</label>
                		<input type="phone" name="phone" class="form-control required" id="inputPhone" placeholder="Số điện thoại">
                	</div>
                	<div class="form-group more">
                		<label>
                            <span class="glyphicon glyphicon-log-in"></span>&nbsp;&nbsp;<a href="#" class="login close" data-dismiss="modal" aria-label="Close">Đã có tài khoản</a>
                        </label>
                	</div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" id="btn-regis">Đăng ký</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="modalLoginLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modalLoginLabel">Đăng nhập</h4>
            </div>
            <div class="modal-body">
                <div class="message"></div>
                <form class="validate">
                	<div class="form-group">
                		<label for="inputEmail">
                			Email
                		</label>
                		<input type="email" name="email" class="form-control required" id="inputEmail" placeholder="Email">
                	</div>
                	<div class="form-group">
                		<label for="inputPassword">
                			Mật khẩu
                		</label>
                		<input type="password" name="password" class="form-control required" id="inputPassword" placeholder="Password">
                	</div>
                	<div class="form-group more">
                		<label>
                            <span class="glyphicon glyphicon-question-sign"></span>&nbsp;&nbsp;<a href="#" class="forget close" data-dismiss="modal" aria-label="Close">Quên mật khẩu?</a>&nbsp;&nbsp;/&nbsp;&nbsp;
                            <span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;<a href="#" class="regis close" data-dismiss="modal" aria-label="Close">Đăng ký tài khoản</a>
                        </label>
                	</div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" id="btn-login">Đăng nhập</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalForget" tabindex="-1" role="dialog" aria-labelledby="modalForgetLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modalForgetLabel">Quên mật khẩu</h4>
            </div>
            <div class="modal-body">
                <div class="message"></div>
                <form class="validate">
                	<div class="form-group">
                		<label for="inputEmail">
                			Email
                		</label>
                		<input type="email" name="email" class="form-control required" id="inputEmail" placeholder="Email">
                	</div>
                	<div class="form-group more">
                		<label>
                            <a href="#" data-toggle="modal" class="login close" data-dismiss="modal" aria-label="Close"><span class="glyphicon glyphicon-log-in"></span>&nbsp;&nbsp;Đăng nhập</a>
                		</label>
                	</div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" id="btn-reset">Reset mật khẩu</button>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->