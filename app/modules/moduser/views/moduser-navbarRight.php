<ul class="nav navbar-nav navbar-right">
    <?php if(isset($username) && $username){ ?>
        <li><a href="/user/real"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;<?php echo $username;?></a></li>
        <li><a href="/user/add"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Đăng tin</a></li>
        <li><a href="/dang-xuat"><span class="glyphicon glyphicon-log-out"></span>&nbsp;&nbsp;Đăng xuất</a></li>
    <?php }else{ ?>
        <li><a href="#" data-toggle="modal" data-target="#modalLogin"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Đăng tin rao vặt</a></li>
    <?php } ?>
</ul>