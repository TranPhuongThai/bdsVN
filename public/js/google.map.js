function loadMap() {
	if (GBrowserIsCompatible()) {
		var map = new GMap2(document.getElementById("map"));
		map.addControl(new GSmallMapControl());
		map.addControl(new GMapTypeControl());
		var center = new GLatLng(10.91560, 106.76920);
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