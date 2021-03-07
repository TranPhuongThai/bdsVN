<span class="header-title"><h2><?php echo $real_check['Name'];?></h2></span>
<div class="real-content">
    <div class="real-content-image margin-top">
        <div id="slider" class="flexslider">
            <ul class="slides">
            <?php
                foreach($img_list as $row){
            ?>
				<li>
					<img src="<?php echo $row['Img'];?>" title="<?php echo $row['Name'];?>" alt="<?php echo $row['Name'];?>"/>
				</li>
            <?php
                }
            ?>
            </ul>
        </div>
        <div id="carousel" class="flexslider">
            <ul class="slides">
            <?php
                foreach($img_list as $row){
            ?>
				<li>
					<img src="<?php echo $row['Img'];?>" title="<?php echo $row['Name'];?>" alt="<?php echo $row['Name'];?>"/>
				</li>
            <?php
                }
            ?>
            </ul>
        </div>
        <link rel="stylesheet" href="/public/plugin/flexslider/flexslider.css" type="text/css" media="screen" />
        <script src="/public/plugin/flexslider/jquery.flexslider-min.js"></script>
        <script src="/public/plugin/flexslider/jquery.easing.js"></script>
        <script src="/public/plugin/flexslider/jquery.mousewheel.js"></script>

        <script type="text/javascript">
            $(window).load(function(){
                $('#carousel').flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                itemWidth: 160,
                itemMargin: 5,
                asNavFor: '#slider'
                });
                
                $('#slider').flexslider({
                    animation: "slide",
                    controlNav: false,
                    animationLoop: false,
                    slideshow: false,
                    sync: "#carousel",
                    start: function(slider){
                        $('body').removeClass('loading');
                    }
                });
            });
        </script>
    </div>
    <div class="real-content-desc margin-top">
        <span class="real-content-desc-1">Danh mục: <?php echo $real_check['MName'];?></span> I 
        <span class="real-content-desc-2">Khu vực: <?php echo $real_check['Address'],', ',$real_check['DName'];?></span> I 
        <span class="real-content-desc-3">Diện tích: <?php echo $real_check['LandArea'];?> m2</span> I 
        <span class="real-content-desc-4">Giấy tờ: <?php echo $real_check['Legal'];?></span> I 
        <span class="real-content-desc-5">Giá: <?php echo _readMoney($real_check['Cost']);?> triệu</span>
        <strong><?php echo $real_check['MainContent'];?></strong>
    </div>
    <div class="real-content-long margin-top"><?php echo $real_check['Content'];?></div>
    
</div>

<div class="clearfix margin-top"></div>
<span class="header-title">Có thể bạn quan tâm</span>
<div class="real-other">
    <ul class="news-list-2">
    <?php
        foreach($real_list as $row){
    ?>
        <li class="col-sm-3">
            <div class="row-left m-row-left">
                <a href="<?php echo base_url()._setURL($row['Name'])."-real-".$row['ID'].".html";?>" title="<?php echo $row['Name'];?>">
                    <img src="<?php echo base_url()._setURL($row['Name'])."-real-".$row['ID'].".html";?>" title="<?php echo $row['Name'];?>" alt="<?php echo $row['Name'];?>"/>
                    <span class="name"><?php echo $row['Name'];?></span>
                </a>
                <span>Khu vực: <?php echo $row['DName'];?></span>
                <span>Diện tích: <?php echo $row['LandArea'];?> m2</span>
                <span>Giấy tờ: <?php echo $row['Legal'];?></span>
                <span>Giá: <?php echo _readMoney($row['Cost']);?> triệu</span>
            </div>
        </li>
    <?php
        }
    ?>
    </ul>
    <div class="clearfix"></div>
</div>