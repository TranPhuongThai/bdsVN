    
    <script type="text/javascript">
      window.___gcfg = {lang: 'vi'};
    
      (function() {
        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
        po.src = 'https://apis.google.com/js/plusone.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
      })();
    </script>
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/vi_VN/all.js#xfbml=1";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <h1 class="hide"><?php echo $site_title;?></h1>
    <h2 class="hide"><?php echo $site_description;?></h2>
    
    <nav id="top">
        <div class="navbar __navbar-fixed-top">
            <div class="header-bar">
                <div class="navbar-header">
                <a class="logo" href="<?php echo base_url();?>" title="Đất vàng Bình Dương"><img src="/public/template-tiendv/image/datvang.png" title="Đất vàng Bình Dương" alt="Đất vàng Bình Dương"/></a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                <!--<a class="navbar-brand" href="#">Đất vàng Bình Dương</a>-->
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <!-- <ul class="nav navbar-nav">
                        <li><a href="<?php echo base_url();?>" title="Đất vàng Bình Dương"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Trang chủ</a></li>
                        <li><a href="<?php echo base_url();?>gioi-thieu" title="Đất vàng Bình Dương"><span class="glyphicon glyphicon-info-sign"></span>&nbsp;&nbsp;Giới thiệu</a></li>
                        <li><a href="<?php echo base_url();?>lien-he" title="Đất vàng Bình Dương"><span class="glyphicon glyphicon-envelope"></span>&nbsp;&nbsp;Liên hệ</a></li>
                    </ul> -->
                    <div class="main-menu">
                        <div class="">
                            <?php echo $moduser->navbarRight();?>
                            <span class="button-main-menu-mobile">Danh mục website</span>
                            <ul class="nav navbar-nav nav-main-menu">
                                <?php echo $modmenu->navigation(0,1,$menu);?>
                            </ul>
                            
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- <div class="banner">
            <div class="container">
                <a class="logo" href="<?php echo base_url();?>" title="Đất vàng Bình Dương"><img src="/public/template-tiendv/image/datvang.png" title="Đất vàng Bình Dương" alt="Đất vàng Bình Dương"/></a>
                <div class="bner"><?php echo $modads->detail(1);?></div>
            </div>
        </div> -->
    </nav>