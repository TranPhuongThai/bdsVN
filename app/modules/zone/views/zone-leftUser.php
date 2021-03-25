
                <div class="row m-row">
                    <div class="mod-user-info">
                        <img src="<?php echo base_url();?>public/template-tiendv/image/avatar-default.png"/>
                        <span><?php echo $username;?></span>
                        <div class="clearfix"></div>
                    </div>
                    <ul class="user-act">
                        <?php if($userid != 0){?>
                        <li class="head">Quản lý tài khoản</li>
                        <li <?php echo ($mod == 'info') ? 'class="active"' : '';?>><span class="glyphicon glyphicon-info-sign"></span><a href="<?php echo base_url();?>user/info">Thông tin cá nhân</a></li>
                        <li <?php echo ($mod == 'changepass') ? 'class="active"' : '';?>><span class="glyphicon glyphicon-lock"></span><a href="<?php echo base_url();?>user/changepass">Đổi mật khẩu</a></li>
                        <?php }?>
                        <li class="head">Quản lý tin rao</li>
                        <li <?php echo ($mod == 'add') ? 'class="active"' : '';?>><span class="glyphicon glyphicon-plus-sign"></span><a href="<?php echo base_url();?>user/add">Đăng tin mới</a></li>
                        <?php if($userid != 0){?>
                        <li <?php echo ($mod == 'real') ? 'class="active"' : '';?>><span class="glyphicon glyphicon-briefcase"></span><a href="<?php echo base_url();?>user/real">Quản lý tin rao</a></li>
                        <?php }?>
                    </ul>
                </div>
                <div class="row m-row margin-top">
                    <?php echo $modtext->getText(5);?>
                </div>