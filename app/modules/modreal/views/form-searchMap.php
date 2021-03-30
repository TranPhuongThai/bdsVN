<?php
$form = array(
    "name"      => "fSearchMap",
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

$locations = [];
foreach($real_list as $real){
    if($real['Lat'] != "" && $real['Lat'] != ""){
        $locations[] = ['lat'=>$real['Lat'],'lng'=>$real['Lng']];
    }
    
}
?>
<div id="searchMap">
    <div class="container">
        <!-- <ul>
            <li class="active" data-type="0">Nhà bán</li>
            <li data-type="2">Đất bán</li>
        </ul> -->
        <div class="clearfix"></div>
        <?php echo form_open("tim-kiem-bang-ban-do",$form);?>
            <div  class="col-md-3 col-sm-3 col-xs-12">
                <h3>Tìm kiếm theo</h3>
            </div>
            <div  class="col-md-9 col-sm-9 col-xs-12 search-input margin-top">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                        <?php echo form_dropdown('provinceSelect', $provinceSelectList, $provinceSelect, "id=\"province_list\" class=\"form-control\""); ?>
                        </div>
                    </div>
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
                            <input class="btn btn-warning form-control" type="submit" value="Tìm Kiếm"/>
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
    var locations = <?php echo json_encode($locations)?>;
    
</script>