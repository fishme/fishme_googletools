if (typeof jQuery == 'undefined') {
    // jQuery is loaded => print the version
    alert('Please activate jQuery in your design.ini!');
} else {
    function initialize() {
        var address = $('#fs_map_canvas').attr('data-address');
        
        geocoder = new google.maps.Geocoder();
        geocoder.geocode( {'address': address}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                local_cords = results[0].geometry.location;
                var zoomlvl = 11;
                if($('#fs_map_canvas').attr('data-zoom')) {
                    zoomlvl = parseInt($('#fs_map_canvas').attr('data-zoom'));
                }

                // set map options
                var mapOptions = {
                  zoom: zoomlvl,
                  center: new google.maps.LatLng(local_cords.lat(), local_cords.lng()),
                  mapTypeId: google.maps.MapTypeId.ROADMAP
                }
                var map = new google.maps.Map(document.getElementById('fs_map_canvas'),
                                              mapOptions);

                //var image = 'images/beachflag.png';
                var myLatLng = new google.maps.LatLng(local_cords.lat(), local_cords.lng());
                var beachMarker = new google.maps.Marker({
                    position: myLatLng,
                    map: map,
                    icon: $('#fs_map_canvas').attr('data-pin')
                });
           } else {
                alert('Invalid address: ' + address);
           }
        });
    }
    function loadScript() {
        // load googlemaps V3 script into the html
        var script = document.createElement("script");
        script.type = "text/javascript";
        script.src = $('#fs_map_canvas').attr('data-api-url') + "&callback=initialize";
        document.body.appendChild(script);
    }
    window.onload = loadScript;
}
