var map;

function initialize() {

    var mapProp = {
        center: new google.maps.LatLng(-8.1129811, -34.9198789),
        zoom: 14,
        scrollwheel: false,
        styles: [{
            stylers: [{
                saturation: -100
            }]
        }],
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    map = new google.maps.Map(document.getElementById("map"), mapProp);
}

function addMarker(lat, long, icon, content, showInfoWindow, openInfoWindow) {
    var myLatLng = { lat: lat, lng: long };

    if (icon === '') {
        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            icon: icon
        });
    } else {
        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            icon: icon
        });
    }

    var infoWindow = new google.maps.InfoWindow({
        content: content,
        maxWidth: 200
    });
}
$(function() {



    initialize();
})