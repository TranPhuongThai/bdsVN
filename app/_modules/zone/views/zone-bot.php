<?php

/**

 * @author Do Van Tien

 * @email dovantien2911@gmail.com

 * @company Webbox

 * @copyright 2012

 */



?>

    <div id="footer">
        <div class="container">
            <div class="text-center margin-top">
                <?php echo $modtext->getTextNoTitle(2,0);?>
                <!--<div class="design-by">Thiết kế bởi <a href="http://webbox.com.vn" target="_blank" title="Thiết kế website">Webbox.com.vn</a></div>-->
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