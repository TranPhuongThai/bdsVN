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
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js"></script>
</head>

<body role="document">

    <!-- Fixed navbar -->
    <?php echo $zone->top();?>
    <div class="wrapper">
        <div class="container main-page">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Trang chủ</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tìm kiếm bằng bản đồ</li>
                </ol>
            </nav>
            <p>Tính năng tìm kiếm tin đăng bất động sản trên bản đồ giúp bạn biết được vị trí BDS mà bạn đang muốn mua, các tiện ích xung quanh, đem lại nhiều cái nhìn tổng quan hơn về khu vực, giúp bạn ra quyết định chính xác hơn.</p>
            <p>Tính năng tìm kiếm tin đăng bất động sản trên bản đồ giúp bạn biết được vị trí BDS mà bạn đang muốn mua, các tiện ích xung quanh, đem lại nhiều cái nhìn tổng quan hơn về khu vực, giúp bạn ra quyết định chính xác hơn.</p>
            <?php echo $modreal->searchMap($provinceSelect, $menuSelect, $costSelect);?>
            <div class="row">
                <div align="center" id="map" style="min-height:882px;width: 100%"></div>
            </div>
        </div>
        
    </div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAhdUArEcXDm-O8cc_4l6nulWOLX4vcNEw&callback=initMap&libraries=&v=weekly" async></script>
    <script>
    function initMap() {
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 5,
            center: { lat: 10.762622, lng: 106.660172 },
        });
        // Create an array of alphabetical characters used to label the markers.
        const labels = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        // Add some markers to the map.
        // Note: The code uses the JavaScript Array.prototype.map() method to
        // create an array of markers based on a given "locations" array.
        // The map() method here has nothing to do with the Google Maps API.
        console.log(locations);
        const markers = locations.map((location, i) => {
            return new google.maps.Marker({
            position: location,
            label: labels[i % labels.length],
            });
        });
        // Add a marker clusterer to manage the markers.
        new MarkerClusterer(map, markers, {
            imagePath:
            "https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m",
        });
        }
        // var locations = [
        // { lat: -31.56391, lng: 147.154312 },
        // { lat: -33.718234, lng: 150.363181 },
        // { lat: -33.727111, lng: 150.371124 },
        // { lat: -33.848588, lng: 151.209834 },
        // { lat: -33.851702, lng: 151.216968 },
        // { lat: -34.671264, lng: 150.863657 },
        // { lat: -35.304724, lng: 148.662905 },
        // { lat: -36.817685, lng: 175.699196 },
        // { lat: -36.828611, lng: 175.790222 },
        // { lat: -37.75, lng: 145.116667 },
        // { lat: -37.759859, lng: 145.128708 },
        // { lat: -37.765015, lng: 145.133858 },
        // { lat: -37.770104, lng: 145.143299 },
        // { lat: -37.7737, lng: 145.145187 },
        // { lat: -37.774785, lng: 145.137978 },
        // { lat: -37.819616, lng: 144.968119 },
        // { lat: -38.330766, lng: 144.695692 },
        // { lat: -39.927193, lng: 175.053218 },
        // { lat: -41.330162, lng: 174.865694 },
        // { lat: -42.734358, lng: 147.439506 },
        // { lat: -42.734358, lng: 147.501315 },
        // { lat: -42.735258, lng: 147.438 },
        // { lat: -43.999792, lng: 170.463352 },
        // ];
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
    		// document.getElementById("lat").value = center.lat().toFixed(5);
    		// document.getElementById("lng").value = center.lng().toFixed(5);
    		GEvent.addListener(map, "dragstart", function() {
    			document.getElementById("weather").innerHTML = "";
    			document.getElementById("weatherbutton").innerHTML = "Show weather";
    		});
    		GEvent.addListener(marker, "dragend", function() {
    			//ga('send', 'event', 'map', 'drag/move', 'map');
    			var point = marker.getPoint();
    			map.panTo(point);
    			// document.getElementById("lat").value = point.lat().toFixed(5);
    			// document.getElementById("lng").value = point.lng().toFixed(5);
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
    			// document.getElementById("lat").value = center.lat().toFixed(5);
    			// document.getElementById("lng").value = center.lng().toFixed(5);
    			GEvent.addListener(marker, "dragend", function() {
    				//ga('send', 'event', 'map', 'drag/move', 'map');
    				var point = marker.getPoint();
    				map.panTo(point);
    				// document.getElementById("lat").value = point.lat().toFixed(5);
    				// document.getElementById("lng").value = point.lng().toFixed(5);
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
        window.attachEvent('onload', onload);
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
    <?php echo $zone->bot();?>

</body>
</html>
