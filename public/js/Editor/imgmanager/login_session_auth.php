<?php
	session_start();
    
    ## no login
    $_SESSION['isLoggedIn'] = true;
    #$_SESSION['user'] = $_POST['login'];
    
    // Override any config option
    $_SESSION['imagemanager.filesystem.rootpath'] = '../../../assets';
    $_SESSION['filemanager.filesystem.rootpath'] = '../../../assets';
    
	// Redirect
	header("location: /public/js/Editor/imgmanager/index.php?type=im&page=index.html");
    ## end no login


            
	// Some settings
	$msg = "Nếu bạn quên mật khẩu vui lòng liên hệ với người phát triển để lấy lại mật khẩu!";
	$username = "webbox";
	$password = "webbox"; // Change the password to something suitable
    
	if (isset($_POST['submit_button'])) {
		// If password match, then set login
		if ($_POST['login'] == $username && $_POST['password'] == $password) {
			// Set session
			$_SESSION['isLoggedIn'] = true;
			$_SESSION['user'] = $_POST['login'];

			// Override any config option
			$_SESSION['imagemanager.filesystem.rootpath'] = '../../../assets';
			$_SESSION['filemanager.filesystem.rootpath'] = '../../../assets';

			// Redirect
			header("location: " . $_POST['return_url']);
			die;
		} else {
			$msg = "username hoặc password sai.";
        }
	}
?>

<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Đăng nhập</title>
    <style>
    body { font-family: Arial, Verdana; font-size: 11px; }
    fieldset { display: block; width: 250px; }
    legend { font-weight: bold; }
    label { display: block; float: left;width: 60px; margin: 0 10px 0 0;line-height: 22px;}
    input.text {width: 180px;margin: 0; padding: 0;}
    div { margin-bottom: 10px; }
    div.last { margin: 0; }
    div.container { width: 280px; margin: 100px auto; }
    h1 { font-size: 14px; }
    .button { border: 1px solid gray; font-family: Arial, Verdana; font-size: 11px; margin: 0 0 0 70px;cursor: pointer;}
    .error { color: red; margin: 0; margin-top: 10px; text-align: center;}
    </style>
</head>
<body>

    <div class="container">
    	<form action="login_session_auth.php" method="post">
    		<input type="hidden" name="return_url" value="<?php echo isset($_REQUEST['return_url']) ? htmlentities($_REQUEST['return_url']) : ""; ?>" />
    
    		<fieldset>
                <br />
    			<legend style="text-align: center;">Đăng nhập quản lý hình ảnh</legend>
    
    			<div>
    				<label>Tài khoản:</label>
    				<input type="text" name="login" class="text" value="<?php echo isset($_POST['login']) ? htmlentities($_POST['login']) : ""; ?>" />
    			</div>
    
    			<div>
    				<label>Mật khẩu:</label>
    				<input type="password" name="password" class="text" value="<?php echo isset($_POST['password']) ? htmlentities($_POST['password']) : ""; ?>" />
    			</div>
    
    			<div class="last">
    				<input type="submit" name="submit_button" value="Đăng nhập" class="button" />
    			</div>
    
                <?php if ($msg) { ?>
        			<div class="error">
        				<?php echo $msg; ?>
        			</div>
                <?php } ?>
    		</fieldset>
    	</form>
    </div>

</body>
</html>
