<?php
$form = array(
    "name"      => "fSearchWide",
    "method"    => "GET",
);

$menuSelectList = array(0=>'Danh mục BĐS');
foreach($menu_list as $row){
    $menuSelectList[$row['ID']] = $row['Name'];
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
        <ul>
            <li class="active" data-type="0">Nhà bán</li>
            <li data-type="2">Đất bán</li>
        </ul>
        <div class="clearfix"></div>
        <?php echo form_open("tim-nha-dat-binh-duong",$form);?>
            <input name="type" type="hidden" value="1"/>
            <div class="col-sm-12 form-item">
                <input type="text" name="textSelect" placeholder="Nhập địa điểm" value="<?php echo $textSelect;?>"/>
            </div>
            <div class="col-md-2 col-sm-3 col-xs-6 form-item">
                <?php echo form_dropdown('menuSelect', $menuSelectList, $menuSelect); ?>
            </div>
            <div class="col-md-2 col-sm-3 col-xs-6 form-item">
                <?php echo form_dropdown('districtSelect', $districtSelectList, $districtSelect, "id=\"district_list\""); ?>
            </div>
            <div class="col-md-2 col-sm-3 col-xs-6 form-item">
                <?php echo form_dropdown('wardSelect', $wardSelectList, $wardSelect, "id=\"ward_list\""); ?>
            </div>
            <div class="col-md-2 col-sm-3 col-xs-6 form-item">
                <?php echo form_dropdown('areaSelect', $areaSelectList, $areaSelect); ?>
            </div>
            <div class="col-md-2 col-sm-3 col-xs-6 form-item">
                <?php echo form_dropdown('costSelect', $costSelectList, $costSelect); ?>
            </div>
            <div class="col-md-2 col-sm-3 col-xs-6 form-item">
                <?php echo form_dropdown('directionSelect', $directionSelectList, $directionSelect); ?>
            </div>
            <div class="col-md-2 col-sm-3 col-xs-6 form-item">
                <?php echo form_dropdown('bedRoomSelect', $bedRoomSelectList, $bedRoomSelect, 'data-type="2"'); ?>
            </div>
            <div class="col-md-2 col-sm-3 col-xs-6 form-item">
                <?php echo form_dropdown('sittingRoomSelect', $sittingRoomSelectList, $sittingRoomSelect, 'data-type="2"'); ?>
            </div>
            <div class="col-md-2 col-sm-3 col-xs-6 form-item">
                <input type="submit" value="Tìm Kiếm"/>
            </div>
            <div class="clearfix"></div>
        <?php echo form_close();?>
    </div>
</div>