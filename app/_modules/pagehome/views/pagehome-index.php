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
    <?php echo $zone->head($seo, $link_canonical);?>
</head>

<body role="document">

    <!-- Fixed navbar -->
    <?php echo $zone->top();?>
    <div class="wrapper">
        <div class="container">
            <?php echo $modslide->jcarousel();?>
            <div class="col-md-3 m-margin-top">
                <div class="row m-row">
                    <span class="header-title">Dịch vụ nổi bật</span>
                    <?php echo $modnews->newsHotMenu(6, 4, 0);?>
                </div>
            </div>
            <div class="col-md-3 m-margin-top">
                <ul class="nav nav-tabs tab-top" role="tablist">
                    <li role="presentation" class="active"><a href="#tab-top-1" aria-controls="tab-top-1" role="tab" data-toggle="tab">Tìm kiếm</a></li>
                </ul>
                <div class="tab-content tab-top-content">
                    <div role="tabpanel" class="tab-pane active" id="tab-top-1">
                        <?php echo $modreal->form();?>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-2 margin-top">
                <div class="qcao-left">
                    <?php echo $modads->local(2,8);?>
                </div>
                <div class="chosen-dv margin-top">
                    <?php echo $modtext->getTextRight(4);?>
                </div>
            </div>
            <div class="col-md-10 margin-top">
                <div class="row-left m-row-left">
                    <ul class="nav nav-tabs tab-mid" role="tablist">
                        <li role="presentation" class="active"><a href="#tab-mid-1" aria-controls="tab-mid-1" role="tab" data-toggle="tab">Tin mới</a></li>
                        <li role="presentation"><a href="#tab-mid-2" aria-controls="tab-mid-2" role="tab" data-toggle="tab">Rất hấp dẫn</a></li>
                        <li role="presentation"><a href="#tab-mid-3" aria-controls="tab-mid-3" role="tab" data-toggle="tab">Xem nhiều</a></li>
                    </ul>
                    <div class="tab-content tab-mid-content">
                        <div role="tabpanel" class="tab-pane active" id="tab-mid-1">
                            <?php echo $modreal->newData(4,0);?>
                            <div class="clearfix"></div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="tab-mid-2">
                            <?php echo $modreal->hotData(4,0);?>
                            <div class="clearfix"></div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="tab-mid-3">
                            <?php echo $modreal->hitData(4,0);?>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-8 margin-top">
                        <div class="row">
                            <span class="header-title">Nhà đất Bình Dương Giá rẻ</span>
                            <?php echo $modreal->newData2(6,0);?>
                            <nav>
                                <ul class="pagination">
                                    <li>
                                        <a href="/mua-ban-nha-dat-binh-duong/1" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    <li><a href="/mua-ban-nha-dat-binh-duong/1">1</a></li>
                                    <li><a href="/mua-ban-nha-dat-binh-duong/2">2</a></li>
                                    <li><a href="/mua-ban-nha-dat-binh-duong/3">3</a></li>
                                    <li><a href="/mua-ban-nha-dat-binh-duong/4">4</a></li>
                                    <li><a href="/mua-ban-nha-dat-binh-duong/5">5</a></li>
                                    <li>
                                    <a href="/mua-ban-nha-dat-binh-duong/1" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-md-4 margin-top">
                        <?php echo $zone->right();?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo $zone->bot();?>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="public/js/bootstrap.min.js"></script>
    <script src="public/js/docs.min.js"></script>
    <script src="public/js/script.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="public/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>
