<div class="module module-slide module-slide-nivo">
    <div class="content">
        <div class="slider-wrapper theme-default">
            <div id="slide" class="nivoSlider">
        		<?php foreach($slide_list as $row){ ?>
                    <a href="<?php echo $row['Link'];?>">
                        <img src="<?php echo $row['Img'];?>" data-thumb="<?php echo $row['Img'];?>" alt="<?php echo $row['Name'];?>" title="#htmlcaption<?php echo $row['ID'];?>" />
                    </a>
                <?php } ?>   
            </div>
    		<?php foreach($slide_list as $row){ ?>
                <div id="htmlcaption<?php echo $row['ID'];?>" class="nivo-html-caption">
                    <?php echo $row['Name'];?>
                </div>
            <?php } ?> 
        </div>    
        <div class="clear-both"></div>
    </div>
    <link href="<?php echo base_url();?>public/slide/nivoslider/default/default.css" type="text/css" media="screen" rel="stylesheet" />
    <link href="<?php echo base_url();?>public/slide/nivoslider/nivo-slider.css" type="text/css" media="screen" rel="stylesheet" />
    <script src="<?php echo base_url();?>public/slide/nivoslider/jquery.nivo.slider.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(window).load(function(){
            $('#slide').nivoSlider({
                    directionNav: true,
                    animSpeed: 500, // Slide transition speed
                    pauseTime: 3000, // How long each slide will show
                });
        });
    </script>
    <div class="clear-both"></div>
</div>