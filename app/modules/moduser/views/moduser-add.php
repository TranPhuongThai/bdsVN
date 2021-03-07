<?php
$form = array(
    "name"      => "fUser",
    "method"    => "POST",
    "class"     => "marign-top validate"
);
?>
<div class="header-title title-support"><?php echo (isset($real_check)) ? 'Sửa tin rao' : 'Đăng tin nhà đất';?></div>
<div class="content-static">
    <?php echo form_open_multipart("",$form);?>
    <?php
        if($successfully == ""){
            echo '<div class="bg-danger">'.validation_errors().'<div class="clearfix"></div></div>';
            echo '<div class="bg-danger">'.(($error) ? $error : '').'<div class="clearfix"></div></div>';
        }else{
            echo '<div class="bg-success">'.$successfully.'</div>';
        }
    ?>  <div class="clearfix"></div>
    	<div class="form-group">
    		<label class="col-sm-2 control-label">
    			Loại <span class="color-red">*</span>
    		</label>
            <div class="col-sm-4">
                <select name="typeR" class="form-control required">
                    <option value="1">Nhà bán</option>
                    <option value="2" <?php echo ((isset($real_check) && $real_check['Type'] == '2') || set_value('typeR') == 2) ? 'selected="selected"' : '';?>>Đất bán</option>
                </select>
            </div>
    		<label class="col-sm-2 control-label">
    			Danh mục <span class="color-red">*</span>
    		</label>
            <div class="col-sm-4">
                <select name="menuR" class="form-control required">
                    <?php echo $menu_list;?>
                </select>
            </div>
            <div class="clearfix"></div>
    	</div>
    	<div class="form-group">
    		<label class="col-sm-2 control-label">
    			Tiêu đề <span class="color-red">*</span>
    		</label>
            <div class="col-sm-10">
                <input type="name" name="nameR" class="form-control required" placeholder="Tiêu đề tin giao" value="<?php echo (isset($real_check['Name'])) ? $real_check['Name'] : set_value('nameR');?>">
            </div>
            <div class="clearfix"></div>
    	</div>
    	<div class="form-group">
    		<label for="inputPhone" class="col-sm-2 control-label">
    			Hình ảnh
    		</label>
            <div class="col-sm-10">
                <input type="file" name="img1" value="">
                <?php echo (isset($real_check['Thumb1'])) ? '<img class="img-thumbnail margin-top" src="'.$real_check['Thumb1'].'" title="'.$real_check['Name'].'" alt="'.$real_check['Name'].'"/>' : '';?>
            </div>
            <div class="clearfix"></div>
    	</div>
        <hr />
    	<div class="form-group">
    		<label class="col-sm-2 control-label">
    			Diện tích <span class="color-red">*</span>
    		</label>
            <div class="col-sm-4">
                <input type="number" name="landareaR" class="form-control required" placeholder="Tiêu đề tin giao" value="<?php echo (isset($real_check['LandArea'])) ? $real_check['LandArea'] : set_value('landareaR');?>" min="0" step="1">
            </div>
    		<label class="col-sm-2 control-label">
    			Hướng nhà
    		</label>
            <div class="col-sm-4">
                <?php
                    $arr = array(
                        'Đông' => 'Đông',
                        'Tây' => 'Tây',
                        'Nam' => 'Nam',
                        'Bắc' => 'Bắc',
                        'Đông Bắc' => 'Đông Bắc',
                        'Đông Nam' => 'Đông Nam',
                        'Tây Bắc' => 'Tây Bắc',
                        'Tây Nam' => 'Tây Nam',
                    );
                    $select = isset($real_check['Direction']) ? $real_check['Direction'] : set_value('directionR');
                    echo form_dropdown('directionR', $arr, $select, 'class="form-control"');
                ?>
            </div>
            <div class="clearfix"></div>
    	</div>
    	<div class="form-group">
    		<label class="col-sm-2 control-label">
    			Giá tiền <span class="color-red">*</span>
    		</label>
            <div class="col-sm-4">
                <input type="number" name="costR" class="form-control required" placeholder="Giá tiền" value="<?php echo (isset($real_check['Cost'])) ? $real_check['Cost'] : set_value('costR');?>" min="0" step="1">
            </div>
    		<label class="col-sm-2 control-label">
    			Đơn vị <span class="color-red">*</span>
    		</label>
            <div class="col-sm-4">
                <?php
                    $arr = array(
                        'Tổng tiện tích' => 'Tổng tiện tích',
                        'm2' => 'm2',
                        'nền' => 'nền',
                    );
                    $select = isset($real_check['Unit']) ? $real_check['Unit'] : set_value('unitR');
                    echo form_dropdown('unitR', $arr, $select, 'class="form-control required"');
                ?>
            </div>
            <div class="clearfix"></div>
    	</div>
    	<div class="form-group">
    		<label class="col-sm-2 control-label">
    			Phòng khách
    		</label>
            <div class="col-sm-4">
                <?php
                    $arr = array(
                        '0' => '0',
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                        '5' => '5',
                        '6' => '6+',
                    );
                    $select = isset($real_check['SittingRoom']) ? $real_check['SittingRoom'] : set_value('sittingroomR');
                    echo form_dropdown('sittingroomR', $arr, $select, 'class="form-control"');
                ?>
            </div>
    		<label for="inputPhone" class="col-sm-2 control-label">
    			Phòng ngủ
    		</label>
            <div class="col-sm-4">
                <?php
                    $arr = array(
                        '0' => '0',
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                        '5' => '5',
                        '6' => '6+',
                    );
                    $select = isset($real_check['BedRoom']) ? $real_check['BedRoom'] : set_value('bedroomR');
                    echo form_dropdown('bedroomR', $arr, $select, 'class="form-control"');
                ?>
            </div>
            <div class="clearfix"></div>
    	</div>
    	<div class="form-group">
    		<label class="col-sm-2 control-label">
    			Giấy tờ
    		</label>
            <div class="col-sm-4">
                <?php
                    $arr = array(
                        'Sổ đỏ' => 'Sổ đỏ',
                        'Sổ chung' => 'Sổ chung',
                        'Sổ hồng' => 'Sổ hồng',
                        'Hợp đồng' => 'Hợp đồng',
                    );
                    $select = isset($real_check['Legal']) ? $real_check['Legal'] : set_value('legalR');
                    echo form_dropdown('legalR', $arr, $select, 'class="form-control"');
                ?>
            </div>
    		<label class="col-sm-2 control-label">
    			Trạng thái
    		</label>
            <div class="col-sm-4">
                <?php
                    $arr = array(
                        '0' => 'Chưa bán',
                        '1' => 'Đã bán',
                    );
                    $select = isset($real_check['State']) ? $real_check['State'] : set_value('stateR');
                    echo form_dropdown('stateR', $arr, $select, 'class="form-control"');
                ?>
            </div>
            <div class="clearfix"></div>
    	</div>
        <hr />
    	<div class="form-group">
            <div class="col-sm-6">
                <div class="row">
                    <!--
                    <div class="form-group">
                		<label class="col-sm-4 control-label">
                			Tỉnh thành
                		</label>
                        <div class="col-sm-8">
                            <?php
                                /*
                                //select province
                                $temp = array();
                                foreach($province_list as $row){
                                    $temp[$row['ID']] = $row['Name'];
                                }
                                $province_list = $temp;
                                */
                            ?>
                            <?php //echo form_dropdown('province', $province_list, '', 'id="province_list" class="form-control"');?>
                        </div>
                    </div>
                    -->
                    <div class="form-group">
                		<label class="col-sm-4 control-label">
                			Quận/Huyện
                		</label>
                        <div class="col-sm-8">
                            <?php
                                //select province id = 31
                                $temp = array();
                                foreach($district_list as $row){
                                    $temp[$row['ID']] = $row['Name'];
                                }
                                $district_list = $temp;
                                $select = isset($real_check['District']) ? $real_check['District'] : set_value('districtR');
                                echo form_dropdown('districtR', $district_list, $select, 'id="district_list" class="form-control"');
                            ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                		<label class="col-sm-4 control-label">
                			Phường/Xã
                		</label>
                        <div class="col-sm-8">
                            <?php                                
                                //select district id = 8
                                $temp = array();
                                foreach($ward_list as $row){
                                    $temp[$row['ID']] = $row['Name'];
                                }
                                $ward_list = $temp;
                                $select = isset($real_check['Ward']) ? $real_check['Ward'] : set_value('wardR');
                                echo form_dropdown('wardR', $ward_list, $select, 'id="ward_list" class="form-control"');
                            ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                		<label class="col-sm-12 control-label">
                			Số nhà, tên đường
                		</label>
                        <div class="col-sm-12">
                            <input type="text" name="addressR" class="form-control" placeholder="Số nhà, tên đường" value="<?php echo (isset($real_check['Address'])) ? $real_check['Address'] : set_value('addressR');?>">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 control-label">
                			<span class="text-normal"><strong>Mẹo: </strong>Có thể di chuyển tọa độ bản đồ tới vị trí chính xác bằng cách kéo điểm đánh dấu tới vị trí đó</span>
                		</label>
                        <div class="col-sm-12">
                            <input type="hidden" id="lat" name="latR" value="<?php echo (isset($real_check['Lat'])) ? $real_check['Lat'] : set_value('latR');?>"/>
                            <input type="hidden" id="lng" name="lngR" value="<?php echo (isset($real_check['Lng'])) ? $real_check['Lng'] : set_value('lngR');?>"/>
                            <a onclick="showMap();" name="bntPoint" class="btn btn-default" style="width: 100%;"><span class="glyphicon glyphicon-map-marker"></span> Tìm tọa độ bản đồ</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="col-sm-12">
                    <div class="row">
                        <div align="center" id="map" style="min-height:255px;width: 100%"></div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
    	</div>
        <hr />
    	<div class="form-group">
            <label class="col-sm-12 control-label">
    			Nội dung tin rao <span class="color-red">*</span>
    		</label>
            <div class="col-sm-12">
                <textarea name="contentR" class="form-control required" rows="5"><?php echo (isset($real_check['Content'])) ? str_replace("<br/>","\r\n", $real_check['Content']) : set_value('contentR');?></textarea>
            </div>
            <div class="clearfix"></div>
    	</div>
    	<div class="form-group">
    		<label class="col-sm-2 control-label">
    			Mã bảo vệ <span class="color-red">*</span>
    		</label>
            <div class="col-sm-4">
                <input type="name" name="captchaR" class="form-control required" placeholder="mã bảo vệ" value="">
            </div>
            <div class="col-sm-6">
                <?php echo $captcha['image'];?>
            </div>
            <div class="clearfix"></div>
    	</div>
    	<div class="form-group">
    		<div class="col-sm-10">
                <input type="submit" name="submit" class="btn btn-primary" value="Đăng tin"/>
                <input type="reset" name="reset" class="btn btn-default" value="Làm lại"/>
            </div>
            <div class="clearfix"></div>
    	</div>
    <?php echo form_close();?>
</div>

<script src="<?php base_url();?>public/template-tiendv/js/jquery.validate.js"></script>

<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=AIzaSyAhdUArEcXDm-O8cc_4l6nulWOLX4vcNEw"></script>

<script>
    $(document).ready(function() {
	   $(".validate").validate();
    });
    function loadMap() {
    	if (GBrowserIsCompatible()) {
    		var map = new GMap2(document.getElementById("map"));
    		map.addControl(new GSmallMapControl());
    		map.addControl(new GMapTypeControl());
    		var center = new GLatLng(<?php echo (isset($real_check['Lat'])) ? $real_check['Lat'] : '10.91560';?>, <?php echo (isset($real_check['Lng'])) ? $real_check['Lng'] : '106.76920';?>);
    		map.setCenter(center, 15);
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
        var province = $('select[name="provinceR"] option:selected').text();
        var district = $('select[name="districtR"] option:selected').text();
        var ward = $('select[name="wardR"] option:selected').text();
        var address = $('input[name="addressR"]').val();
        
        var location = address+', '+ward+', '+district+', '+province;
        console.log(location);
        showAddress(location);
        return false;
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
