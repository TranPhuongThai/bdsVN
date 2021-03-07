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
    <?php echo $modreal->form('', 0, 0, 0, 0, 0, 0, 0, 0, 'wide');?>
    <div class="wrapper">
        <div class="container">
            <div class="main-slide col-md-4">
                <?php echo $modslide->jcarousel();?>
            </div>
            <div class="col-md-4 col-sm-6 m-margin-top">
                <?php echo $modnews->newsData(5, 0);?>
            </div>
            <div class="col-md-4 col-sm-6 m-margin-top">
                <div class="row m-row">
                    <div class="header-title title-star">Tin nổi bật</div>
                    <div class="clearfix"></div>
                    <?php echo $modnews->newsHot(4, 0);?>
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
                <?php echo $zone->right();?>
            </div>
            
            
        </div>
    </div>
    <?php echo $zone->bot();?>

</body>
</html>
