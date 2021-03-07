<div class="real-detail">
    <h1 class="real-detail-title"><?php echo $real_check['Name'];?></h1>
    <div class="real-detail-position"><span class="glyphicon glyphicon-map-marker"></span>&nbsp;&nbsp;Khu vực: <?php echo $real_check['Address'],', ',$real_check['WName'],', ',$real_check['DName'];?>, Bình Dương</div>
    <div class="real-detail-cost">
        Giá: <span><?php echo _readMoney($real_check['Cost']);?> VND</span>&nbsp;&nbsp;&nbsp;&nbsp;
        Diện tích <span><?php echo $real_check['LandArea'];?> m<sup>2</sup></span>
        <div class="share" style="float: right;">
            <div class="g-plus"><div class="g-plusone" data-href="<?php echo base_url(_setURL($real_check['Name']).'-real-'.$real_check['ID']);?>.html" data-size="medium"></div></div>
            <div class="fb-like" data-href="<?php echo base_url(_setURL($real_check['Name']).'-real-'.$real_check['ID']);?>.html" data-share="false" data-send="true" data-layout="button_count" data-width="120" data-show-faces="true"></div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="real-detail-maincontent">
        <div class="real-detail-maincontent-title">Thông tin mô tả</div>
        <?php echo $real_check['Content'];?>
    </div>
    <div class="real-detail-img">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#tabSlide" aria-controls="tabSlide" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-picture"></span>&nbsp;&nbsp;Hình ảnh</a></li>
            <li role="presentation"><a href="#tabMap" aria-controls="tabMap" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-globe"></span>&nbsp;&nbsp;Bản đồ</a></li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="tabSlide">
                <div id="slider" class="flexslider">
                    <ul class="slides">
                    <?php 
                    if(!$img_list){
                    ?>
                        <li>
                            <img src="<?php echo $real_check['Img'];?>" title="<?php echo $real_check['Name'];?>" alt="<?php echo $real_check['Name'];?>"/>
                    	</li>
                    <?php
                    }else{
                        foreach($img_list as $row){ 
                    ?>
                        <li>
                            <img src="<?php echo $row['Img'];?>" title="<?php echo $row['Name'];?>" alt="<?php echo $row['Name'];?>"/>
                    	</li>
                    <?php 
                        } 
                    }
                    ?>
                    </ul>
                </div>
                <div id="carousel" class="flexslider">
                    <ul class="slides">
                    <?php 
                    if(!$img_list){
                    ?>
                        <li>
                            <img src="<?php echo $real_check['Img'];?>" title="<?php echo $real_check['Name'];?>" alt="<?php echo $real_check['Name'];?>"/>
                    	</li>
                    <?php
                    }else{
                        foreach($img_list as $row){ 
                    ?>
                        <li>
                            <img src="<?php echo $row['Img'];?>" title="<?php echo $row['Name'];?>" alt="<?php echo $row['Name'];?>"/>
                    	</li>
                    <?php 
                        } 
                    }
                    ?>
                    </ul>
                </div>
                <link rel="stylesheet" href="<?php echo base_url();?>public/template-tiendv/plugin/flexslider/flexslider.css" type="text/css" media="screen" />
                <script src="<?php echo base_url();?>public/template-tiendv/plugin/flexslider/jquery.flexslider-min.js"></script>
                <script src="<?php echo base_url();?>public/template-tiendv/plugin/flexslider/jquery.easing.js"></script>
                <script src="<?php echo base_url();?>public/template-tiendv/plugin/flexslider/jquery.mousewheel.js"></script>

                <script type="text/javascript">
                    $(window).load(function(){
                        $('#carousel').flexslider({
                        animation: "slide",
                        controlNav: false,
                        animationLoop: false,
                        slideshow: false,
                        itemWidth: 152,
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
            <div role="tabpanel" class="tab-pane" id="tabMap">
                <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=AIzaSyAhdUArEcXDm-O8cc_4l6nulWOLX4vcNEw"></script>
                <div align="center" id="map"></div>
                <script>
                    function loadMap() {
                    	if (GBrowserIsCompatible()) {
                    		var map = new GMap2(document.getElementById("map"));
                    		map.addControl(new GSmallMapControl());
                    		map.addControl(new GMapTypeControl());
                    		var center = new GLatLng(<?php echo $real_check['Lat'] ? $real_check['Lat'] : '10.91560';?>, <?php echo $real_check['Lng'] ? $real_check['Lng'] : '106.76920';?>);
                    		map.setCenter(center, 15);
                    		geocoder = new GClientGeocoder();
                    		var marker = new GMarker(center, {
                    			draggable: true
                    		});
                    		map.addOverlay(marker);
                    	}
                    }
                    
                    if(window.attachEvent) {
                        window.attachEvent('onload', loadMap);
                    } else {
                        if(window.onload) {
                            var curronload = window.onload;
                            var newonload = function() {
                                curronload();
                                loadMap();
                            };
                            window.onload = newonload;
                        } else {
                            window.onload = loadMap;
                        }
                    }
                </script>
            </div>
        </div>
    </div>
    <div class="real-detail-info margin-top">
        <div class="col-xs-6">
            <div class="real-detail-maincontent-title">Đặc điểm</div>
            <table class="table">
                <tbody>
                    <tr class="success">
                        <td>Danh mục</td>
                        <td><?php echo $real_check['MName'];?></td>
                    </tr>
                    <tr class="">
                        <td>Hướng nhà</td>
                        <td><?php echo $real_check['Direction'];?></td>
                    </tr>
                    <tr class="success">
                        <td>Số phòng khách</td>
                        <td><?php echo $real_check['SittingRoom'];?></td>
                    </tr>
                    <tr class="">
                        <td>Số phòng ngủ</td>
                        <td><?php echo $real_check['BedRoom'];?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-xs-6">
            <div class="real-detail-maincontent-title">Thông tin liên hệ</div>
            <table class="table">
                <tbody>
                    <tr class="success">
                        <td>Tên liên lạc</td>
                        <td><?php echo $user_check['Name'];?></td>
                    </tr>
                    <tr class="">
                        <td>Điện thoại</td>
                        <td><?php echo $user_check['Phone'];?></td>
                    </tr>
                    <tr class="success">
                        <td>Email</td>
                        <td><?php echo $user_check['Username'];?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="real-detail-maincontent">
        <div class="real-detail-maincontent-title">Bình luận</div>
        <div class="fb-comments" data-href="<?php echo base_url(_setURL($real_check['Name']).'-real-'.$real_check['ID']);?>.html" data-width="100%" data-numposts="10"></div>
    </div>
    <div class="clearfix"></div>
</div>

<div class="header-title title-news margin-top">
    <a href="<?php echo base_url()._setURL($real_check['MName'])."-rm-".$real_check['Menu'].".html";?>">Tin rao cùng khu vực</a>
</div>
<ul class="news-list-3">
<?php foreach($real_list as $row){?>
    <li>
        <div class="col-sm-3">
            <div class="row-left m-row-left">
                <a class="img" href="<?php echo base_url()._setURL($row['Name'])."-real-".$row['ID'].".html";?>" title="<?php echo $row['Name'];?>"><img src="<?php echo $row['Thumb1'];?>" title="<?php echo $row['Name'];?>" alt="<?php echo $row['Name'];?>"/></a>    
            </div>    
        </div>
        <div class="col-sm-9">
            <div class="row">
                <a class="tit" href="<?php echo base_url()._setURL($row['Name'])."-real-".$row['ID'].".html";?>" title="<?php echo $row['Name'];?>"><?php echo $row['Name'];?></a>
                <label><span class="glyphicon glyphicon-tag"></span>&nbsp;&nbsp;Giá</label><span class="color-green font-bold">: <?php echo _readMoney($row['Cost']) ?></span><br />
                <label><span class="glyphicon glyphicon-tower"></span>&nbsp;&nbsp;Diện tích</label>: <?php echo (int)($row['LandArea']);?> m<sup>2</sup><br />
                <label><span class="glyphicon glyphicon-map-marker"></span>&nbsp;&nbsp;Vị trí</label>: <?php echo $row['DName'];?>, Bình Dương
                <span class="news-date"><?php echo date("d/m/Y",strtotime($row['DateUp']));?></span>
            </div>
        </div>
        <div class="clearfix"></div>
    </li>
<?php } ?>
</ul>