<?php

/**
 * @author Do Van Tien
 * @email dovantien2911@gmail.com
 * @company Webbox.com.vn
 * @copyright 2012
 */
 
$form = array(
    'class'     => 'validate padding-20 border-1 border-radius-8 border-color-ccc border-style-solid',
);
$username = array(
    'name'      => 'username',
    'id'        => 'username',
    'class'     => 'required email focus text width-200 margin-0 padding-2 border-1 border-color-ccc border-style-solid',
    "value"     => set_value("username"),
);
$password = array(
    'name'      => 'password',
    'id'        => 'password',
    'class'     => 'required text width-200 margin-0 padding-2 border-1 border-color-ccc border-style-solid',
);
$submit = array(
    'name'      => 'bntOk',
    'value'     => lang('backend.login'),
    'class'     => 'bnt padding-0 margin-0 text-align-center font-weight-bold border-0 cursor-pointer hover-blue',
);
?>

<div class="form-login padding-15 border-1 border-color-ccc border-style-solid border-radius-8 width-600">
    <div class="title"><h1 class="padding-0 margin-0 color-blue-2 font-size-20"><?php echo lang('backend.login');?></h1></div>
    <div class="content">
        <div class="left text-align-left float-left">
            <p class="margin-0 padding-0"><?php echo lang('backend.alertlogin');?></p>
            <a href="<?php echo base_url();?>" class="color-blue no-underline hover-underline"><?php echo lang('backend.homepage');?></a>
            <img src="<?php echo base_url();?>public/image/system/j_login_lock.png"/>
        </div>
        <div class="right float-right">
            <?php
                echo form_open("",$form);
                echo "<div class=\"item item-text\">".form_label(lang('backend.account')).form_input($username)."<div class=\"clear-both\"></div></div>";
                echo "<div class=\"item item-text\">".form_label(lang('backend.password')).form_password($password)."<div class=\"clear-both\"></div></div>";
                echo "<div class=\"item item-text\">".form_label("").form_submit($submit)."<div class=\"clear-both\"></div></div>";
                echo "<div class=\"error red text-align-left\">";
                    echo validation_errors();
                    if($error !="" )
                        echo "<p>$error</p>";
                echo "</div>";
                echo form_close();
            ?>
        </div>
        <div class="clear-both"></div>
    </div>
    <div class="clear-both"></div>
</div>