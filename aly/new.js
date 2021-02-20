// $(document).ready(function() {});

var map;

function initialize() {
$("#map-canvas").show();
    console.log("Type Of Google: " + typeof google);
    var geocodeString = $("#map-canvas").data("geocode");
    var geocode = geocodeString.split(',');
    var myLatlng = new google.maps.LatLng(parseFloat(geocode[0]), parseFloat(geocode[1]));

     var myOptions = {
        zoom: 18,
        center: myLatlng,
        mapTypeControl: true,
        mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
        navigationControl: true,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
    }

    var map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);
  
  var marker = new google.maps.Marker({position: myLatlng,map: map,title:"aly momdouh aly "});
  marker.setMap(map);
  
}

google.maps.event.addDomListener(window, 'load', initialize);