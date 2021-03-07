<div class="module module-likebox">
    <div class="title">
        <?php echo lang('frontend.facebook');?>
    </div>
    <div class="content">
        <div class="hidden" id="fb-root">&nbsp;</div>
        <script>
            //<![CDATA[
            (function(d, s, id) { var js, fjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) return; js = d.createElement(s); js.id = id; js.src = "//connect.facebook.net/vi_VN/all.js#xfbml=1"; fjs.parentNode.insertBefore(js, fjs); }(document, 'script', 'facebook-jssdk'));
            //]]>
        </script>
        <div data-header="false" data-stream="false" data-show-faces="true" data-height="205" data-border-color="none" data-width="208" data-href="http://www.facebook.com/<?php if(isset($name)) echo $name;?>" class="fb-like-box">&nbsp;</div>
        <div class="clear-both"></div>
    </div>
    <div class="clear-both"></div>
</div>