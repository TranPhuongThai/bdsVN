<?php

/**

 * @author Do Van Tien

 * @email dovantien2911@gmail.com 

 * @company Webbox

 * @copyright 2015

 */

?><!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        if(isset($link_canonical)){
            echo $zone->head($seo, $link_canonical);
        }else{
            echo $zone->head($seo);
        }
        
    ?>
</head>

<body role="document">

    <!-- Fixed navbar -->
    <?php echo $zone->top();?>
    <div class="banner">
        <img src="<?php echo base_url();?>public/template-tiendv/image/bg.jpg" title="" alt=""/>
    </div>
    <?php echo $modreal->form('', 0, 0, 0, 0, 0, 0, 0, 0, 'wide');?>
    <div class="wrapper">
        <div class="container main-page">
        <div class="col-md-8 margin-top-bot">
                <div class="row-left m-row-left">
                    <span class="header-title">
                        <span class="col-md-6 active">Nổi bật nhất</span>
                        
                        <a class="view-more" href="<?php echo base_url()._setURL('tin-tuc')."-mnews-1.html";?>" target="_blank">>>Xem tất cả</a>
                        <hr  width="88%" align="left" />
                    </span>
                    
                    <div class="news-list-4">
                        <?php echo $modnews->newsHot(6, 0);?>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 margin-top margin-top-bot">
                <div class="row m-row margin-top">
                    <div class="qcao-right">
                        <?php echo $modads->detail(5);?>
                        <!-- <a href="#" title="" target="_blank"><img width="100%" src="./public/assets/banner/bnr-1.jpg" title="" alt=""/></a> -->
                    </div>                  
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12 margin-top-bot">
                <div class="row m-row">
                    <span class="header-title">
                        <span class="col-md-3 active">Tin đăng mới nhất</span>
                        <a class="view-more" href="<?php echo base_url()._setURL('tin-tuc')."-mnews-1.html";?>" target="_blank">>>Xem tất cả</a>
                        <hr  width="88%" align="left" />
                    </span>
                    <?php echo $modreal->newData2(8,0);?>
                    <div class="clearfix"></div>
                    <div class="center">
                    <a href="/mua-ban-nha-dat-binh-duong" class="btn btn-viewmore"><span class="glyphicon glyphicon-forward"></span>Xem tất cả</a>
                    </div>
                    
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="col-md-12 margin-top-bot bds-area">
                <div class="row m-row">
                    <span class="header-title">
                        <span class="col-md-3 active">BấT động sản theo khu vực</span>
                        <!-- <a class="view-more" href="<?php //echo base_url()._setURL('tin-tuc')."-mnews-1.html";?>" target="_blank">>>Xem tất cả</a> -->
                        <hr  width="88%" align="left" />
                    </span>
                    <a href="#" class="bds-area-img-1"><img src="<?=base_url()?>/public/assets/banner/banner-right.png" alt="" title=""/>
                    </a>
                    <a href="#" class="bds-area-img-2"><img src="<?=base_url()?>/public/assets/banner/banner-right.png" alt="" title=""/>
                    </a>
                    <a href="#" class="bds-area-img-2"><img src="<?=base_url()?>/public/assets/banner/banner-right.png" alt="" title=""/>
                    </a>
                    <a href="#" class="bds-area-img-2"><img src="<?=base_url()?>/public/assets/banner/banner-right.png" alt="" title=""/>
                    </a>
                    <a href="#" class="bds-area-img-2"><img src="<?=base_url()?>/public/assets/banner/banner-right.png" alt="" title=""/>
                    </a>
                    
                    <!-- <div class="col-md-6 row">
                        <a href="#" class="bds-area-img-1"><img src="<?=base_url()?>/public/assets/banner/banner-right.png" alt="" title=""/>
                        </a>
                    </div>
                    <div class="col-md-6 row-right">
                        <div class="row">
                            <div class="col-md-6 row-right">
                                <a href="#" class="bds-area-img-2"><img src="<?=base_url()?>/public/assets/banner/banner-right.png" alt="" title=""/>
                                </a>
                            </div>
                            <div class="col-md-6 row-right">
                                <a href="#" class="bds-area-img-2"><img src="<?=base_url()?>/public/assets/banner/banner-right.png" alt="" title=""/>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 row-right">
                                <a href="#" class="bds-area-img-2"><img src="<?=base_url()?>/public/assets/banner/banner-right.png" alt="" title=""/>
                                </a>
                            </div>
                            <div class="col-md-6 row-right">
                                <a href="#" class="bds-area-img-2"><img src="<?=base_url()?>/public/assets/banner/banner-right.png" alt="" title=""/>
                                </a>
                            </div>
                        </div>
                    </div> -->
                    
                    <div class="clearfix"></div>
                </div>
                <div class="row m-row">
                    <div class="bds-area-title center">Hà Nam<span class="color-blue">(150)</span></div>
                    <div class="bds-area-title center">Hà Nam<span class="color-blue">(150)</span></div>
                    <div class="bds-area-title center">Hà Nam<span class="color-blue">(150)</span></div>
                    <div class="bds-area-title center">Hà Nam<span class="color-blue">(150)</span></div>
                    <div class="bds-area-title center">Hà Nam<span class="color-blue">(150)</span></div>
                    <div class="bds-area-title center">Hà Nam<span class="color-blue">(150)</span></div>
                    <div class="bds-area-title center">Hà Nam<span class="color-blue">(150)</span></div>
                    <div class="bds-area-title center">Hà Nam<span class="color-blue">(150)</span></div>
                    <div class="bds-area-title center">Hà Nam<span class="color-blue">(150)</span></div>
                    <div class="bds-area-title center">Hà Nam<span class="color-blue">(150)</span></div>
                    <div class="bds-area-title center">Hà Nam<span class="color-blue">(150)</span></div>
                    <div class="bds-area-title center">Hà Nam<span class="color-blue">(150)</span></div>
                </div>
            </div>
            <div class="m-row-left margin-top-bot">
                <div class="margin-top qcao-left">
                <?php echo $modads->detail(2);?>
                </div>
            </div>
            <div class="col-md-12 margin-top-bot">
                <div class="row m-row">
                    <span class="header-title">
                        <span class="col-md-3 active">Dự án Bất Động Sản</span>
                        <a class="view-more" href="<?php echo base_url()._setURL('tin-tuc')."-mnews-1.html";?>" target="_blank">>>Xem tất cả</a>
                        <hr  width="88%" align="left" />
                    </span>
                    <?php echo $modreal->newData2(8,0);?>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="col-md-8 margin-top-bot">
                <div class="row-left m-row-left">
                    <span class="header-title">
                        <span class="col-md-3 nha-dep-title active">Nội ngoại thất</span>
                        <span class="col-md-3 phap-li-title">Văn bản pháp lí</span>
                        <span class="col-md-3 phong-thuy-title">Phong Thuỷ</span>
                        <a class="view-more nha-dep" href="#">>>Xem tất cả</a>
                        <a class="view-more phap-li hide" href="#">>>Xem tất cả</a>
                        <a class="view-more phong-thuy hide" href="#">>>Xem tất cả</a>
                        <hr  width="88%" align="left" />
                    </span>
                    <div class="col-md-12 box-shadow">
                        <div class="news-list-5 nha-dep">
                            <?php echo $modnews->newsMenuData2(3,6,0);?>
                        </div>
                        <div class="news-list-5 phap-li hide">
                            <?php echo $modnews->newsMenuData2(5,6,0);?>
                        </div>
                        <div class="news-list-5 phong-thuy hide">
                            <?php echo $modnews->newsMenuData2(4,6,0);?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 margin-top margin-top-bot">
                <div class="row m-row margin-top">
                    <div class="qcao-right-1">
                    <?php echo $modads->detail(5);?>
                        <!-- <a href="#" title="" target="_blank"><img width="100%" src="./public/assets/banner/bnr-1.jpg" title="" alt=""/></a> -->
                    </div>                  
                </div>
            </div>
            <div class="col-md-12 margin-top-bot">
                <div class="row m-row">
                    <span class="header-title">
                        <span class="col-md-3 active">hỗ trợ tiện ích</span>
                        <a class="view-more" href="<?php echo base_url()._setURL('tin-tuc')."-mnews-1.html";?>" target="_blank">>>Xem tất cả</a>
                        <hr  width="88%" align="left" />
                    </span>
                    <a class="col-md-3 col-sm-6 col-xs-12 btn btn-hotro btn-hotro1" href="<?php echo base_url()._setURL('tin-tuc')."-mnews-1.html";?>" target="_blank">Xem tuổi xây nhà</a>
                    <a class="col-md-3 col-sm-6 col-xs-12 btn btn-hotro btn-hotro2" href="<?php echo base_url()._setURL('tin-tuc')."-mnews-1.html";?>" target="_blank">Dự tính chi phí làm nhà</a>
                    <a class="col-md-3 col-sm-6 col-xs-12 btn btn-hotro btn-hotro3" href="<?php echo base_url()._setURL('tin-tuc')."-mnews-1.html";?>" target="_blank">Tính Lãi Suất</a>
                    <a class="col-md-3 col-sm-6 col-xs-12 btn btn-hotro btn-hotro4" href="<?php echo base_url()._setURL('tin-tuc')."-mnews-1.html";?>" target="_blank">Tư vấn phong thuỷ</a>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- <div class="main-slide col-md-12">
                <?php //echo $modslide->jcarousel();?>
            </div> -->
            <!-- <div class="main-slide col-md-4">
                <?php //echo $modslide->jcarousel();?>
            </div>
            <div class="col-md-4 col-sm-6 m-margin-top">
                <?php //echo $modnews->newsData(5, 0);?>
            </div>
            <div class="col-md-4 col-sm-6 m-margin-top">
                <div class="row m-row">
                    <div class="header-title title-star">Tin nổi bật</div>
                    <div class="clearfix"></div>
                    <?php //echo $modnews->newsHot(4, 0);?>
                </div>
            </div>
            
            <div class="clearfix"></div>
            <div class="col-md-8 margin-top">
                <div class="row-left m-row-left">
                    <div class="qcao-left">
                        <?php echo $modads->detail(2);?>
                    </div>
                    <div class="clearfix"></div>
                    <span class="header-title title-news margin-top">Nhà đất Bình Dương Giá rẻ</span>
                    <?php echo $modreal->newData(6,0);?>
                    <div class="clearfix"></div>
                    <a href="/mua-ban-nha-dat-binh-duong" class="read-more"><span class="glyphicon glyphicon-forward"></span>Xem thêm các tin rao nhà đất tương tự</a>
                    <div class="clearfix"></div>
                    <hr />
                    <div class="col-sm-6 text-left pagination-2">
                        <div class="row m-row">
                            Tin nhà bán mới nhất: 
                            <ul>
                                <li><a href="/nha-ban-binh-duong" class="color-green">1</a></li>
                                <li><a href="/nha-ban-binh-duong/10" class="color-green">2</a></li>
                                <li><a href="/nha-ban-binh-duong/20" class="color-green">3</a></li>
                                <li><a href="/nha-ban-binh-duong/30" class="color-green">4</a></li>
                                <li><a href="/nha-ban-binh-duong/40" class="color-green">5</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 text-right pagination-2 m-margin-top-2 m-text-left-2">
                        <div class="row m-row">
                            Tin đất bán mới nhất: 
                            <ul>
                                <li><a href="/dat-ban-binh-duong" class="color-green">1</a></li>
                                <li><a href="/dat-ban-binh-duong/10" class="color-green">2</a></li>
                                <li><a href="/dat-ban-binh-duong/20" class="color-green">3</a></li>
                                <li><a href="/dat-ban-binh-duong/30" class="color-green">4</a></li>
                                <li><a href="/dat-ban-binh-duong/40" class="color-green">5</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <hr />
                    <div class="clearfix"></div>
                    <?php echo $modnews->newsMenuData1(1,5,0);?>
                    <div class="clearfix"></div>
                    <?php echo $modnews->newsMenuData1(2,5,0);?>
                    <div class="clearfix"></div>
                    
                    <div class="news-list-5 col-md-6 col-xs-12">
                        <div class="row-left m-row-2">
                            <?php echo $modnews->newsMenuData2(3,5,0);?>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="news-list-5 col-md-6 col-xs-12">
                        <div class="row-right m-row-2">
                            <?php echo $modnews->newsMenuData2(4,5,0);?>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 margin-top">
                <?php //echo $zone->right();?>
            </div> -->
            
            
        </div>
    </div>
    <script>
        $(".nha-dep-title").click(function(){
            $(".nha-dep").removeClass("hide");
            $(".phap-li").addClass("hide");
            $(".phong-thuy").addClass("hide");

            $(".nha-dep-title").addClass("active");
            $(".phap-li-title").removeClass("active");
            $(".phong-thuy-title").removeClass("active");
        });
        $(".phap-li-title").click(function(){
            $(".phap-li").removeClass("hide");
            $(".nha-dep").addClass("hide");
            $(".phong-thuy").addClass("hide");

            $(".phap-li-title").addClass("active");
            $(".nha-dep-title").removeClass("active");
            $(".phong-thuy-title").removeClass("active");
        });
        $(".phong-thuy-title").click(function(){
            $(".phong-thuy").removeClass("hide");
            $(".phap-li").addClass("hide");
            $(".nha-dep").addClass("hide");

            $(".phong-thuy-title").addClass("active");
            $(".phap-li-title").removeClass("active");
            $(".nha-dep-title").removeClass("active");
        });
    </script>
    <?php echo $zone->bot();?>

</body>
</html>
