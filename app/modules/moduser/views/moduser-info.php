<?php
$form = array(
    "name"      => "fUser",
    "method"    => "POST",
    "class"     => "marign-top"
);
?>
<div class="header-title title-support">Thay đổi thông tin cá nhân</div>
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
                <input type="name" name="username" class="form-control" id="inputName" placeholder="Name" value="<?php echo $userCheck['Name'];?>">
            </div>
            <div class="clearfix"></div>
    	</div>
    	<div class="form-group">
    		<label for="inputPhone" class="col-sm-3 control-label">
    			Số điện thoại <span class="color-red">*</span>
    		</label>
            <div class="col-sm-9">
                <input type="name" name="phone" class="form-control" id="inputPhone" placeholder="Phone" value="<?php echo $userCheck['Phone'];?>">
            </div>
            <div class="clearfix"></div>
    	</div>
        <hr />
    	<div class="form-group">
    		<label for="inputYahoo" class="col-sm-3 control-label">
    			Yahoo
    		</label>
            <div class="col-sm-9">
                <input type="name" name="yahoo" class="form-control" id="inputYahoo" placeholder="Yahoo" value="<?php echo $userCheck['Yahoo'];?>">
            </div>
            <div class="clearfix"></div>
    	</div>
    	<div class="form-group">
    		<label for="inputSkype" class="col-sm-3 control-label">
    			Skype
    		</label>
            <div class="col-sm-9">
                <input type="skype" name="skype" class="form-control" id="inputSkype" placeholder="Skype" value="<?php echo $userCheck['Skype'];?>">
            </div>
            <div class="clearfix"></div>
    	</div>
    	<div class="form-group">
    		<label for="inputFacebook" class="col-sm-3 control-label">
    			Facebook
    		</label>
            <div class="col-sm-9">
                <input type="facebook" name="facebook" class="form-control" id="inputFacebook" placeholder="Facebook" value="<?php echo $userCheck['Facebook'];?>">
            </div>
            <div class="clearfix"></div>
    	</div>
    	<div class="form-group">
            <label for="inputSubmit" class="col-sm-3 control-label">
    			&nbsp;
    		</label>
    		<div class="col-sm-9">
                <input type="submit" name="submit" class="btn btn-primary" value="Submit"/>
            </div>
            <div class="clearfix"></div>
    	</div>
    <?php echo form_close();?>
</div>