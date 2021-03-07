<?php

/**

 * @author Do Van Tien

 * @email dovantien2911@gmail.com

 * @company Webbox

 * @copyright 2012

 */



?>

    
    <div class="main-menu margin-top">
        <div class="container">
            <ul class="nav-main-menu nav-main-menu-2">
                <?php echo $modmenu->navigation(0,1,$menu);?>
            </ul>
        </div>
    </div>
    <div id="footer">
        <div class="container">
            <div class="col-sm-3 margin-top">
                <a class="logo" href="<?php echo base_url();?>" title="Đất vàng bình dương"><img width="100%" src="/public/template-tiendv/image/datvang.png" title="Đất vàng bình dương" alt="Đất vàng bình dương"/></a>
            </div>
            <div class="col-sm-9 margin-top">
                <div class="text-left">
                    <div class="info_footer">
                        <?php echo $modtext->getTextNoTitle(2,0);?>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="margin-top hr-info"></div>
            <div class="web-info text-left">
                Thiết kế website: <a href="http://webbox.com.vn" target="_blank" title="Thiết kế website">Webbox</a>
                <div class="g-plus"><div class="g-plusone" data-href="<?php echo base_url();?>" data-size="medium"></div></div>
                <div class="fb-like" data-href="<?php echo base_url();?>" data-share="false" data-send="true" data-layout="button_count" data-width="120" data-show-faces="true"></div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <?php echo $moduser->modalLogin();?>
    
    <div id="siteLeft" style="display: none">
        <div class="bnScroll" id="bnLeft" style="width: 100px">
            <div class="item">
                <div id="ban_l1">
                    <?php echo $modads->detail(3);?>
                </div>
            </div>
        </div>
    </div>
    <div id="siteRight" style="display: none">
        <div class="bnScroll" id="bnRight" style="width: 100px">
            <div class="item">
                <div id="ban_r1">
                    <?php echo $modads->detail(4);?>
                </div>
            </div>
        </div>
    </div>
    
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    
      ga('create', '<?php echo isset($site_analytics) ? $site_analytics : 'UA-27200973-29';?>', 'auto');
      ga('send', 'pageview');
    
    </script>
    
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url();?>public/template-tiendv/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>public/template-tiendv/js/docs.min.js"></script>
    <script src="<?php echo base_url();?>public/template-tiendv/js/jquery.validate.js"></script>
    <script src="<?php echo base_url();?>public/template-tiendv/js/script.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo base_url();?>public/template-tiendv/js/ie10-viewport-bug-workaround.js"></script>
