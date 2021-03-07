<?php

/**
 * @author Do Van Tien
 * @email dovantien2911@gmail.com
 * @company Webbox.com.vn
 * @copyright 2012
 */

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<meta name="author" content="Do Van Tien" />
    <meta name="robots" content="noindex, nofollow"/>
    <meta name="description" content="Quản lý website"/>
    <link rel="shortcut icon" href="<?php echo base_url();?>public/image/layout/favicon.png"/>
    <script src="<?php echo base_url();?>public/js/jquery.1.8.3.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>public/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>public/js/jquery.validate.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>public/js/jquery.price_format.1.7.min.js" type="text/javascript"></script>
    <link href="<?php echo base_url();?>public/menu/slidemenu/jquery.slidemenu.admin.css" type="text/css" rel="stylesheet"/>
    <script src="<?php echo base_url();?>public/menu/slidemenu/jquery.slidemenu.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>public/js/jquery.easing.js" type="text/javascript"></script>
    <link href="<?php echo base_url();?>public/css/jquery.ui.smoothness/jquery-ui-1.8.22.custom.css" type="text/css" rel="stylesheet"/>
    <script src="<?php echo base_url();?>public/js/jquery.ui-1.8.22.custom.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>public/js/jquery.ui-timepicker-addon.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>public/js/jscript_admin.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>public/js/player.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>public/js/iscroll.js" type="text/javascript"></script>
    <link href="<?php echo base_url();?>public/css/css_all.css" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url();?>public/css/css_admin.css" type="text/css" rel="stylesheet"/>
	<title>Backend</title>
</head>

<body class="padding-0 margin-0">
    <div class="body">
        <div class="body-content-top padding-0 margin-10 border-1 border-color-ccc border-style-solid border-radius-8 overflow-hidden">
            <div class="box-top">
                <div class="padding-0 margin-0 font-weight-bold font-size-18 color-white float-left">Backend</div>
                <div class="padding-0 margin-0 text-align-right float-right"><a href="http://webbox.com.vn" rel="nofollow" target="_blank" class="color-blue no-underline hover-underline"><img src="<?php echo base_url()."public/image/webbox.com.vn.png";?>"/></a></div>
            </div>
            <div class="box-mid">
                <?php $this->load->view("backend/admin_template-menu"); ?>
                <?php echo $content_for_layout; ?>
                <div class="clear-both"></div>
            </div>
            <div class="clear-both"></div>
        </div>
        <div class="body-content-bottom padding10 text-align-center font-size-12">
            <?php echo lang('backend.developed_by');?>
            <br /><br /><br /><br /><br /><br />
        </div>
        <div class="clear-both"></div>
    </div>
</body>
</html>