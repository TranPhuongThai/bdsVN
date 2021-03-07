<?php
    $district_select["0"] = "--";
    foreach($district_list as $row){
        $district_select[$row['ID']] = $row['Name'];
    }
    $menu_select["0"] = "--";
    foreach($menu_list as $row){
        $menu_select[$row['ID']] = $row['Name'];
    }
    $direction_select = array(
        "0"=>"--",
        "Đông"=>"Đông",
        "Tây"=>"Tây",
        "Nam"=>"Nam",
        "Bắc"=>"Bắc",
        "Đông Bắc"=>"Đông Bắc",
        "Đông Nam"=>"Đông Nam",
        "Tây Bắc"=>"Tây Bắc",
        "Tây Nam"=>"Tây Nam"
        );
    $area_select = array(
        "0"=>"--",
        "4"=>"Từ 40 m2 tới 60m2",
        "6"=>"Từ 60 m2 tới 80m2",
        "8"=>"Từ 80 m2 tới 100 m2",
        "10"=>"Từ 100 m2 tới 120 m2",
        "12"=>"Từ 120 m2 tới 180 m2",
        "18"=>"Từ 180 m2 tới 250 m2",
        "25"=>"Từ 250 m2 tới 350 m2",
        "35"=>"Trên 350 m2",
    );
    $cost_select = array(
        "0"=>"--",
        "1"=>"Từ 100 triệu tới 300 triệu",
        "3"=>"Từ 300 triệu tới 600 triệu",
        "6"=>"Từ 600 triệu tới 800 triệu",
        "8"=>"Từ 800 triệu tới 1 tỷ",
        "10"=>"Từ 1 tỷ tới 1,5 tỷ",
        "15"=>"Từ 1,5 tỷ tới 2 tỷ",
        "20"=>"Từ 2 tỷ tới 2,5 tỷ",
        "25"=>"Từ 2,5 tỷ tới 3 tỷ",
        "30"=>"Trên 3 tỷ",
    );
?>
                        <form class="form-horizontal form-search" action="<?php echo base_url('/tim-kiem-nha-dat-binh-duong');?>" method="GET">
                            <div class="form-group">
                                <label for="inputDistrict" class="col-sm-4 control-label">Quận</label>
                                <div class="col-sm-8">
                                    <?php echo form_dropdown("district",$district_select,$district, ' class="form-control" id="inputDistrict"');?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputMenu" class="col-sm-4 control-label">Danh mục</label>
                                <div class="col-sm-8">
                                    <?php echo form_dropdown("menu",$menu_select,$rmenu, ' class="form-control" id="inputMenu"');?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputArea" class="col-sm-4 control-label">Diện tích</label>
                                <div class="col-sm-8">
                                    <?php echo form_dropdown("area",$area_select,$area, ' class="form-control" id="inputArea"');?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputCost" class="col-sm-4 control-label">Giá tiền</label>
                                <div class="col-sm-8">
                                    <?php echo form_dropdown("cost",$cost_select,$cost, ' class="form-control" id="inputCost"');?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputCost" class="col-sm-4 control-label"></label>
                                <div class="col-sm-8">
                                    <input type="submit" value="Tìm kiếm" class="btn btn-primary"/>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </form>