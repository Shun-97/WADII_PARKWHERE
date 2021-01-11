document.addEventListener("DOMContentLoaded", function () {
    addEventListeners();
    const input = document.getElementById("search_text");


    autocomplete = new google.maps.places.Autocomplete(input);

    autocomplete.setComponentRestrictions({
        country: ["sg"],
    });

    // autocomplete = new google.maps.places.Autocomplete(input);

});


function addEventListeners() { //redirect to Show on Map when user presses on enter key on keyboard or when he presses the Show on map button
    // document.forms[0].addEventListener('keypress', function (e) { //showonmap
    //     if (e.key === 'Enter') {
    //         e.preventDefault();
    //         var search_loc = document.getElementById("search_text").value;
    //         var place = autocomplete.getPlace();
    //     if(!place){
    //         var search_loc = document.getElementById("search_text").value;
    //         var area_array = onemap_search(search_loc);
    //         getCarparksWithinRange(Number(area_array[0].results[0].LATITUDE),Number(area_array[0].results[0].LONGITUDE)) ? window.location = 'maps.php?location=' + search_loc : false;
    //     } else {
    //         getCarparksWithinRange(place.geometry.location.lat(),place.geometry.location.lng()) ? window.location = 'maps.php?LATITUDE=' + place.geometry.location.lat() + "&LONGITUDE=" + place.geometry.location.lng() : false;
    //     }
    //     }
    // });

    document.getElementById('search_button').addEventListener('click', function (e) { //showonmap
        e.preventDefault();
        var search_loc = document.getElementById("search_text").value;
        var place = autocomplete.getPlace();
        if(!place){
            var search_loc = document.getElementById("search_text").value;
            var area_array = onemap_search(search_loc);
            getCarparksWithinRange(Number(area_array[0].results[0].LATITUDE),Number(area_array[0].results[0].LONGITUDE)) ? window.location = 'maps.php?location=' + search_loc : false;
        } else {
            getCarparksWithinRange(place.geometry.location.lat(),place.geometry.location.lng()) ? window.location = 'maps.php?LATITUDE=' + place.geometry.location.lat() + "&LONGITUDE=" + place.geometry.location.lng() : false;
        }
    });

    document.getElementById('ShowCards').addEventListener('click', function (e) { //showcards
        e.preventDefault();
        
        var place = autocomplete.getPlace();
        if(!place){
            var search_loc = document.getElementById("search_text").value;
            var area_array = onemap_search(search_loc);
            getCarparksWithinRange(Number(area_array[0].results[0].LATITUDE),Number(area_array[0].results[0].LONGITUDE));
            console.log(Number(area_array[0].results[0].LATITUDE));
        } else {
            getCarparksWithinRange(place.geometry.location.lat(),place.geometry.location.lng());
        }
    });


}

function getCarparksWithinRange(lat,lng) {
    var carpark_info_array = getCarparks();
    var show_within = 2500; //show results within 1km of user input location
    console.log(lat);
    var search_loc = document.getElementById("search_text").value;

    if (!lat && !lng) { // nothing found from Google Coordinates => invalid location entered
        display_sorry_zero_matches_returned();
    } else {
        let display_array = new Array();
        for (var row of carpark_info_array) {
            var distanceInMeters = getDistanceFromLatLonInKm(row.lat, row.lng, lat, lng) * 1000;
            if (distanceInMeters <= show_within) { // if this location is within the filter range, add entry to array.
                let carpark_info = {
                    availableLots: row.availableLots,
                    cpname: row.cpname,
                    sat_rate: row.sat_rate,
                    wkday_rate: row.wkdy_rate
                };
                display_array.push(carpark_info);
            }
        }

        if (display_array.length == 0) {
            display_sorry_zero_matches_returned();
            return false;
        } else {
            display_cp_info(display_array, search_loc);
            return true;
        }
    }
}

function display_cp_info(carpark_info, search_loc) {
    clear_error_msg();
    clear_existing_cards();
    display_search_number(carpark_info.length, search_loc);

    for (var i = 0; i < carpark_info.length; i++) {
        document.getElementById('card_output').innerHTML += '<div class="card" style="margin-bottom:4%"><img class="card-img-top" src="images/car1.jpg" alt="Card image cap"><div class="card-body"><p class="card-title">' + carpark_info[i].cpname + '</p><small class="text-muted mb-3">Available Lots now: ' + carpark_info[i].availableLots + '</small><p class="card-text"><Strong>Weekday Parking Rates:<br/></Strong>' + carpark_info[i].wkday_rate + '</p><p class="card-text"><Strong>Weekend/PH Parking Rates:<br/></Strong>' + carpark_info[i].sat_rate + '</p><a href="Review.php?Carpark=' + carpark_info[i].cpname + '" class="btn btn-primary">View more</a></div></div>';
    }
    // document.getElementById('card_output').innerHTML = output;
    $('html, body').animate({
        scrollTop: $(".result_number").offset().top - 180
    }, 1000);
}

function display_search_number(result_no, search_loc) {
    clear_existing_result_number();

    var el = document.createElement("p");
    el.setAttribute("class", "result_number my-4");
    var msg = document.createTextNode("Showing " + result_no + " results for " + search_loc + ".");
    el.appendChild(msg);
    document.getElementById("results").appendChild(el);

    if (document.getElementById("isUser").innerText !== "Guest") {
        var insert_el = document.createElement("a");
        insert_el.setAttribute("class", "d-inline-block");
        insert_el.setAttribute("id", "add-secret-cp");
        insert_el.setAttribute("href", "addsecretlocation.php");
        var insert_msg = document.createTextNode("Know a secret carpark but its not shown here?");
        insert_el.appendChild(insert_msg);
        document.getElementById("results").appendChild(insert_el);
    }


    var currentdate = new Date();
    var last_sync_time = currentdate.getHours() + ":" + currentdate.getMinutes() + ":" + currentdate.getSeconds();

    var time_el = document.createElement("a");
    time_el.setAttribute("class", "text-muted d-inline-block float-right");
    var sync_msg = document.createTextNode("Last updated: " + last_sync_time);
    time_el.appendChild(sync_msg);
    document.getElementById("results").append(time_el);

    // document.getElementById("results").append(el);
}

function display_sorry_zero_matches_returned() {
    clear_error_msg();
    var error_el = document.createElement("div");
    error_el.setAttribute("class", "text-warning");
    var error_msg = document.createTextNode("Sorry, the results returned 0 matches. Please try another location or check spelling.");
    error_el.appendChild(error_msg);
    document.getElementsByClassName("form-group")[0].appendChild(error_el);

}

function clear_error_msg() {
    if (document.getElementsByClassName("text-warning").length > 0) {
        document.getElementsByClassName("text-warning")[0].remove();
    }
}

function clear_existing_cards() {
    var no_of_card_to_remove = document.getElementsByClassName("card").length; //no of cards to remove

    if (no_of_card_to_remove > 0) {
        while (no_of_card_to_remove > 0) {
            document.getElementsByClassName("card")[0].remove();
            no_of_card_to_remove--;
        }
    }
}

function clear_existing_result_number() {
    if (document.getElementsByClassName("result_number").length > 0) {
        document.getElementsByClassName("result_number")[0].remove();
    }
}


$(function () {
    $(window).on('scroll', function () {
        if ($(window).scrollTop() > 500) {
            $('.navbar').addClass('active');
            $('.navbar').css("background-color", "#030305a8");
        } else {
            $('.navbar').removeClass('active');
            $('.navbar').css("background-color", "");
        }
    });
});