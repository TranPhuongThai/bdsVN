<?php

/**

 * @author Do Van Tien

 * @email dovantien2911@gmail.com

 * @company Webbox

 * @copyright 2012

 */



?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="<?php echo $site_description;?>" />
    <meta name="keywords" content="<?php echo $site_keywords;?>" />
    <meta name="google-site-verification" content="<?php echo $site_webmaster_tool;?>" /><?php echo (isset($link_canonical) && $link_canonical) ? '<link rel="canonical" href="'.$link_canonical.'" />' : '';?>
    <?php echo (isset($no_index)) ? '<meta name="robots" content="noindex, nofollow">' : '';?>
    <link rel="icon" href="/public/template-tiendv/image/favicon.png">

	<title><?php echo $site_title;?></title>
    
    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>public/template-tiendv/css/bootstrap.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="<?php echo base_url();?>public/template-tiendv/css/bootstrap-theme.css" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url();?>public/template-tiendv/css/theme.css" rel="stylesheet">
    <link href="<?php echo base_url();?>public/template-tiendv/plugin/owl-carousel/owl.carousel.css" rel="stylesheet">
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="public/template-tiendv/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="<?php echo base_url();?>public/template-tiendv/js/ie-emulation-modes-warning.js"></script>
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="<?php echo base_url();?>public/template-tiendv/js/jquery.1.11.3.min.js"></script>
    <script src="<?php echo base_url();?>public/template-tiendv/js/jquery.cookie.js"></script>