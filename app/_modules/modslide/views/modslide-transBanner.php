<div class="module module-slide module-slide-transBanner">
    <div class="content">
        <link href="<?php echo base_url();?>public/slide/transBanner/style.css" type="text/css" rel="stylesheet" />
        <script src="<?php echo base_url();?>public/js/jquery.easing.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>public/slide/transBanner/trans-banner.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            jQuery(function($){
                $('.transBanner').TransBanner({			
        			button_show_back: true,
        			caption_margin_x: 170,
        			caption_margin_y: 18
                    /*
            			slide_delaytime: 6,
            			slide_transition: 2,
            			navigation_type: 3,
            			button_size: 26,
            			caption_bg_color: '#000',
            			caption_bg_opacity: .2,
            			caption_bg_blur: 10,
            			responsive : true,
            			responsive_limit_autoplay : '', 
            			responsive_limit_caption : 480,
            			responsive_limit_navigation : 480,
            			responsive_limit_navigation_type : 2, 
            			responsive_screen_based_limits : true 
                    */
        		});	
            });
        </script>
        <div class="transBanner">
        	<?php foreach($slide_list as $row){ ?>
            	<div class="Slide">
            		<img src="<?php echo $row['Img'];?>" alt="<?php echo $row['Name'];?>" />
            		<div class="caption" align="left">			
            			<span class="tit"><?php echo $row['Name'];?></span>
                        <p class="con"><?php echo strip_tags($row['Content']);?></p>
            		</div>
            	</div>
            <?php } ?>
        </div>
    </div>
    <div class="clear-both"></div>
</div>