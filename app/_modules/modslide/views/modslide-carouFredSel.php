<div class="module module-slide module-slide-carouFredSel">
    <div class="content">
        <ul id="slide_caroufredsel">
    		<?php foreach($slide_list as $row){ ?>
                <li>
                    <div class="img">
                        <a href="<?php echo $row['Link'];?>">
                            <img src="<?php echo $row['Img'];?>" alt="<?php echo $row['Name'];?>" title="<?php echo $row['Name'];?>" />
                        </a>
                    </div>
                    <div class="info">
                        <a class="tit" href="<?php echo $row['Link'];?>"><h1><?php echo $row['Name'];?></h1></a>
                        <p><?php echo strip_tags($row['Content']);?></p>
                        <a class="more" href="<?php echo $row['Link'];?>">Xem thêm</a>
                    </div>
                </li>
            <?php } ?>  
        </ul> 
        <div class="clear-both"></div> 
		<div id="timer1" class="timer"></div>  
		<a id="prev" class="prev" href="#">&lt;</a>
		<a id="next" class="next" href="#">&gt;</a>
		<div id="pager" class="pager"></div>
        <link href="<?php echo base_url();?>public/slide/caroufredsel/caroufredsel.css" type="text/css" rel="stylesheet"/>
    	<script type="text/javascript" src="<?php echo base_url();?>public/slide/caroufredsel/jquery.carouFredSel-6.1.0-packed.js"></script>
    	<script type="text/javascript" src="<?php echo base_url();?>public/slide/caroufredsel/jquery.mousewheel.min.js"></script>
    	<script type="text/javascript" src="<?php echo base_url();?>public/slide/caroufredsel/jquery.touchSwipe.min.js"></script>
    	<script type="text/javascript" src="<?php echo base_url();?>public/slide/caroufredsel/jquery.ba-throttle-debounce.min.js"></script>
    	<script type="text/javascript">
    		$(function() {
    			$('#slide_caroufredsel').carouFredSel({
					prev: '#prev',
					next: '#next',
					pagination: "#pager",
    				scroll: 1,
                    auto: {
    						pauseOnHover: 'resume',
    						progress: '#timer1'
    					}
    			});
    		});
    	</script> 
        <div class="clear-both"></div>
    </div>
    <div class="clear-both"></div>
</div>