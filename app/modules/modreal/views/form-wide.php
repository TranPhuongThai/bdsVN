<?php
$form = array(
    "name"      => "fSearchWide",
    "method"    => "GET",
);

$menuSelectList = array(0=>'Danh mục BĐS');
foreach($menu_list as $row){
    $menuSelectList[$row['ID']] = $row['Name'];
}

$provinceSelectList = array(0=>'Tỉnh/Thành phố');
foreach($province_list as $row){
    $provinceSelectList[$row['ID']] = $row['Name'];
}
$districtSelectList = array(0=>'Quận/Huyện');
foreach($district_list as $row){
    $districtSelectList[$row['ID']] = $row['Name'];
}

$wardSelectList = array(0=>'Phường/Xã');
foreach($ward_list as $row){
    $wardSelectList[$row['ID']] = $row['Name'];
}

$areaSelectList = array(
    "0" => "Diện tích",
    "10" => "10 - 50 m2",
    "50" => "50 - 100 m2",
    "100" => "100 - 150 m2",
    "150" => "150 - 200 m2",
    "200" => "200 - 300 m2",
    "300" => "300 - 500 m2",
    "500" => " &rsaquo; 500 m2",
);

$costSelectList = array(
    "0" => "Mức giá",
    "1" => "100 - 300 triệu",
    "3" => "300 - 600 triệu",
    "6" => "600 - 800 triệu",
    "8" => "800 triệu - 1 tỷ",
    "10" => "1 tỷ - 1.5 tỷ",
    "15" => "1.5 tỷ - 2 tỷ",
    "20" => "2 tỷ tới 3 tỷ",
    "30" => "3 tỷ - 5 tỷ",
    "50" => "trên 5 tỷ",
);

$directionSelectList = array(
    "0" => "Hướng nhà",
    "1" => "Đông",
    "2" => "Tây",
    "3" => "Nam",
    "4" => "Bắc",
    "5" => "Đông Bắc",
    "6" => "Đông Nam",
    "7" => "Tây Bắc",
    "8" => "Tây Nam",
);

$bedRoomSelectList = array(
    "0" => "Số phòng ngủ",
    "1" => "1 +",
    "2" => "2 +",
    "3" => "3 +",
    "4" => "4 +",
    "5" => "5 +",
    "6" => "6 +",
);

$sittingRoomSelectList = array(
    "0" => "Số phòng khách",
    "1" => "1 +",
    "2" => "2 +",
    "3" => "3 +",
    "4" => "4 +",
    "5" => "5 +",
    "6" => "6 +",
);

?>
<div id="main-search">
    <div class="container">
        <!-- <ul>
            <li class="active" data-type="0">Nhà bán</li>
            <li data-type="2">Đất bán</li>
        </ul> -->
        <div class="clearfix"></div>
        <?php echo form_open("tim-nha-dat-binh-duong",$form);?>
            <input name="type" type="hidden" value="1"/>
            <div class="col-md-2 col-sm-3 col-xs-12 search-option">
                <div class="radio">
                    <label><input type="radio" name="optradio" checked>Mua bán</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="optradio">Thuê, cho thuê</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="optradio">Sang nhượng</label>
                </div>
            </div>
                
            <div  class="col-md-10 col-sm-9 col-xs-12 search-input">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="form-group">
                            <input type="text" name="textSelect" class="form-control" placeholder="Nhập địa điểm" value="<?php echo $textSelect;?>"/>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <input class="btn btn-warning form-control" type="submit" value="Tìm Kiếm"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    
                    <div class="col-sm-3">
                        <div class="form-group">
                        <?php echo form_dropdown('menuSelect', $menuSelectList, $menuSelect, "class=\"form-control\""); ?>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                        <?php echo form_dropdown('costSelect', $costSelectList, $costSelect, "class=\"form-control\""); ?>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                        <?php echo form_dropdown('areaSelect', $areaSelectList, $areaSelect, "class=\"form-control\""); ?>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                        <a class="expand-search"><i class="fas fa-map-marked-alt"></i>Mở rộng</a>
                        <a class="colapse-search hide"><i class="fas fa-map-marked-alt"></i>Thu gọn</a>
                        </div>
                    </div>
                </div>
                <div class="row expanded-search hide">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <?php echo form_dropdown('wardSelect', $wardSelectList, $wardSelect, "id=\"ward_list\" class=\"form-control\""); ?>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                        <?php echo form_dropdown('districtSelect', $districtSelectList, $districtSelect, "id=\"district_list\" class=\"form-control\""); ?>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                        <?php echo form_dropdown('provinceSelect', $provinceSelectList, $provinceSelect, "id=\"province_list\" class=\"form-control\""); ?>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            
                        </div>
                    </div>
                </div>
                <div class="row expanded-search hide">
                    <div class="col-sm-3">
                        <div class="form-group">
                        <?php echo form_dropdown('bedRoomSelect', $bedRoomSelectList, $bedRoomSelect, 'data-type="2" class="form-control"'); ?>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                        <?php echo form_dropdown('sittingRoomSelect', $sittingRoomSelectList, $sittingRoomSelect, 'data-type="2" class="form-control"'); ?>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                        <?php echo form_dropdown('directionSelect', $directionSelectList, $directionSelect, "class=\"form-control\""); ?>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                        <a><i class="fas fa-map-marked-alt"></i>Tìm kiếm nâng cao</a>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        <?php echo form_close();?>
    </div>
</div>
<script>
    $(".expand-search").click(function(){
        $(".expanded-search").removeClass("hide");
        $(".colapse-search").removeClass("hide");
        $(".expand-search").addClass("hide");
    });
    $(".colapse-search").click(function(){
        $(".expanded-search").addClass("hide");
        $(".expand-search").removeClass("hide");
        $(".colapse-search").addClass("hide");
    });
</script>