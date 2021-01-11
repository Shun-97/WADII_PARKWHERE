$(function () {
    initMap_();
    addlistener();

});

function addlistener(){
    document.getElementById("coord").addEventListener("click", function(){
        $('#pinOnMap').modal('show');
    })
}

function initMap_() { //initialise map
    var focus_pos = { lat: 1.276557, lng: 103.846806 }; // tanjong pagar mrt station, default

    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 14,
        center: focus_pos
    });

    add_focus_marker(focus_pos, map);
}
let lineArr = [];
function add_focus_marker(focus_pos, map) {
    var marker = new google.maps.Marker({ //user current loc
        position: focus_pos,
        animation: google.maps.Animation.DROP,
        icon: "http://maps.google.com/mapfiles/kml/pushpin/ylw-pushpin.png",
        title: "Drag me!",
        draggable: true
    });
    var pin_coord= new Array();
    // To add  marker to the map, call setMap();
    marker.setMap(map);
    marker.addListener('dragend', function (marker) { //drag pin event
        // for (var i = 0; i < markers.length; i++) {
        //     markers[i].setMap(null);
        // }
        // markers = [];
        for (var i = 0; i < lineArr.length; i++) {
            lineArr[i].setMap(null);
        }
        lineArr = [];
        //retrieve current location
        var latLng = marker.latLng;
        let new_pos = {
            lat: latLng.lat(),
            lng: latLng.lng()
        };
        pin_coord.push(new_pos);
        console.log(new_pos);

    });

    document.getElementById("submit-pin").addEventListener("click", function(){
        var length = pin_coord.length;
        var user_selected_loc = pin_coord[length-1];
        var str = user_selected_loc.lat.toString() + ", " + user_selected_loc.lng.toString();
        document.getElementById("coord").value= str;
        // set the value of the coord to user_selected_loc
    })
}

