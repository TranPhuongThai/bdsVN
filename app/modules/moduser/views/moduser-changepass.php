<?php
$form = array(
    "name"      => "fUser",
    "method"    => "POST",
    "class"     => "marign-top"
);
?>
<div class="header-title title-support">Thay đổi mật khẩu</div>
<div class="content-static">
    <?php echo form_open("",$form);?>
    <?php
        if($successfully == ""){
            echo '<p class="bg-danger">'.validation_errors().'</p>';
            echo '<p class="bg-danger">'.($error) ? $error : ''.'</p>';
        }else{
            echo '<p class="bg-success">'.$successfully.'</p>';
        }
    ?>
    	<div class="form-group">
    		<label for="inputEmail" class="col-sm-3 control-label">
    			Email address
    		</label>
            <div class="col-sm-9">
                <?php echo $userCheck['Email'];?>
            </div>
            <div class="clearfix"></div>
    	</div>
    	<div class="form-group">
    		<label for="inputName" class="col-sm-3 control-label">
    			Họ tên <span class="color-red">*</span>
    		</label>
            <div class="col-sm-9">
                <?php echo $userCheck['Name'];?>
            </div>
            <div class="clearfix"></div>
    	</div>
    	<div class="form-group">
    		<label for="inputPhone" class="col-sm-3 control-label">
    			Số điện thoại <span class="color-red">*</span>
    		</label>
            <div class="col-sm-9">
                <?php echo $userCheck['Phone'];?>
            </div>
            <div class="clearfix"></div>
    	</div>
        <hr />
    	<div class="form-group">
    		<label for="inputPassword" class="col-sm-4 control-label">
    			Mật khẩu cũ
    		</label>
            <div class="col-sm-8">
                <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Mật khẩu cũ" value="">
            </div>
            <div class="clearfix"></div>
    	</div>
    	<div class="form-group">
    		<label for="inputNewPassword" class="col-sm-4 control-label">
    			Mật khẩu mới
    		</label>
            <div class="col-sm-8">
                <input type="password" name="newpassword" class="form-control" id="inputNewPassword" placeholder="Mật khẩu mới" value="">
            </div>
            <div class="clearfix"></div>
    	</div>
    	<div class="form-group">
    		<label for="inputNewPassword2" class="col-sm-4 control-label">
    			Nhập lại mật khẩu mới
    		</label>
            <div class="col-sm-8">
                <input type="password" name="newpassword2" class="form-control" id="inputNewPassword2" placeholder="Nhập lại mật khẩu mới" value="">
            </div>
            <div class="clearfix"></div>
    	</div>
    	<div class="form-group">
            <label for="inputSubmit" class="col-sm-4 control-label">
    			&nbsp;
    		</label>
    		<div class="col-sm-8">
                <input type="submit" name="submit" class="btn btn-primary" value="Submit"/>
            </div>
            <div class="clearfix"></div>
    	</div>
    <?php echo form_close();?>
</div>