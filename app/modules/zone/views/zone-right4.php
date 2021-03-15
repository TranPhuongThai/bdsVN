
                <div class="row m-row margin-top">
                    <div class="clearfix"></div>
                    <?php echo $modnews->newsCategoriesMenu();?>
                    <div class="clearfix"></div>
                </div>
                <div class="row m-row margin-top">
                    <div class="header-title-right-bar">Xem nhiều</div>
                    <div class="clearfix"></div>
                    <?php echo $modnews->newsTopHit(2, 0);?>
                    <div class="clearfix"></div>
                </div>
                <div class="row m-row margin-top">
                    <div class="qcao-right">
                        <?php echo $modads->detail(5, 'news-ads');?>
                    </div>                  
                </div>
                <div class="row m-row margin-top">
                    <div class="header-title-right-bar">Tư vấn</div>
                    <div class="clearfix"></div>
                    <?php echo $modnews->newsAdvisory(3, 0);?>
                    <div class="clearfix"></div>
                </div>
                <!-- <div class="row m-row margin-top">
                    <span class="header-title title-menu">Danh mục nhà đất</span>
                    <div class="clearfix"></div>
                    <?php echo $modreal->listMenu();?>
                    <div class="clearfix"></div>
                </div>
                <div class="row m-row margin-top">
                    <span class="header-title title-menu">Nhà đất khu vực</span>
                    <div class="clearfix"></div>
                    <?php echo $modreal->listDistrict();?>
                    <div class="clearfix"></div>
                </div> -->
                <!-- <div class="row m-row margin-top">
                    <span class="header-title title-support">Hỗ trợ trực tuyến</span>
                    <div class="clearfix"></div>
                    <?php echo $modsupport->index();?>
                    <div class="clearfix"></div>
                </div> -->
                <div class="row m-row margin-top">
                    <div class="qcao-right">
                        <?php echo $modads->detail(6, 'news-ads');?>
                    </div>                  
                </div>