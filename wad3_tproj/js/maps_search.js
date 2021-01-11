// document.addEventListener("DOMContentLoaded", function () {
//    var search_keyword = location.search.split('=')[1] //getting the searchword from header
//    // console.log(search_keyword)
//    var show_within = '1500'; //hardcode a distance for show_within
//    var area_dump = onemap_search(search_keyword) // calling of onemap api to get lat long
//    if (area_dump[0].found == 0) {   // if cannot find the location
//       alert('Area not found! Please try again')
//       window.location = 'search.html'
//    }
//    let lati = Number(area_dump[0].results[0].LATITUDE)
//    let long = Number(area_dump[0].results[0].LONGITUDE)
//    search_location = { lat: lati, lng: long } // making search_location into object similar to user_pos
//    gettheLocation(show_within);
// });
// // @TODO: link carpark rates api, display on info box when user clicks on a pin. currently only has the carpark information.
// // @TODO: some sort of explanation to the user that the pin is draggable or not and what is the distance parameter for a pin to show. (review our designs)
// function gettheLocation(show_within) { // retrieve user current loc
//    if ('geolocation' in navigator) {
//       navigator.geolocation.getCurrentPosition((position) => {
//          initMap(search_location, show_within);  //call using search_location straight
//       });
//    } else {
//       alert("PLease enable location services.");
//       gettheLocation();
//    }
// }
//
// function initMap(detected_loc, show_within) { //initialise map
//    if (!detected_loc) { //if user doesn't allow for loc
//       var user_current_pos = { lat: 1.276557, lng: 103.846806 }; // tanjong pagar mrt station, default
//    } else {
//       var user_current_pos = detected_loc;
//    }
//    const map = new google.maps.Map(document.getElementById("map"), {
//       zoom: 14,
//       center: user_current_pos
//       // center: { lat: 37.77, lng: -122.447 },
//    });
//    add_user_marker(user_current_pos, show_within, map);
//    set_other_carpark_pins(user_current_pos, show_within, map);
// }
//
// function add_user_marker(user_current_pos, show_within, map) {
//    const option = show_within ? true : false; //if show_within is true, option=true. else, option=flase.
//    var marker = new google.maps.Marker({ //user current loc
//       position: user_current_pos,
//       animation: google.maps.Animation.DROP,
//       icon: "images/I-AM-HERE.png",
//       title: "You are here",
//       draggable: option
//    });
//    // To add  marker to the map, call setMap();
//    marker.setMap(map);
//    marker.addListener('dragend', function (marker) { //drag pin event
//       //delete current pins and polylines after drag has stooped
//       for (var i = 0; i < markers.length; i++) {
//          markers[i].setMap(null);
//       }
//       markers = [];
//       for (var i = 0; i < lineArr.length; i++) {
//          lineArr[i].setMap(null);
//       }
//       lineArr = [];
//       //retrieve current location
//       var latLng = marker.latLng;
//       let new_pos = {
//          lat: latLng.lat(),
//          lng: latLng.lng()
//       };
//       // console.log(new_pos);
//       set_other_carpark_pins(new_pos, show_within, map);
//    });
// }
// let line;
// let lineArr = [];
// function set_other_carpark_pins(user_current_pos, show_within, map) {
//    var carparks_sg = get_carpark_Avail();
//    let carpark_info_array = new Array();
//    let count = 0;
//    for (let i = 0; i < carparks_sg.length; i++) { //process data from API
//       if (carparks_sg[i].Location) { //only process data that have loc coordinates
//          var info_obj = {
//             lat: Number(carparks_sg[i].Location.split(" ")[0]),
//             lng: Number(carparks_sg[i].Location.split(" ")[1]),
//             availableLots: Number(carparks_sg[i].AvailableLots),
//             Addr: carparks_sg[i].Development,
//             LotType: carparks_sg[i].LotType
//          };
//          carpark_info_array.push(info_obj); //lat,lng,lots available, address, lot_type
//       } // do nothing for those records that have no loc coordinates.
//    }
//
//    for (var row of carpark_info_array) {
//       count++;
//       let coord = {
//          lat: row.lat,
//          lng: row.lng
//       };
//       let carpark_info = {
//          availableLots: row.availableLots,
//          Addr: row.Addr,
//          LotType: row.LotType
//       };
//       if (!show_within) {// No distance filter set, so show all carpark in SG
//          addMarkers(coord, carpark_info, map);
//       } else { // Distance filter set, e.g. Show within 1000m of where i am at
//          line = new google.maps.Polyline({ // Draw a line showing the straight distance between the markers to calculate the distance
//             path: [user_current_pos, coord],
//             strokeOpacity: 0
//          });
//
//          var lengthInMeters = google.maps.geometry.spherical.computeLength(line.getPath());
//          // console.log(carpark_info.Addr+" is "+lengthInMeters+"m away");
//          if (lengthInMeters <= show_within) { // if this location is within range, add pin to map.
//             line.setMap(map);
//             lineArr.push(line);
//             addMarkers(coord, carpark_info, map);
//          } //else, do not add pin to map. (do nothing)
//       }
//    }
//
// }
// let markers = [];
// function addMarkers(position, carpark_info, map,) {
//    // console.log(carpark_info);
//    var pin = new google.maps.Marker({
//       position: position,
//       animation: google.maps.Animation.DROP,
//    });
//    // To add  marker to the map, call setMap();
//    pin.setMap(map);
//    pin.addListener("click", function (event) {
//       var infowindow = new google.maps.InfoWindow({
//          content: "<div class='font-weight-bold'>" + carpark_info.Addr + "</div><br><div>" + carpark_info.availableLots + " Available Lots Now</div><br><div>Lot Type " + carpark_info.LotType + "</div>"
//       });
//       infowindow.setPosition(event.latLng);
//       infowindow.open(map);
//    });
//    // Push your newly created marker into the array:
//    markers.push(pin);
// }
