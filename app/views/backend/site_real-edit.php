<?php

/**
 * @author Do Van Tien
 * @email dovantien2911@gmail.com
 * @company Webbox.com.vn
 * @copyright 2012
 */
 
//select province
$temp = array();
foreach($province_list as $row){
    $temp[$row['ID']] = $row['Name'];
}
$province_list = $temp;

//select province id = 31
$temp = array();
foreach($district_list as $row){
    $temp[$row['ID']] = $row['Name'];
}
$district_list = $temp;

//select district id = 8
$temp = array();
foreach($ward_list as $row){
    $temp[$row['ID']] = $row['Name'];
}
$ward_list = $temp;


$form = array(
    "name"      => "fadmin",
    "id"        => "freal",
    "class"     => "validate border-1 border-style-solid border-color-ccc background-color-fff padding-10",
); 
$name = array(
    "name"      => "name",
    "value"     => $real_check['Name'],
    "class"     => "required focus text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);

//$img = array(
//    "name"      => "img",
//    "value"     => set_value("img"),
//    "id"        => "IMAGES",
//    "class"     => "required text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
//);
$img1 = array(
    "type"      => "file",
    "name"      => "img1",
    "class"     => "text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$img2 = array(
    "type"      => "file",
    "multiple"  => "",
    "name"      => "img2[]",
    "class"     => "text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$maincontent = array(
    "name"      => "maincontent",
    "value"     => $real_check['MainContent'],
    "class"     => "text width-400 height-100 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$content = array(
    "name"      => "content",
    "value"     => $real_check['Content'],
    "id"        => "CONTENT",
    "class"     => "required text width-400 height-100 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
    "minlength" => "20",
);
$arrType = array('1'=>'Nhà bán','2'=>'Đất bán');
$type = array(
    "name"      => "type",
    "value"     => $real_check['Type'],
    "class"     => "width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
if($real_check['Hot'] == 1){
    $hot = array(
        "name"      => "hot",
        "class"     => "checkbox border-1 border-color-ccc border-style-solid",
        "value"     => "1",
        "checked"   => "checked",
    );
}else{
    $hot = array(
        "name"      => "hot",
        "class"     => "checkbox border-1 border-color-ccc border-style-solid",
        "value"     => "1",
    );
}
if($real_check['New'] == 1){
    $new = array(
        "name"      => "new",
        "class"     => "checkbox border-1 border-color-ccc border-style-solid",
        "value"     => "1",
        "checked"   => "checked",
    );
}else{
    $new = array(
        "name"      => "new",
        "class"     => "checkbox border-1 border-color-ccc border-style-solid",
        "value"     => "1",
    );
}
$state_list = array("0"=>"Chưa bán","1"=>"Đã bán");

$arrStatus = array("1"=>"Hiển thị", "0"=>"Không hiển thị");
$status = array(
    "name"      => "status",
    "class"     => "checkbox border-1 border-color-ccc border-style-solid",
    "value"     => "1",
);
$legal = array(
    "name"      => "legal",
    "value"     => $real_check['Legal'],
    "class"     => "text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$editor = array(
    "name"      => "editor",
    "value"     => $real_check['Editor'],
    "class"     => "text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$source = array(
    "name"      => "source",
    "value"     => $real_check['Source'],
    "class"     => "text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$tags = array(
    "name"      => "tags",
    "value"     => $real_check['Tags'],
    "class"     => "text width-400 height-32 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$mtit = array(
    "name"      => "mtit",
    "value"     => $real_check['MTit'],
    "class"     => "text width-400 height-32 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$mkey = array(
    "name"      => "mkey",
    "value"     => $real_check['MKey'],
    "class"     => "text width-400 height-32 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$mdes = array(
    "name"      => "mdes",
    "value"     => $real_check['MDes'],
    "class"     => "text width-400 height-32 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$landarea = array(
    "name"      => "landarea",
    "value"     => $real_check['LandArea'],
    "class"     => "text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$usablearea = array(
    "name"      => "usablearea",
    "value"     => $real_check['UsableArea'],
    "class"     => "text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$sittingroom = array(
    "name"      => "sittingroom",
    "value"     => $real_check['SittingRoom'],
    "class"     => "text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$bedroom = array(
    "name"      => "bedroom",
    "value"     => $real_check['BedRoom'],
    "class"     => "text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$toilet = array(
    "name"      => "toilet",
    "value"     => $real_check['Toilet'],
    "class"     => "text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$garage = array(
    "name"      => "garage",
    "class"     => "checkbox border-1 border-color-ccc border-style-solid",
    "value"     => "1",
);
if($real_check['Garage']){
    $garage['checked'] = 'checked';
}
$tvcable = array(
    "name"      => "tvcable",
    "class"     => "checkbox border-1 border-color-ccc border-style-solid",
    "value"     => "1",
);
if($real_check['TVCable']){
    $tvcable['checked'] = 'checked';
}
$citywater = array(
    "name"      => "citywater",
    "class"     => "checkbox border-1 border-color-ccc border-style-solid",
    "value"     => "1",
);
if($real_check['CityWater']){
    $citywater['checked'] = 'checked';
}
$internet = array(
    "name"      => "internet",
    "class"     => "checkbox border-1 border-color-ccc border-style-solid",
    "value"     => "1",
);
if($real_check['Internet']){
    $internet['checked'] = 'checked';
}
$nearcenter = array(
    "name"      => "nearcenter",
    "class"     => "checkbox border-1 border-color-ccc border-style-solid",
    "value"     => "1",
);
if($real_check['NearCenter']){
    $nearcenter['checked'] = 'checked';
}
$address = array(
    "name"      => "address",
    "value"     => $real_check['Address'],
    "class"     => "text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$street = array(
    "name"      => "street",
    "value"     => $real_check['Street'],
    "class"     => "text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$ward_attr = 'id="ward_list"';
$district_attr = 'id="district_list"';
$province_attr = 'id="province_list"';
$direction_list = array("lang('backend.all')"=>lang('backend.all'),"Đông"=>"Đông","Tây"=>"Tây","Nam"=>"Nam","Bắc"=>"Bắc","Đông Bắc"=>"Đông Bắc","Đông Nam"=>"Đông Nam","Tây Bắc"=>"Tây Bắc","Tây Nam"=>"Tây Nam");

$lat = array(
    "name"      => "lat",
    "value"     => set_value("lat"),
    "class"     => "text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
    "id"        => 'lat'
);
$lng = array(
    "name"      => "lng",
    "value"     => set_value("lng"),
    "class"     => "text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
    "id"        => 'lng'
);
$cost = array(
    "name"      => "cost",
    "value"     => $real_check['Cost'],
    "class"     => "text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$unit_list = array("Tổng tiện tích"=>"Tổng diện tích","m2"=>"m2","nền"=>"nền");
$contactname = array(
    "name"      => "contactname",
    "value"     => $real_check['ContactName'],
    "class"     => "text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$contactyahoo = array(
    "name"      => "contactyahoo",
    "value"     => $real_check['ContactYahoo'],
    "class"     => "text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$contactphone = array(
    "name"      => "contactphone",
    "value"     => $real_check['ContactPhone'],
    "class"     => "text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$contactemail = array(
    "name"      => "contactemail",
    "value"     => $real_check['ContactEmail'],
    "class"     => "text width-400 margin-0 padding-2 border-1 border-color-ccc border-style-solid",
);
$submit = array(
    'name'      => 'bntOk',
    'value'     => lang('backend.save'),
    'class'     => 'bnt bntSave padding-0 margin-0 text-align-left font-weight-bold border-0 cursor-pointer hover-blue border-radius-5 hover-border-shadow',
);
$reset = array(
    'name'      => 'bntReset',
    'value'     => lang('backend.reset'),
    'class'     => 'bnt bntReset padding-0 margin-0 text-align-left font-weight-bold border-0 cursor-pointer hover-blue border-radius-5 hover-border-shadow',
);
?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#province_list").change(function (){
            var str = "";
            $(this).find("option:selected").each(function () {
                str += $(this).attr("value");
            });
            var cct = $("input[name=csrf_token_name]").val();
            //var cct = $.cookie("csrf_cookie_name");
            $.post("<?php echo base_url();?>/ajax/getOptionDistrict/"+str, {
                    'id' : str,
                    'csrf_token_name': cct
                },function(data){
                    $("#district_list").html(data);
                }); 
            return false;
        });
        $("#district_list").change(function (){
            var str = "";
            $(this).find("option:selected").each(function () {
                str += $(this).attr("value");
            });
            var cct = $("input[name=csrf_token_name]").val();
            //var cct = $.cookie("csrf_cookie_name");
            $.post("<?php echo base_url();?>/ajax/getOptionWard/"+str, {
                    'id' : str,
                    'csrf_token_name': cct
                },function(data){
                    $("#ward_list").html(data);
                }); 
            return false;
        });
    });
</script>
<script src="<?php echo base_url();?>public/js/Editor/imgmanager/js/mcimagemanager.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>public/js/Editor/scripts/innovaeditor.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>public/js/editor.js" type="text/javascript"></script>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=AIzaSyAhdUArEcXDm-O8cc_4l6nulWOLX4vcNEw"></script>
<div class="content content-real padding-10 margin-10 background-color-f4f4f4 border-1 border-radius-8 border-color-ccc border-style-solid">
    <?php echo form_open_multipart("",$form);?>
    <div class="section-left float-left">
        <?php echo _breadcrumbs($breadcrumbs);?>
        <div class="clear-both"></div>
        <?php 
            echo "<div class=\"error red text-align-left\">";
                echo validation_errors();
                if($error !="" )
                    echo "<p>$error</p>";
            echo "</div>";
            
            echo "<div class=\"item item-text\">".form_label(lang('backend.type')).form_dropdown('type', $arrType, $real_check['Type'])."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label(lang('backend.menu')." <span class=\"color-red\">*</span>")."<select name = 'menu'>".$real_menu."</select>"."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label(lang('backend.name')." <span class=\"color-red\">*</span>").form_input($name)."<div class=\"clear-both\"></div></div>";
            //echo "<div class=\"item item-text\">".form_label("Ảnh đại diện (160x120)<span class=\"color-red\">*</span>").form_input($img)."<input type=\"button\" value=\"\" onclick=\"mcImageManager.open('fadmin','IMAGES');\" id=\"bntImg\" name=\"bntImg\" class=\"iconImg\" /><div class=\"clear-both\"></div></div>";
            //echo "<div class=\"item item-text\">".form_label(lang('backend.content')." <span class=\"color-red\">*</span>")."<div class=\"clear-both\"></div>".form_textarea($content)."<script type=\"text/javascript\">var fullVi = new InnovaEditor(\"fullVi\");FullEditor(fullVi, \"CONTENT\", 400);</script><div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label("Ảnh đại diện (160x120)<span class=\"color-red\">*</span>").form_input($img1)."<div class=\"clear-both\"></div></div>";
            if($real_check['Img']) {echo "<div class=\"item item-text\">".form_label("&nbsp;")."<img id=\"IMAGES_VALUE\" src=\"{$real_check['Img']}\" height=\"90\"/><div class=\"clear-both\"></div></div>";}
            echo "<div class=\"item item-text\">".form_label("Hình ảnh khác <span class=\"color-red\">*</span>").form_input($img2)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text hidden\">".form_label(lang('backend.maincontent')." <span class=\"color-red\">*</span>").form_textarea($maincontent)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label('Giấy tờ pháp lý').form_input($legal)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text hidden\">".form_label(lang('backend.editor')).form_input($editor)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text hidden\">".form_label(lang('backend.source')).form_input($source)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label(lang('backend.area')).form_input($landarea)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text hidden\">".form_label(lang('backend.usable_area')).form_input($usablearea)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label(lang('backend.sitting_room')).form_input($sittingroom)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label(lang('backend.bed_room')).form_input($bedroom)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text hidden\">".form_label(lang('backend.toilet')).form_input($toilet)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label(lang('backend.province')).form_dropdown("province",array('8'=>'Bình Dương'),$real_check['Province'],$province_attr)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label(lang('backend.district')).form_dropdown("district",$district_list,$real_check['District'],$district_attr)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label(lang('backend.ward')).form_dropdown("ward",$ward_list,set_value("ward"),$ward_attr)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text hidden\">".form_label(lang('backend.street')).form_input($street)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label(lang('backend.address')).form_input($address)."<input type=\"button\" value=\"\" onclick=\"showMap();\" id=\"bntPoint\" name=\"bntPoint\" class=\"iconPoint\" /><div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text hidden\">".form_label('Lat').form_input($lat)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text hidden\">".form_label('Lng').form_input($lng)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label(lang('backend.direction')).form_dropdown("direction",$direction_list,$real_check['Direction'])."<div class=\"clear-both\"></div></div>";//.form_input($direction)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label(lang('backend.cost')).form_input($cost)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label(lang('backend.unit')).form_dropdown("unit",$unit_list,$real_check['Unit'])."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label(lang('backend.hot')).form_checkbox($hot)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text hidden\">".form_label(lang('backend.new')).form_checkbox($new)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label("Tình trạng").form_dropdown("state",$state_list,$real_check['State'])."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label(lang('backend.status')).form_dropdown('status',$arrStatus, $real_check['Status'])."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text hidden\">".form_label(lang('backend.contact_name')).form_input($contactname)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text hidden\">".form_label(lang('backend.yahoo')).form_input($contactyahoo)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text hidden\">".form_label(lang('backend.phone')).form_input($contactphone)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text hidden\">".form_label(lang('backend.email')).form_input($contactemail)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label(lang('backend.tags')).form_textarea($tags)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label(lang('backend.metatit')).form_textarea($mtit)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label(lang('backend.metakey')).form_textarea($mkey)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-text\">".form_label(lang('backend.metades')).form_textarea($mdes)."<div class=\"clear-both\"></div></div>";
            echo "<div class=\"item item-submit\">".form_submit($submit).form_reset($reset)."<div class=\"clear-both\"></div></div>";
            
        ?>
        <div class="clear-both"></div>
    </div>
    <div class="section-right float-right">
        <?php echo "<div class=\"item item-text\">".form_label(lang('backend.content')." <span class=\"color-red\">*</span>")."<div class=\"clear-both\"></div>".form_textarea($content)."<script type=\"text/javascript\">var fullVi = new InnovaEditor(\"fullVi\");FullEditor(fullVi, \"CONTENT\", 400);</script><div class=\"clear-both\"></div></div>";?>
        
        <div align="center" id="map" style="margin-top: 20px; min-width:300px; min-height:400px;max-width:600px;max-height:600px; width:100%;margin-top:30px;"></div>
        <script>
            function loadMap() {
            	if (GBrowserIsCompatible()) {
            		var map = new GMap2(document.getElementById("map"));
            		map.addControl(new GSmallMapControl());
            		map.addControl(new GMapTypeControl());
            		var center = new GLatLng(<?php echo ($real_check['Lat']) ? $real_check['Lat'] : '10.91560';?>, <?php echo ($real_check['Lng']) ? $real_check['Lng'] : '106.76920';?>);
            		map.setCenter(center, 15);
                    map.zoomControl(false);
            		geocoder = new GClientGeocoder();
            		var marker = new GMarker(center, {
            			draggable: true
            		});
            		map.addOverlay(marker);
            		document.getElementById("lat").value = center.lat().toFixed(5);
            		document.getElementById("lng").value = center.lng().toFixed(5);
            		GEvent.addListener(map, "dragstart", function() {
            			document.getElementById("weather").innerHTML = "";
            			document.getElementById("weatherbutton").innerHTML = "Show weather";
            		});
            		GEvent.addListener(marker, "dragend", function() {
            			//ga('send', 'event', 'map', 'drag/move', 'map');
            			var point = marker.getPoint();
            			map.panTo(point);
            			document.getElementById("lat").value = point.lat().toFixed(5);
            			document.getElementById("lng").value = point.lng().toFixed(5);
            		});
            		GEvent.addListener(marker, "dragstart", function() {
            			document.getElementById("weather").innerHTML = "";
            			document.getElementById("weatherbutton").innerHTML = "Show weather";
            		});
            		GEvent.addListener(map, "moveend", function() {
            			//ga('send', 'event', 'map', 'drag/move', 'map');
            			map.clearOverlays();
            			var center = map.getCenter();
            			var marker = new GMarker(center, {
            				draggable: true
            			});
            			map.addOverlay(marker);
            			document.getElementById("lat").value = center.lat().toFixed(5);
            			document.getElementById("lng").value = center.lng().toFixed(5);
            			GEvent.addListener(marker, "dragend", function() {
            				//ga('send', 'event', 'map', 'drag/move', 'map');
            				var point = marker.getPoint();
            				map.panTo(point);
            				document.getElementById("lat").value = point.lat().toFixed(5);
            				document.getElementById("lng").value = point.lng().toFixed(5);
            			});
            		});
            	}
            }
            
            function showMap(){
                var province = $('select[name="province"] option:selected').text();
                var district = $('select[name="district"] option:selected').text();
                var ward = $('select[name="ward"] option:selected').text();
                var address = $('input[name="address"]').val();
                
                var location = address+', '+ward+', '+district+', '+province;
                console.log(location);
                showAddress(location);
            }
            
            function showAddress(address) {
            	var map = new GMap2(document.getElementById("map"));
            	map.addControl(new GSmallMapControl());
            	map.addControl(new GMapTypeControl());
            	if (geocoder) {
            		geocoder.getLatLng(
            		address, function(point) {
            			if (!point) {
            				alert(address + " not found");
            			} else {
            				document.getElementById("lat").value = point.lat().toFixed(5);
            				document.getElementById("lng").value = point.lng().toFixed(5);
            				map.clearOverlays()
            				map.setCenter(point, 14);
            				var marker = new GMarker(point, {
            					draggable: true
            				});
            				map.addOverlay(marker);
            				GEvent.addListener(marker, "dragend", function() {
            					var pt = marker.getPoint();
            					map.panTo(pt);
            					document.getElementById("lat").value = pt.lat().toFixed(5);
            					document.getElementById("lng").value = pt.lng().toFixed(5);
            				});
            				GEvent.addListener(map, "moveend", function() {
            					map.clearOverlays();
            					var center = map.getCenter();
            					var marker = new GMarker(center, {
            						draggable: true
            					});
            					map.addOverlay(marker);
            					document.getElementById("lat").value = center.lat().toFixed(5);
            					document.getElementById("lng").value = center.lng().toFixed(5);
            					GEvent.addListener(marker, "dragend", function() {
            						var pt = marker.getPoint();
            						map.panTo(pt);
            						document.getElementById("lat").value = pt.lat().toFixed(5);
            						document.getElementById("lng").value = pt.lng().toFixed(5);
            					});
            					GEvent.addListener(marker, "dragstart", function() {
            						console.log('dragstart');
            						document.getElementById("weather").innerHTML = "";
            						document.getElementById("weatherbutton").innerHTML = "Show weather";
            					});
            				});
            			}
            		});
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
        <div class="clear-both"></div>
    </div>
    
    <div class="clear-both"></div>
    <?php echo form_close();?>
</div>