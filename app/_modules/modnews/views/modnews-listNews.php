<div class="module module-news-listNews">
    <div class="content">
        <ul id="listNewsSlide" class="hidden jcarousel-skin-tango">
        <?php
            $stt = 1;
            foreach($news_list as $row){
        ?>
            <li class="item">
                <h4><a class="tit" href="<?php echo base_url()._setURL($row['Name'])."-news-".$row['ID'].".html";?>" title="<?php echo $row['Name'];?>"><?php echo $row['Name'];?></a></h4>
            </li>
        <?php
                ++$stt;
            }
        ?>
        </ul>
        <script src="<?php echo base_url();?>public/slide/jcarousel/jquery.jcarousel.min.js" type="text/javascript" ></script>
        <link href="<?php echo base_url();?>public/slide/jcarousel/skin.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript">
            function partnerSlide_initCallback(carousel) {
            	carousel.buttonNext.bind('click', function() {
            		carousel.startAuto(0);
            	});
            	carousel.buttonPrev.bind('click', function() {
            		carousel.startAuto(0);
            	});
            	carousel.clip.hover(function() {
            		carousel.stopAuto();
            	}, function() {
            		carousel.startAuto();
            	});
            };
            jQuery(document).ready(function() {
            	$("#listNewsSlide").removeClass('hidden');
            	$('#listNewsSlide').jcarousel({
            		auto: 4,
            		scroll: 1,
                    vertical: true,
            		wrap: 'circular',
            		initCallback: partnerSlide_initCallback
            	});
            });
        </script>
        <div class="clear-both"></div>
    </div>
</div>