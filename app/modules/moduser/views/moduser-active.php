<div class="header-title title-support">Kích hoạt tài khoản</div>
<div class="content-static">
<br />
<?php echo $message;?>
<br /><br />
<?php 
    if(isset($success)){
?>
<a href="<?php echo base_url();?>user/add">Đăng tin</a>
<?php
    }
?>

</div>