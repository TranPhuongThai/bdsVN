
                <div class="row m-row">
                    <?php echo $modreal->form('', 0,0,0,0,0,0,0,0,0,'right');?>
                    <div class="clearfix"></div>
                </div>
                <div class="row m-row margin-top">
                    <span class="header-title title-support">Nhà đất cùng chuyên mục</span>
                    <div class="clearfix"></div>
                    <?php echo $modreal->districtData($district, 6, 0);?>
                    <div class="clearfix"></div>
                </div>
                <div class="row m-row margin-top">
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
                </div>
                <div class="row m-row margin-top">
                    <span class="header-title title-support">Hỗ trợ trực tuyến</span>
                    <div class="clearfix"></div>
                    <?php echo $modsupport->index();?>
                    <div class="clearfix"></div>
                </div>
                <div class="row m-row margin-top">
                    <div class="qcao-right">
                        <?php echo $modads->detail(5);?>
                    </div>                  
                </div>