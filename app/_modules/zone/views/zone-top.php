    
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
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                <a class="navbar-brand" href="<?php echo base_url();?>">Nhà Đất Bình Dương Giá Rẻ</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="<?php echo base_url();?>" title="<?php echo $site_title;?>">Trang chủ</a></li>
                        <li><a href="<?php echo base_url('gioi-thieu');?>" title="<?php echo $site_title;?>">Giới thiệu</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <div class="g-plus"><div class="g-plusone" data-href="<?php echo base_url();?>" data-size="medium"></div></div>
                        </li>
                        <li>
                            <div class="fb-like" data-href="<?php echo base_url();?>" data-share="false" data-send="true" data-layout="button_count" data-width="120" data-show-faces="true"></div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="banner">
            <div class="container">
                <a class="logo" href="<?php echo base_url();?>" title="<?php echo base_url();?>"><img src="/public/image/datvang.png" title="<?php echo $site_title;?>" alt="<?php echo $site_title;?>"/></a>
                <div class="bner"><?php echo $modads->detail(1);?></div>
            </div>
        </div>
        <div class="main-menu">
            <div class="container">
                <span class="button-main-menu-mobile">Danh mục website</span>
                <ul class="nav-main-menu">
                    <?php echo $modmenu->navigation(0,1,$menu);?>
                </ul>
            </div>
        </div>
    </nav>    