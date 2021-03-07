<?php

/**
 * @author Do Van Tien
 * @email dovantien2911@gmail.com
 * @company Webbox.com.vn
 * @copyright 2012
 */

$form = array(
    "name"      => "fadmin",
    "id"        => "fUser",
    "class"     => "validate border-1 border-style-solid border-color-ccc background-color-fff padding-10",
); 
$password = array(
    "name"      => "password",
    "class"     => "required text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
    "minlength" => "6",
);
$newpassword = array(
    "name"      => "newpassword",
    "id"        => "newpassword",
    "class"     => "required text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
    "minlength" => "6",
);
$repassword = array(
    "name"      => "repassword",
    "id"        => "repassword",
    "class"     => "required text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
    "minlength" => "6",
    "equalTo"   => "#newpassword",
);
$submit = array(
    'name'      => 'bntOk',
    'value'     => lang('backend.save'),
    'class'     => 'bnt bntSave padding-0 margin-0 text-align-left font-weight-bold border-0 cursor-pointer hover-blue border-radius-5 hover-border-shadow',
);
$reset = array(
    'name'      => 'bntReset',
    'value'     => lang('backend.reset'),
    'class'     => 'bnt bntReset padding-0 margin-0 text-align-left font-weight-bold border-0 cursor-pointer hover-blue border-radius-5 hover-border-shadow',
);
?>
<div class="content content-user padding-10 margin-10 background-color-f4f4f4 border-1 border-radius-8 border-color-ccc border-style-solid">
    <div class="section-left float-left">
        <?php echo _breadcrumbs($breadcrumbs);?>
        <div class="clear-both"></div>
        <?php 
        
            echo "<div class=\"error red text-align-left\">";
                echo validation_errors();
                if($error !="" )
                    echo "<p>$error</p>";
            echo "</div>";
            echo form_open("",$form);
            echo "<div class=\"item item-text\">".form_label(lang('backend.oldpassword')." <span class=\"color-red\">*</span>").form_password($password)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label(lang('backend.newpassword')." <span class=\"color-red\">*</span>").form_password($newpassword)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label(lang('backend.retypepassword')." <span class=\"color-red\">*</span>").form_password($repassword)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-submit\">".form_submit($submit).form_reset($reset)."<div class=\"clear-both\"></div></div>";
            echo form_close();
        ?>
        <div class="clear-both"></div>
    </div>
    <div class="section-right float-right">
        <div class="right-info background-color-fff border-1 border-style-solid border-color-ccc border-radius-5 padding-10">
            <div class="item item_img">
                <div class="display-img text-align-center background-color-fff border-1 border-style-solid border-color-ccc border-radius-5">
                    <img src="<?php if($user_check["Img"]) echo $user_check["Img"]; else echo base_url()."public/i/no-avatar.png" ;?>"/><br />
                </div>
                <div class="clear"></div>
            </div>
            <div class="item item_name">
                <div class="left"><?php echo lang('backend.username');?> : </div>
                <div class="right"><?php echo $user_check['Username'];?></div>
                <div class="clear-both"></div>
            </div>
            <div class="item item_name">
                <div class="left"><?php echo lang('backend.fullname');?> : </div>
                <div class="right"><?php echo $user_check['Name'];?></div>
                <div class="clear-both"></div>
            </div>
            <div class="item item_name">
                <div class="left"><?php echo lang('backend.birthday');?> (dd/mm/yy) : </div>
                <div class="right"><?php echo _dataToDate($user_check['Birthday']);?></div>
                <div class="clear-both"></div>
            </div>
            <div class="item">
                <div class="left"><?php echo lang('backend.phone');?> : </div>
                <div class="right"><?php echo $user_check['Phone'];?></div>
                <div class="clear-both"></div>
            </div>
            <div class="item">
                <div class="left"><?php echo lang('backend.address');?> : </div>
                <div class="right"><?php echo $user_check['Address'].", ".$user_check_district['Name'].", ".$user_check_province['Name'];?></div>
                <div class="clear-both"></div>
            </div>
        </div>
        <div class="clear-both"></div>
    </div>
    <div class="clear-both"></div>
</div>