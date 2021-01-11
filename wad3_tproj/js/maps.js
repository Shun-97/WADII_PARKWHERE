document.addEventListener("DOMContentLoaded", function () {
    var show_within = 2500; // show me pin results within 2.5km
    if (location.search.substring(1).split("=")[0]){ //query string is defined
        var param1 = location.search.substring(1).split("=")[1].split("&")[0]; //lat if by autocomplete
        var param2 = location.search.substring(1).split("=")[2]; //lng if by autocomplete
        if(isNaN(param1) || isNaN(param2)){ //user did not use autocomplete  on prev page to ccome here
            var area_array = onemap_search(param1);
            var search_coord = { lat: Number(area_array[0].results[0].LATITUDE), lng: Number(area_array[0].results[0].LONGITUDE)};
            initMap(search_coord,show_within,pin_desc="Pin was dropped here");
        } else if (param1 && param2){ //user used autocomplete on prev page to ccome here
            // var area_array = onemap_search(search_location);
            var search_coord = { lat: Number(param1), lng: Number(param2)};
            initMap(search_coord, show_within, pin_desc="Pin was dropped here");
        }
    } else { //user came from View Nearby carpark, proceed to retrieve his current location
        getmyLocation(show_within);
        displayinfopopup();
    }

});


function getmyLocation(show_within) { // retrieve user current loc
    if ('geolocation' in navigator) {
        navigator.geolocation.getCurrentPosition((position) => {
            var current_pos = { lat: position.coords.latitude, lng: position.coords.longitude };
            current_pos ? initMap(current_pos, show_within, pin_desc="Drag to see carparks around you"):getmyLocation() ;
        });
    } else {
        alert("PLease enable location services.");
        getmyLocation();
    }
}

function initMap(search_coord, show_within, pin_desc) { //initialise map
    if (!search_coord) { //if user doesn't allow for loc
        var focus_pos = { lat: 1.276557, lng: 103.846806 }; // tanjong pagar mrt station, default
    } else {
        var focus_pos = search_coord;
    }
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 14,
        center: focus_pos
    });

    add_focus_marker(focus_pos, show_within, pin_desc, map);
    set_other_carpark_pins(focus_pos, show_within, map);
}

function add_focus_marker(focus_pos, show_within, pin_desc, map) {
    const option = (pin_desc=="Drag to see carparks around you") ? true : false; //if (condition) is true, option=true. else, option=flase.
    var marker = new google.maps.Marker({ //user current loc
        position: focus_pos,
        animation: google.maps.Animation.DROP,
        icon: "http://maps.google.com/mapfiles/kml/pushpin/ylw-pushpin.png",
        title: pin_desc,
        draggable: option
    });
    // To add  marker to the map, call setMap();
    marker.setMap(map);
    marker.addListener('dragend', function (marker) { //drag pin event
        //delete current pins and polylines after drag has stooped
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(null);
        }
        markers = [];
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
        // console.log(new_pos);


        set_other_carpark_pins(new_pos, show_within, map);
    });
}
let line;
let lineArr = [];

function set_other_carpark_pins(user_current_pos, show_within, map) {
    var carparks = getCarparks();
    for (var i = 0; i < carparks.length; i++) {
        let coord= {lat: carparks[i].lat, lng: carparks[i].lng};
        line = new google.maps.Polyline({ // Draw a line showing the straight distance between the markers to calculate the distance
            path: [user_current_pos, coord],
            strokeOpacity: 0 //change to 1 for debugging purposes
        });
        var distanceInMeters = google.maps.geometry.spherical.computeLength(line.getPath());
        if (distanceInMeters <= show_within) { // if this location is within the filter range, add pin to map.
            // console.log(carparks[i].cpname+" is "+distanceInMeters+"m away. Filter dist is "+show_within+"m.");
            line.setMap(map);
            lineArr.push(line);
            if (carparks[i].cpid =="UserInsert"){
                addMarkers(coord, carparks[i], "images/green-dot.png", map);
            } else{
                addMarkers(coord, carparks[i], "images/red-dot.png", map);
            }
            // console.log(carparks[i]);

        }
    } //end for. else, do nothing (outside range)
}

let markers = [];
function addMarkers(position, carpark_info, pin_img, map,) {
    // console.log(carpark_info);
    var wkday_rate = carpark_info.wkdy_rate.substr(0,16) + "...";
    var sat_rate = carpark_info.sat_rate.substr(0,16) + "...";
    var pin = new google.maps.Marker({
        position: position,
        animation: google.maps.Animation.DROP,
        icon : pin_img
    });
    // To add  marker to the map, call setMap();
    pin.setMap(map);
    pin.addListener("click", function (event) {
        var infowindow = new google.maps.InfoWindow({
            content: '<div class="card border-0" style="max-width: 14vw"><h5 class="card-header bg-white p-3">'+carpark_info.cpname+'</h5><div class="card-body p-4"><div class="card-text"><Strong>Weekday Parking Rates:<br/></Strong>'+wkday_rate+'</div><br/><div class="card-text"><Strong>Weekend/PH Parking Rates:<br/></Strong>' + sat_rate + '</div><br/><p class="card-text small">Available Lots: '+carpark_info.availableLots+'</p><a href="Review.php?Carpark='+carpark_info.cpname+'" class="btn btn-primary w-70">View more</a><a href="http://maps.google.com/?q='+ position.lat+","+ position.lng +'" class="ml-3"><i class="fas fa-lg fa-location-arrow"></i></a></div>',
        });
        infowindow.setPosition(event.latLng);
        infowindow.open(map);
    });
    // Push your newly created marker into the array:
    markers.push(pin);
}

function displayinfopopup(){
    
    var popup = '<button type="button" class="btn btn-primary" id="mapspopupbtn" data-toggle="modal" data-target="#infoPopup">How to use?</button><div class="modal fade" id="infoPopup" tabindex="-1" role="dialog" aria-labelledby="infoPopup" aria-hidden="true"><div class="modal-dialog modal-dialog-centered" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="exampleModalLongTitle">Information</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body">When viewing carparks around your area, you may drag and drop the the pin around to view more carparks<br/><br/><span style="color:#FD7567">Red pins </span> are carparks generated from our resources<br/><span style="color:#00E64D">Green Pins </span>are carparks added by other users</div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button></div></div></div></div>';

    document.getElementById("maps").innerHTML += popup;
}
