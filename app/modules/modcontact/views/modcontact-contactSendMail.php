<?php
$form = array(
    "name"      => "fEmail",
    "id"        => "fEmail",
    "class"     => "validate form form-horizontal",
); 
$name = array(
    "name"      => "name",
    "value"     => set_value("name"),
    "class"     => "required focus form-control text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$phone = array(
    "name"      => "phone",
    "value"     => set_value("phone"),
    "class"     => "form-control text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$email = array(
    "name"      => "email",
    "value"     => set_value("email"),
    "class"     => "form-control text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$address = array(
    "name"      => "address",
    "value"     => set_value("address"),
    "class"     => "form-control text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$content = array(
    "name"      => "content",
    "value"     => set_value("content"),
    "id"        => "CONTENT",
    "class"     => "required form-control text width-400 height-100 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
    "minlength" => "20",
);
$submit = array(
    'name'      => 'bntOk',
    'value'     => lang('frontend.send'),
    'class'     => 'btn btn-success padding-0 margin-0 text-align-left font-weight-bold border-0 cursor-pointer hover-blue border-radius-5',
);
$reset = array(
    'name'      => 'bntReset',
    'value'     => lang('frontend.reset'),
    'class'     => 'btn btn-warning padding-0 margin-0 text-align-left font-weight-bold border-0 cursor-pointer hover-blue border-radius-5',
);
?>
<span class="header-title title-menu"><?php echo $static_page['Name'];?></span>
<div class="content-static">
    <?php echo $static_page['Content'];?>
    <?php
        echo form_open("",$form);
        if($successfully == ""){
            echo '<p class="bg-danger">'.validation_errors().'</p>';
            echo '<p class="bg-danger">'.($error) ? $error : ''.'</p>';
    ?>
            <div class="form-group">
                <label class="col-sm-3 control-label">Tên của bạn <span class="color-red">*</span></label>
                <div class="col-sm-9"><?php echo form_input($name);?></div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Email</label>
                <div class="col-sm-9"><?php echo form_input($email);?></div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Số điện thoại</label>
                <div class="col-sm-9"><?php echo form_input($phone);?></div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Lời nhắn <span class="color-red">*</span></label>
                <div class="col-sm-9"><?php echo form_textarea($content);?></div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">&nbsp;</label>
                <div class="col-sm-9"><?php echo form_submit($submit).'&nbsp;&nbsp;&nbsp;&nbsp;'.form_reset($reset);?></div>
            </div>
            
    <?php
        }else{
            echo '<p class="bg-success">',$successfully,'</p>';
        }
        echo form_close();
    ?>
    <script src="<?php echo base_url();?>public/js/jquery.validate.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $(".validate").validate();
        });
    </script>
</div>
